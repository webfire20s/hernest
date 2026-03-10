<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';

/* SAME FILTER LOGIC PRESERVED */
$conditions = [];
$params = [];

if (!empty($_GET['from']) && !empty($_GET['to'])) {
    $conditions[] = "DATE(ct.created_at) BETWEEN ? AND ?";
    $params[] = $_GET['from'];
    $params[] = $_GET['to'];
}

if (!empty($_GET['user_id'])) {
    $conditions[] = "ct.user_id = ?";
    $params[] = $_GET['user_id'];
}

$where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";

/* CSV HEADERS */
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="commission_report.csv"');

$output = fopen("php://output", "w");

fputcsv($output, [
    'Lead ID',
    'Customer',
    'Service',
    'User',
    'Role',
    'Commission Amount',
    'Date',
    'Time'
]);

/* SAME FIVE TABLE JOIN (LOGIC PRESERVED) */
$stmt = $pdo->prepare("
    SELECT ct.*, 
           users.full_name AS user_name,
           roles.role_name,
           leads.customer_name,
           services.service_name
    FROM commission_transactions ct
    JOIN users ON ct.user_id = users.id
    JOIN roles ON ct.role_id = roles.id
    JOIN leads ON ct.lead_id = leads.id
    JOIN services ON leads.service_id = services.id
    $where
    ORDER BY ct.created_at DESC
");

$stmt->execute($params);
$transactions = $stmt->fetchAll();

foreach ($transactions as $t) {

    fputcsv($output, [
        $t['lead_id'],
        $t['customer_name'],
        $t['service_name'],
        $t['user_name'],
        $t['role_name'],
        $t['commission_amount'],
        date('Y-m-d', strtotime($t['created_at'])),
        date('H:i:s', strtotime($t['created_at']))
    ]);
}

fclose($output);
exit;