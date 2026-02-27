<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';

// Fetch roles except Company
$roles = $pdo->query("
    SELECT id, role_name, hierarchy_level
    FROM roles
    WHERE hierarchy_level > 1
")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $role_id = $_POST['role_id'];
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Validate role
    $stmt = $pdo->prepare("
        SELECT hierarchy_level FROM roles WHERE id = ?
    ");
    $stmt->execute([$role_id]);
    $new_role_level = $stmt->fetchColumn();

    if (!$new_role_level || $new_role_level <= 1) {
        die("Invalid role selection.");
    }

    // Insert user (parent = Admin)
    $stmt = $pdo->prepare("
        INSERT INTO users 
        (role_id, parent_id, full_name, email, phone, password_hash)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $role_id,
        $_SESSION['user_id'],
        $name,
        $email,
        $phone,
        $password
    ]);

    header("Location: users.php");
    exit;
}
?>

<h2>Create New User</h2>

<form method="POST">
    <label>Full Name</label><br>
    <input type="text" name="full_name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Phone</label><br>
    <input type="text" name="phone"><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <label>Role</label><br>
    <select name="role_id" required>
        <?php foreach($roles as $role): ?>
            <option value="<?= $role['id'] ?>">
                <?= $role['role_name'] ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Create User</button>
</form>

<?php require '../includes/footer.php'; ?>