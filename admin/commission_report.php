<?php
require '../includes/middleware_admin.php';
require '../includes/header.php';
require '../includes/sidebar.php';

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
?>

<h2>Commission Report</h2>

<form method="GET">
    From: <input type="date" name="from">
    To: <input type="date" name="to">
    User ID: <input type="number" name="user_id">
    <button type="submit">Filter</button>
</form>

<br>

<table border="1" cellpadding="8">
<tr>
    <th>Lead ID</th>
    <th>Customer</th>
    <th>Service</th>
    <th>User</th>
    <th>Role</th>
    <th>Commission</th>
    <th>Date</th>
</tr>

<?php foreach($transactions as $t): ?>
<tr>
    <td><?= $t['lead_id'] ?></td>
    <td><?= htmlspecialchars($t['customer_name']) ?></td>
    <td><?= htmlspecialchars($t['service_name']) ?></td>
    <td><?= htmlspecialchars($t['user_name']) ?></td>
    <td><?= $t['role_name'] ?></td>
    <td>₹<?= $t['commission_amount'] ?></td>
    <td><?= $t['created_at'] ?></td>
</tr>
<?php endforeach; ?>

</table>

<?php require '../includes/footer.php'; ?>