<?php
require '../includes/auth.php';
require '../includes/hierarchy.php';

// Logic Preserved: Fetching downline user IDs and leads
$userIds = getDownlineUserIds($pdo, $currentUser['id']);
$placeholders = implode(',', array_fill(0, count($userIds), '?'));

$stmt = $pdo->prepare("
    SELECT leads.*, services.service_name, users.full_name AS submitted_by_name
    FROM leads
    JOIN services ON leads.service_id = services.id
    JOIN users ON leads.submitted_by = users.id
    WHERE submitted_by IN ($placeholders)
    ORDER BY created_at DESC
");
$stmt->execute($userIds);
$leads = $stmt->fetchAll();

require 'sidebar.php';
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <style>
        body { background-color: #f8fafc; margin: 0; font-family: 'Inter', sans-serif; }
        .main-content { margin-left: 260px; padding: 40px; }
        .data-card { background: white; border-radius: 20px; border: 1px solid #e2e8f0; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        
        /* Status Badges */
        .status-badge {
            padding: 4px 12px; border-radius: 99px; font-size: 11px;
            font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;
        }
        .status-pending { background: #fff7ed; color: #c2410c; border: 1px solid #ffedd5; }
        .status-approved { background: #f0fdf4; color: #15803d; border: 1px solid #dcfce7; }
        .status-rejected { background: #fef2f2; color: #b91c1c; border: 1px solid #fee2e2; }
        .status-default { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }

        /* DataTables UI Overrides */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e2e8f0; border-radius: 10px; padding: 8px 12px; margin-bottom: 20px; outline: none;
        }
        table.dataTable thead th { 
            background: #f8fafc; padding: 14px !important; font-size: 11px; 
            text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; border-bottom: 1px solid #e2e8f0 !important;
        }
        table.dataTable tbody td { padding: 14px !important; border-bottom: 1px solid #f1f5f9; font-size: 13px; }
    </style>
</head>

<div class="main-content">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Lead Network</h2>
            <p class="text-slate-500 text-sm mt-1">Real-time tracking for your direct submissions and downline activity.</p>
        </div>
        <a href="submit_lead.php" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold text-sm transition-all shadow-lg shadow-indigo-200 transform active:scale-95">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Submit New Lead
        </a>
    </div>

    <div class="data-card">
        <table id="leadsTable" class="display w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Contact & Address</th>
                    <th>Submitted By</th>
                    <th>Service Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($leads as $lead): 
                    // Logic Preserved: Choosing badge color
                    $statusClass = 'status-default';
                    $currStatus = strtolower($lead['current_status']);
                    if(strpos($currStatus, 'pending') !== false || strpos($currStatus, 'process') !== false) $statusClass = 'status-pending';
                    if(strpos($currStatus, 'approved') !== false || strpos($currStatus, 'completed') !== false) $statusClass = 'status-approved';
                    if(strpos($currStatus, 'reject') !== false || strpos($currStatus, 'cancel') !== false) $statusClass = 'status-rejected';
                ?>
                <tr>
                    <td class="font-mono text-xs text-slate-400">#<?= $lead['id'] ?></td>

                    <td>
                        <div class="font-bold text-slate-700"><?= htmlspecialchars($lead['customer_name']) ?></div>
                    </td>

                    <td>
                        <div class="text-slate-900 font-medium"><?= htmlspecialchars($lead['customer_phone']) ?></div>
                        <div class="text-[11px] text-slate-400 truncate max-w-[200px]"><?= htmlspecialchars($lead['address']) ?></div>
                    </td>

                    <td>
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500 uppercase">
                                <?= substr($lead['submitted_by_name'], 0, 1) ?>
                            </div>
                            <span class="text-xs font-medium text-slate-600"><?= htmlspecialchars($lead['submitted_by_name']) ?></span>
                        </div>
                    </td>

                    <td>
                        <span class="text-[11px] font-black uppercase tracking-wider bg-indigo-50 text-indigo-600 px-2 py-1 rounded border border-indigo-100">
                            <?= htmlspecialchars($lead['service_name']) ?>
                        </span>
                    </td>

                    <td>
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

<script>
$(document).ready(function() {
    $('#leadsTable').DataTable({
        "pageLength": 10,
        "order": [[ 0, "desc" ]],
        "language": {
            "search": "",
            "searchPlaceholder": "Search names, phones or services..."
        },
        "drawCallback": function() {
            // Apply Tailwind classes to pagination buttons after draw
            $('.dataTables_paginate .paginate_button').addClass('text-xs font-bold rounded-lg');
        }
    });
});
</script>

<?php require '../includes/footer.php'; ?>