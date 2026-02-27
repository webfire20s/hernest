<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/middleware_admin.php';

$user_id = $_GET['id'] ?? null;

if (!$user_id) {
    header("Location: users.php");
    exit;
}

// Prevent self deactivation
if ($user_id == $_SESSION['user_id']) {
    die("You cannot deactivate yourself.");
}

// Toggle status
$stmt = $pdo->prepare("
    UPDATE users
    SET is_active = NOT is_active
    WHERE id = ?
");
$stmt->execute([$user_id]);

header("Location: users.php");
exit;
?>