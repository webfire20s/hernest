<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit;
}

$stmt = $pdo->prepare("
    SELECT users.*, roles.role_name, roles.hierarchy_level
    FROM users
    JOIN roles ON users.role_id = roles.id
    WHERE users.id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$currentUser = $stmt->fetch();

if (!$currentUser) {
    session_destroy();
    header("Location: /login.php");
    exit;
}