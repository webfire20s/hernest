<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';

// Total Users
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

// Total Leads
$totalLeads = $pdo->query("SELECT COUNT(*) FROM leads")->fetchColumn();

// Lead Status Summary
$statusSummary = $pdo->query("
    SELECT current_status, COUNT(*) as total
    FROM leads
    GROUP BY current_status
")->fetchAll();

// Total Commission Distributed
$totalCommission = $pdo->query("
    SELECT IFNULL(SUM(commission_amount),0)
    FROM commission_transactions
")->fetchColumn();
?>

<h2>Dashboard</h2>

<div class="card">Total Users: <?= $totalUsers ?></div>
<div class="card">Total Leads: <?= $totalLeads ?></div>
<div class="card">Total Commission Distributed: ₹<?= $totalCommission ?></div>

<h3>Lead Status Summary</h3>
<table border="1" cellpadding="10">
    <tr>
        <th>Status</th>
        <th>Total</th>
    </tr>
    <?php foreach($statusSummary as $row): ?>
        <tr>
            <td><?= $row['current_status'] ?></td>
            <td><?= $row['total'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require '../includes/footer.php'; ?>