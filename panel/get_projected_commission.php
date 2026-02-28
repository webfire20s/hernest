<?php
require '../includes/auth.php';

if (!isset($_GET['service_id'])) {
    echo json_encode(['amount' => 0]);
    exit;
}

$serviceId = (int) $_GET['service_id'];
$roleId    = $currentUser['role_id'];

// Get commission rule for this role + service
$stmt = $pdo->prepare("
    SELECT commission_type, commission_value
    FROM service_commissions
    WHERE service_id = ? AND role_id = ?
    LIMIT 1
");
$stmt->execute([$serviceId, $roleId]);
$rule = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$rule) {
    echo json_encode(['amount' => 0]);
    exit;
}

$commissionAmount = 0;

if ($rule['commission_type'] === 'fixed') {

    $commissionAmount = (float)$rule['commission_value'];

} elseif ($rule['commission_type'] === 'percentage') {

    // Fetch service base price
    $stmt2 = $pdo->prepare("SELECT base_price FROM services WHERE id = ?");
    $stmt2->execute([$serviceId]);
    $basePrice = (float)$stmt2->fetchColumn();

    $commissionAmount = ($basePrice * $rule['commission_value']) / 100;
}

echo json_encode([
    'amount' => round($commissionAmount, 2)
]);