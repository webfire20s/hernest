<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/middleware_admin.php';
require '../includes/commission_engine.php';

$lead_id = $_GET['id'] ?? null;
$new_status = $_GET['status'] ?? null;

if (!$lead_id || !$new_status) {
    header("Location: leads.php");
    exit;
}

// Get current lead
$stmt = $pdo->prepare("
    SELECT current_status, commission_distributed
    FROM leads
    WHERE id = ?
");
$stmt->execute([$lead_id]);
$lead = $stmt->fetch();

if (!$lead) {
    die("Lead not found.");
}

// Prevent modification after final state
if ($lead['current_status'] == 'Approved' || $lead['current_status'] == 'Rejected') {
    die("Lead already finalized.");
}

$pdo->beginTransaction();

try {

    $stmt = $pdo->prepare("
        UPDATE leads
        SET current_status = ?, 
            approved_at = CASE WHEN ? = 'Approved' THEN NOW() ELSE approved_at END
        WHERE id = ?
    ");
    $stmt->execute([$new_status, $new_status, $lead_id]);

    // Log change
    $stmt = $pdo->prepare("
        INSERT INTO lead_status_logs
        (lead_id, old_status, new_status, changed_by)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([
        $lead_id,
        $lead['current_status'],
        $new_status,
        $_SESSION['user_id']
    ]);

    // Commission trigger
    if ($new_status == 'Approved' && !$lead['commission_distributed']) {

        distributeCommission($lead_id, $pdo);

        $stmt = $pdo->prepare("
            UPDATE leads
            SET commission_distributed = 1
            WHERE id = ?
        ");
        $stmt->execute([$lead_id]);
    }

    $pdo->commit();

} catch (Exception $e) {
    $pdo->rollBack();
    die("Error: " . $e->getMessage());
}

header("Location: leads.php");
exit;