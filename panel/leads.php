<?php
require '../includes/auth.php';
require '../includes/hierarchy.php';

$userIds = getDownlineUserIds($pdo, $currentUser['id']);
$placeholders = implode(',', array_fill(0, count($userIds), '?'));

$stmt = $pdo->prepare("
    SELECT leads.*, services.service_name
    FROM leads
    JOIN services ON leads.service_id = services.id
    WHERE submitted_by IN ($placeholders)
    ORDER BY created_at DESC
");
$stmt->execute($userIds);
$leads = $stmt->fetchAll();

require 'sidebar.php';
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: sans-serif; }
        .main-content { margin-left: 260px; padding: 40px; }
        .data-card { background: white; border-radius: 20px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .status-badge {
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        /* Dynamic Status Colors */
        .status-pending { background: #fff7ed; color: #c2410c; }
        .status-approved { background: #f0fdf4; color: #15803d; }
        .status-rejected { background: #fef2f2; color: #b91c1c; }
        .status-default { background: #f1f5f9; color: #475569; }
    </style>
</head>

<div class="main-content">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Lead Management</h2>
            <p class="text-slate-500 text-sm">Showing all leads from your direct submissions and downline.</p>
        </div>
        <a href="submit_lead.php" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-blue-200">
            + New Lead
        </a>
    </div>

    <div class="data-card">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-bottom border-slate-100">
                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">ID</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Customer Name</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Service Type</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if(empty($leads)): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic text-sm">No leads found in your network.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach($leads as $lead): 
                    // Simple logic to choose badge color
                    $statusClass = 'status-default';
                    $currStatus = strtolower($lead['current_status']);
                    if(strpos($currStatus, 'pending') !== false) $statusClass = 'status-pending';
                    if(strpos($currStatus, 'approved') !== false || strpos($currStatus, 'completed') !== false) $statusClass = 'status-approved';
                    if(strpos($currStatus, 'reject') !== false || strpos($currStatus, 'cancel') !== false) $statusClass = 'status-rejected';
                ?>
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4 text-sm font-bold text-slate-400">#<?= $lead['id'] ?></td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-semibold text-slate-700"><?= htmlspecialchars($lead['customer_name']) ?></span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-medium bg-slate-100 text-slate-600 px-2 py-1 rounded-md">
                            <?= htmlspecialchars($lead['service_name']) ?>
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="status-badge <?= $statusClass ?>">
                            <?= htmlspecialchars($lead['current_status']) ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>