<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';

// Fetch all leads (Logic Preserved)
$stmt = $pdo->query("
    SELECT l.id, l.customer_name, l.customer_phone,
           l.current_status, l.created_at,
           s.service_name,
           u.full_name AS submitted_by
    FROM leads l
    JOIN services s ON l.service_id = s.id
    JOIN users u ON l.submitted_by = u.id
    ORDER BY l.created_at DESC
");
$leads = $stmt->fetchAll();
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: 'Inter', sans-serif; }
        .data-card { background: white; border-radius: 24px; border: 1px solid #e2e8f0; padding: 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        
        /* DataTables Customization */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e2e8f0; border-radius: 12px; padding: 8px 16px; margin-bottom: 20px; outline: none;
        }
        table.dataTable thead th { 
            background: #f8fafc; padding: 16px !important; font-size: 11px; 
            text-transform: uppercase; letter-spacing: 0.1em; color: #64748b; border-bottom: 1px solid #e2e8f0 !important;
        }
        table.dataTable tbody td { padding: 16px !important; border-bottom: 1px solid #f1f5f9; font-size: 13px; color: #1e293b; }

        /* Status Badges */
        .badge { padding: 4px 10px; border-radius: 8px; font-size: 10px; font-weight: 800; text-transform: uppercase; border: 1px solid transparent; }
        .status-pending { background: #fffbeb; color: #b45309; border-color: #fef3c7; }
        .status-process { background: #eff6ff; color: #1d4ed8; border-color: #dbeafe; }
        .status-approved { background: #ecfdf5; color: #047857; border-color: #d1fae5; }
        .status-rejected { background: #fff1f2; color: #be123c; border-color: #ffe4e6; }

        /* Action Buttons */
        .btn-action { font-size: 11px; font-weight: 700; padding: 5px 10px; border-radius: 6px; transition: all 0.2s; display: inline-block; }
    </style>
</head>

<div class="admin-main">
    <div class="mb-10">
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Lead Management</h2>
        <p class="text-slate-500 text-sm mt-1">Review, track, and update the status of all customer applications.</p>
    </div>

    <div class="data-card">
        <table id="leadsTable" class="display w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Details</th>
                    <th>Service</th>
                    <th>Submitted By</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($leads as $lead): 
                    // Dynamic Status Class
                    $statusCls = 'status-pending';
                    if($lead['current_status'] == 'In Process') $statusCls = 'status-process';
                    if($lead['current_status'] == 'Approved') $statusCls = 'status-approved';
                    if($lead['current_status'] == 'Rejected') $statusCls = 'status-rejected';
                ?>
                    <tr>
                        <td class="font-mono text-xs text-slate-400">#<?= $lead['id'] ?></td>
                        <td>
                            <div class="font-bold text-slate-800"><?= htmlspecialchars($lead['customer_name']) ?></div>
                            <div class="text-[11px] text-slate-400 font-medium"><?= htmlspecialchars($lead['customer_phone']) ?></div>
                        </td>
                        <td>
                            <span class="font-semibold text-slate-600"><?= $lead['service_name'] ?></span>
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 bg-slate-100 rounded-full flex items-center justify-center text-[10px] font-bold text-slate-500">
                                    <?= strtoupper(substr($lead['submitted_by'], 0, 1)) ?>
                                </div>
                                <span class="text-xs font-medium text-slate-600"><?= $lead['submitted_by'] ?></span>
                            </div>
                        </td>
                        <td>
                            <span class="badge <?= $statusCls ?>"><?= $lead['current_status'] ?></span>
                        </td>
                        <td>
                            <div class="flex flex-wrap gap-2">
                                <?php if($lead['current_status'] == 'Pending' || $lead['current_status'] == 'In Process'): ?>
                                    <a href="update_lead_status.php?id=<?= $lead['id'] ?>&status=In Process" 
                                       class="btn-action bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white border border-blue-100">Process</a>
                                    
                                    <a href="update_lead_status.php?id=<?= $lead['id'] ?>&status=Approved" 
                                       class="btn-action bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white border border-emerald-100">Approve</a>
                                    
                                    <a href="update_lead_status.php?id=<?= $lead['id'] ?>&status=Rejected" 
                                       class="btn-action bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white border border-rose-100">Reject</a>
                                <?php else: ?>
                                    <span class="text-[10px] font-bold text-slate-300 uppercase italic">Locked</span>
                                <?php endif; ?>
                            </div>
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
        "order": [[ 0, "desc" ]], // Sort by ID desc by default
        "language": {
            "search": "",
            "searchPlaceholder": "Search leads, customers, or status..."
        }
    });
});
</script>

<?php require '../includes/footer.php'; ?>