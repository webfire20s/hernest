<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';

$conditions = [];
$params = [];

if (!empty($_GET['from']) && !empty($_GET['to'])) {
    $conditions[] = "DATE(leads.created_at) BETWEEN ? AND ?";
    $params[] = $_GET['from'];
    $params[] = $_GET['to'];
}

if (!empty($_GET['service_id'])) {
    $conditions[] = "leads.service_id = ?";
    $params[] = $_GET['service_id'];
}

if (!empty($_GET['user_id'])) {
    $conditions[] = "leads.user_id = ?";
    $params[] = $_GET['user_id'];
}

if (!empty($_GET['status'])) {
    $conditions[] = "leads.status = ?";
    $params[] = $_GET['status'];
}

$where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";

$stmt = $pdo->prepare("
    SELECT 
        leads.id,
        leads.customer_name,
        leads.customer_phone,
        leads.customer_email,
        leads.address,
        leads.current_status,
        leads.created_at,
        services.service_name,
        users.full_name AS user_name
    FROM leads
    JOIN services ON leads.service_id = services.id
    JOIN users ON leads.submitted_by = users.id
    $where
    ORDER BY leads.created_at DESC
");
$stmt->execute($params);
$leads = $stmt->fetchAll();

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="leads_export.csv"');

$output = fopen('php://output', 'w');

fputcsv($output, [
    'Lead ID',
    'Customer Name',
    'Phone',
    'Service',
    'Submitted By',
    'Status',
    'Created At'
]);

foreach ($leads as $lead) {
    fputcsv($output, [
        $lead['id'],
        $lead['customer_name'],
        $lead['customer_phone'],
        $lead['service_name'],
        $lead['user_name'], 
        $lead['current_status'],
        $lead['created_at']
    ]);
}

fclose($output);
exit;