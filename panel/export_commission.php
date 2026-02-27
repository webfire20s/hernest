<?php
require '../includes/auth.php';

// Block Admin
if ($currentUser['hierarchy_level'] == 1) {
    header("Location: /admin/dashboard.php");
    exit;
}

// Force CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename=my_commission_report.csv');

$output = fopen('php://output', 'w');

// CSV Headers
fputcsv($output, [
    'Transaction ID',
    'Lead ID',
    'Service Name',
    'Commission Amount',
    'Commission Type',
    'Commission Percentage',
    'Status',
    'Date'
]);

// Filters
$dateFrom = $_GET['date_from'] ?? null;
$dateTo   = $_GET['date_to'] ?? null;
$service  = $_GET['service_id'] ?? null;

// BASE QUERY (STRICT USER ISOLATION)
$query = "
    SELECT 
        ct.id,
        ct.lead_id,
        s.service_name,
        ct.commission_amount,
        ct.commission_type,
        ct.commission_percentage,
        ct.status,
        ct.created_at
    FROM commission_transactions ct
    JOIN services s ON ct.service_id = s.id
    WHERE ct.user_id = ?
";

$params = [$currentUser['id']];

// Apply filters safely
if (!empty($dateFrom)) {
    $query .= " AND DATE(ct.created_at) >= ?";
    $params[] = $dateFrom;
}

if (!empty($dateTo)) {
    $query .= " AND DATE(ct.created_at) <= ?";
    $params[] = $dateTo;
}

if (!empty($service)) {
    $query .= " AND ct.service_id = ?";
    $params[] = $service;
}

$query .= " ORDER BY ct.created_at DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);

// Output rows
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, $row);
}

fclose($output);
exit;