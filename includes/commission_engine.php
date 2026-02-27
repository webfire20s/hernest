<?php

function distributeCommission($lead_id, $pdo)
{
    // Prevent duplicate distribution
    $check = $pdo->prepare("
        SELECT COUNT(*) 
        FROM commission_transactions 
        WHERE lead_id = ?
    ");
    $check->execute([$lead_id]);

    if ($check->fetchColumn() > 0) {
        return;
    }

    // Get lead details
    $stmt = $pdo->prepare("
        SELECT service_id, submitted_by 
        FROM leads 
        WHERE id = ?
    ");
    $stmt->execute([$lead_id]);
    $lead = $stmt->fetch();

    if (!$lead) {
        throw new Exception("Lead not found.");
    }

    $service_id = $lead['service_id'];
    $current_user_id = $lead['submitted_by'];

    $level_limit = 10;
    $counter = 0;

    while ($current_user_id && $counter < $level_limit) {

        $stmt = $pdo->prepare("
            SELECT u.id, u.parent_id, u.role_id
            FROM users u
            WHERE u.id = ?
        ");
        $stmt->execute([$current_user_id]);
        $user = $stmt->fetch();

        if (!$user) break;

        // Get commission rule
        $stmt = $pdo->prepare("
            SELECT commission_type, commission_value
            FROM service_commissions
            WHERE service_id = ? AND role_id = ?
        ");
        $stmt->execute([$service_id, $user['role_id']]);
        $rule = $stmt->fetch();

        if ($rule) {

            $stmt = $pdo->prepare("
                SELECT base_price FROM services WHERE id = ?
            ");
            $stmt->execute([$service_id]);
            $service = $stmt->fetch();

            if ($rule['commission_type'] == 'fixed') {
                $amount = $rule['commission_value'];
            } else {
                $amount = ($service['base_price'] * $rule['commission_value']) / 100;
            }

            // Insert commission record
            $stmt = $pdo->prepare("
                INSERT INTO commission_transactions
                (lead_id, service_id, user_id, role_id, commission_amount, commission_type)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $lead_id,
                $service_id,
                $user['id'],
                $user['role_id'],
                $amount,
                $rule['commission_type']
            ]);

            // Update wallet
            $stmt = $pdo->prepare("
                UPDATE users
                SET wallet_balance = wallet_balance + ?
                WHERE id = ?
            ");
            $stmt->execute([$amount, $user['id']]);
        }

        $current_user_id = $user['parent_id'];
        $counter++;
    }
}