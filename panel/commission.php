<?php
require '../includes/auth.php';
require '../includes/hierarchy.php';

$userIds = getDownlineUserIds($pdo, $currentUser['id']);
$placeholders = implode(',', array_fill(0, count($userIds), '?'));

$stmt = $pdo->prepare("
    SELECT ct.*, leads.customer_name
    FROM commission_transactions ct
    JOIN leads ON ct.lead_id = leads.id
    WHERE ct.user_id IN ($placeholders)
    ORDER BY ct.created_at DESC
");
$stmt->execute($userIds);
$transactions = $stmt->fetchAll();

require 'sidebar.php';
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: sans-serif; }
        .main-content { margin-left: 260px; padding: 40px; }
        .data-card { background: white; border-radius: 24px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .filter-bar { background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px; margin-bottom: 30px; }
        .form-control { 
            background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 8px; 
            padding: 8px 12px; font-size: 0.85rem; color: #1e293b; font-weight: 500;
        }
        .form-control:focus { outline: none; border-color: #2563eb; background: white; }
    </style>
</head>

<div class="main-content">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Commission History</h2>
            <p class="text-slate-500 text-sm font-medium">Tracking all earnings from your personal and downline network.</p>
        </div>
        <div class="flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-700 rounded-lg text-xs font-bold border border-emerald-100">
            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span> Ledger Verified
        </div>
    </div>

    <div class="filter-bar">
        <form method="GET" action="export_commission.php" class="flex flex-wrap items-end gap-6">
            <div class="flex flex-col gap-2">
                <label class="text-[10px] uppercase font-bold text-slate-400 tracking-widest">Date From</label>
                <input type="date" name="date_from" class="form-control">
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-[10px] uppercase font-bold text-slate-400 tracking-widest">Date To</label>
                <input type="date" name="date_to" class="form-control">
            </div>

            <div class="flex flex-col gap-2">
                <label class="text-[10px] uppercase font-bold text-slate-400 tracking-widest">Service</label>
                <select name="service_id" class="form-control">
                    <option value="">All Services</option>
                    <?php
                    $services = $pdo->query("SELECT id, service_name FROM services WHERE is_active = 1")->fetchAll();
                    foreach ($services as $s) {
                        echo "<option value='{$s['id']}'>" . htmlspecialchars($s['service_name']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="bg-slate-900 hover:bg-black text-white px-6 py-2.5 rounded-lg text-xs font-bold transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export CSV
            </button>
        </form>
    </div>

    <div class="data-card">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Lead ID</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Customer Details</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Amount</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Transaction Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if(empty($transactions)): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic text-sm">No transactions recorded yet.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach($transactions as $t): ?>
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <span class="text-xs font-mono font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded">#<?= $t['lead_id'] ?></span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-semibold text-slate-700"><?= htmlspecialchars($t['customer_name']) ?></div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="text-sm font-bold text-emerald-600">+₹<?= number_format($t['commission_amount'], 2) ?></span>
                    </td>
                    <td class="px-6 py-4 text-right text-xs font-medium text-slate-500">
                        <?= date('M j, Y, g:i a', strtotime($t['created_at'])) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>