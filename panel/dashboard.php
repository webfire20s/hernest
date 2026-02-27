<?php
require '../includes/auth.php';
require '../includes/hierarchy.php';
require '../includes/wallet.php';

if ($currentUser['hierarchy_level'] == 1) {
    header("Location: /admin/dashboard.php");
    exit;
}

$walletBalance = getUserWallet($pdo, $currentUser['id']);

$userIds = getDownlineUserIds($pdo, $currentUser['id']);
$placeholders = implode(',', array_fill(0, count($userIds), '?'));

$stmt = $pdo->prepare("
    SELECT COUNT(*) FROM leads
    WHERE submitted_by IN ($placeholders)
");
$stmt->execute($userIds);
$totalLeads = $stmt->fetchColumn() ?? 0;

$stmt = $pdo->prepare("
    SELECT COUNT(*) FROM commission_transactions
    WHERE user_id IN ($placeholders)
");
$stmt->execute($userIds);
$totalCommission = $stmt->fetchColumn() ?? 0;

require 'sidebar.php';
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: sans-serif; }
        .dashboard-container { margin-left: 250px; padding: 40px; }
        .card { background: white; border-radius: 20px; border: 1px solid #e2e8f0; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .wallet-card { background: #1e293b; color: white; border-radius: 20px; padding: 24px; }
        .label { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; margin-bottom: 4px; }
    </style>
</head>

<div class="dashboard-container">
    
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-800">
            <?= htmlspecialchars($currentUser['role_name']) ?> Dashboard
        </h2>
        <div class="h-1 w-12 bg-blue-600 mt-2 rounded-full"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="wallet-card">
            <p class="label" style="color: #60a5fa;">Your Wallet</p>
            <h3 class="text-3xl font-bold">₹<?= number_format($walletBalance, 2) ?></h3>
            <div class="mt-4">
                <a href="request_withdrawal.php" class="text-[10px] font-bold bg-blue-600 hover:bg-blue-700 px-3 py-1.5 rounded uppercase tracking-wider transition-colors">Withdraw Funds</a>
            </div>
        </div>

        <div class="card">
            <p class="label">Total Leads (Self + Downline)</p>
            <h3 class="text-3xl font-bold text-slate-900"><?= $totalLeads ?></h3>
            <p class="text-[10px] text-slate-400 mt-2 font-semibold">NETWORK SYNCHRONIZED</p>
        </div>

        <div class="card">
            <p class="label">Total Commission Transactions</p>
            <h3 class="text-3xl font-bold text-slate-900"><?= $totalCommission ?></h3>
            <p class="text-[10px] text-slate-400 mt-2 font-semibold">VERIFIED TRANSACTIONS</p>
        </div>

    </div>

    <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="submit_lead.php" class="p-3 bg-white border border-slate-200 rounded-lg text-center text-xs font-bold text-slate-600 hover:border-blue-500 transition-all">Submit Lead</a>
        <a href="leads.php" class="p-3 bg-white border border-slate-200 rounded-lg text-center text-xs font-bold text-slate-600 hover:border-blue-500 transition-all">Leads List</a>
        <a href="users.php" class="p-3 bg-white border border-slate-200 rounded-lg text-center text-xs font-bold text-slate-600 hover:border-blue-500 transition-all">My Downline</a>
        <a href="profile.php" class="p-3 bg-white border border-slate-200 rounded-lg text-center text-xs font-bold text-slate-600 hover:border-blue-500 transition-all">My Profile</a>
    </div>

</div>