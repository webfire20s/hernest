<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';
require '../includes/wallet.php';

// Fetch all users with role name
$stmt = $pdo->query("
SELECT u.id, u.full_name, u.email, u.phone, 
u.wallet_balance, u.is_active,
r.role_name
FROM users u
JOIN roles r ON u.role_id = r.id
ORDER BY r.hierarchy_level ASC
");
$users = $stmt->fetchAll();
?>

<h2>User Management</h2>

<a href="create_user.php">+ Create New User</a>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Role</th>
        <th>Wallet</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php foreach ($users as $user): ?>

        <?php
            // Calculate wallet dynamically for THIS user
            $walletBalance = getUserWallet($pdo, $user['id']);
        ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['full_name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['phone']) ?></td>
            <td><?= $user['role_name'] ?></td>
            <td>₹<?= number_format($walletBalance, 2) ?></td>
            <td><?= $user['is_active'] ? "Active" : "Inactive" ?></td>
            <td>
                <?php if ($user['id'] != $_SESSION['user_id']): ?>
                    <a href="toggle_user_status.php?id=<?= $user['id'] ?>">
                        <?= $user['is_active'] ? "Deactivate" : "Activate" ?>
                    </a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require '../includes/footer.php'; ?>