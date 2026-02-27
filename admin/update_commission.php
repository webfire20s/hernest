<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';

$service_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$service_id) {
    header("Location: services.php");
    exit;
}
$roles = $pdo->query("
    SELECT id, role_name FROM roles ORDER BY hierarchy_level ASC
")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    foreach ($_POST['commission'] as $role_id => $data) {

        $type = $data['type'];
        $value = $data['value'];

        $stmt = $pdo->prepare("
            INSERT INTO service_commissions
            (service_id, role_id, commission_type, commission_value)
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                commission_type = VALUES(commission_type),
                commission_value = VALUES(commission_value)
        ");

        $stmt->execute([$service_id, $role_id, $type, $value]);
    }

    echo "<p>Commission updated successfully.</p>";
}
?>

<h2>Commission Setup</h2>

<form method="POST">

<table border="1" cellpadding="8">
<tr>
    <th>Role</th>
    <th>Commission Type</th>
    <th>Value</th>
</tr>

<?php foreach($roles as $role): ?>
<tr>
    <td><?= $role['role_name'] ?></td>
    <td>
        <select name="commission[<?= $role['id'] ?>][type]">
            <option value="fixed">Fixed</option>
            <option value="percentage">Percentage</option>
        </select>
    </td>
    <td>
        <input type="number" step="0.01"
        name="commission[<?= $role['id'] ?>][value]" required>
    </td>
</tr>
<?php endforeach; ?>

</table>

<br>
<button type="submit">Save Commission</button>
</form>

<?php require '../includes/footer.php'; ?>