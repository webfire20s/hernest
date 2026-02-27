<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';

$services = $pdo->query("
    SELECT * FROM services ORDER BY created_at DESC
")->fetchAll();
?>

<h2>Services Management</h2>

<a href="create_service.php">+ Add New Service</a>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Base Price</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php foreach($services as $service): ?>
<tr>
    <td><?= $service['id'] ?></td>
    <td><?= htmlspecialchars($service['service_name']) ?></td>
    <td>₹<?= $service['base_price'] ?></td>
    <td><?= $service['is_active'] ? "Active" : "Inactive" ?></td>
    <td>
        <a href="edit_service.php?id=<?= $service['id'] ?>">Edit</a> |
        <a href="update_commission.php?id=<?= $service['id'] ?>">Set Commission</a>
    </td>
</tr>
<?php endforeach; ?>

</table>

<?php require '../includes/footer.php'; ?>