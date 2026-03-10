<?php
require '../includes/auth.php';

$id = $_GET['id'];

$pdo->prepare("
UPDATE partner_applications
SET status='rejected'
WHERE id=?
")->execute([$id]);

header("Location: applications.php");
exit;   