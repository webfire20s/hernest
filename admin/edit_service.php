<?php
require '../includes/middleware_admin.php';
require '../includes/header.php';
require '../includes/sidebar.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
$stmt->execute([$id]);
$service = $stmt->fetch();

if (!$service) {
    die("Service not found");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['service_name'];
    $desc = $_POST['description'];
    $price = $_POST['base_price'];
    $active = isset($_POST['is_active']) ? 1 : 0;

    $update = $pdo->prepare("
        UPDATE services
        SET service_name = ?, description = ?, base_price = ?, is_active = ?
        WHERE id = ?
    ");
    $update->execute([$name, $desc, $price, $active, $id]);

    header("Location: services.php");
    exit;
}
?>

<h2>Edit Service</h2>

<form method="POST">
    <label>Name</label><br>
    <input type="text" name="service_name"
        value="<?= htmlspecialchars($service['service_name']) ?>" required><br><br>

    <label>Description</label><br>
    <textarea name="description"><?= htmlspecialchars($service['description']) ?></textarea><br><br>

    <label>Base Price</label><br>
    <input type="number" step="0.01"
        name="base_price"
        value="<?= $service['base_price'] ?>" required><br><br>

    <label>
        <input type="checkbox" name="is_active"
            <?= $service['is_active'] ? 'checked' : '' ?>>
        Active
    </label><br><br>

    <button type="submit">Update Service</button>
</form>

<?php require '../includes/footer.php'; ?>