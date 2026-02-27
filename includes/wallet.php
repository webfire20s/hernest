<?php

function getUserWallet($pdo, $userId)
{
    // Total credited commission
    $stmt = $pdo->prepare("
        SELECT IFNULL(SUM(commission_amount),0)
        FROM commission_transactions
        WHERE user_id = ? AND status = 'Credited'
    ");
    $stmt->execute([$userId]);
    $totalCommission = $stmt->fetchColumn();

    // Total approved withdrawals
    $stmt = $pdo->prepare("
        SELECT IFNULL(SUM(amount),0)
        FROM withdrawals
        WHERE user_id = ? AND status = 'Approved'
    ");
    $stmt->execute([$userId]);
    $totalWithdrawn = $stmt->fetchColumn();

    return $totalCommission - $totalWithdrawn;
}