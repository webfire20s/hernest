<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';

/* Preserve hierarchy protection */
if ($currentUser['hierarchy_level'] != 1) {
    die("Access Denied");
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="withdrawals_export.csv"');

$output = fopen("php://output", "w");

/* CSV Header */
fputcsv($output, [
    'Withdrawal ID',
    'Partner Name',
    'Amount',
    'Status',
    'Requested At',
    'Processed At'
]);

/* SAME QUERY AS PAGE (LOGIC PRESERVED) */
$stmt = $pdo->query("
    SELECT w.*, u.full_name
    FROM withdrawals w
    JOIN users u ON w.user_id = u.id
    ORDER BY w.requested_at DESC
");

$withdrawals = $stmt->fetchAll();

foreach ($withdrawals as $w) {

    fputcsv($output, [
        $w['id'],
        $w['full_name'],
        $w['amount'],
        $w['status'],
        $w['requested_at'],
        $w['processed_at']
    ]);
}

fclose($output);
exit;