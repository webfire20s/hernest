<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['service_name'];
    $description = $_POST['description'];
    $price = $_POST['base_price'];

    $stmt = $pdo->prepare("
        INSERT INTO services (service_name, description, base_price)
        VALUES (?, ?, ?)
    ");
    $stmt->execute([$name, $description, $price]);

    header("Location: services.php");
    exit;
}
?>

<h2>Create Service</h2>

<form method="POST">
    <label>Service Name</label><br>
    <input type="text" name="service_name" required><br><br>

    <label>Description</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Base Price</label><br>
    <input type="number" step="0.01" name="base_price" required><br><br>

    <button type="submit">Create Service</button>
</form>

<?php require '../includes/footer.php'; ?>