<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/wallet.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="users_export.csv"');

$output = fopen("php://output", "w");

/* CSV Header */
fputcsv($output, [
    'ID',
    'Full Name',
    'Email',
    'Phone',
    'Role',
    'Wallet Balance',
    'Status'
]);

/* SAME QUERY AS USERS PAGE (Logic Preserved) */
$stmt = $pdo->query("
SELECT u.id, u.full_name, u.email, u.phone,
u.wallet_balance, u.is_active,
r.role_name
FROM users u
JOIN roles r ON u.role_id = r.id
ORDER BY r.hierarchy_level ASC
");

$users = $stmt->fetchAll();

foreach ($users as $user) {

    /* Wallet calculation preserved */
    $walletBalance = getUserWallet($pdo, $user['id']);

    $status = $user['is_active'] ? 'Active' : 'Inactive';

    fputcsv($output, [
        $user['id'],
        $user['full_name'],
        $user['email'],
        $user['phone'],
        $user['role_name'],
        $walletBalance,
        $status
    ]);
}

fclose($output);
exit;