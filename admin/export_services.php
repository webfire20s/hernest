<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="services_export.csv"');

$output = fopen("php://output", "w");

/* CSV Header */
fputcsv($output, [
    'ID',
    'Service Name',
    'Base Price',
    'Status',
    'Created At'
]);

/* SAME QUERY AS SERVICES PAGE (Logic Preserved) */
$services = $pdo->query("
    SELECT * FROM services ORDER BY created_at DESC
")->fetchAll();

foreach ($services as $service) {

    $status = $service['is_active'] ? 'Active' : 'Inactive';

    fputcsv($output, [
        $service['id'],
        $service['service_name'],
        $service['base_price'],
        $status,
        $service['created_at']
    ]);
}

fclose($output);
exit;