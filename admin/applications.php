<?php
require '../includes/auth.php';

$stmt = $pdo->prepare("
SELECT pa.*, r.role_name
FROM partner_applications pa
JOIN roles r ON pa.requested_role_id = r.id
WHERE pa.status = 'pending'
ORDER BY pa.created_at DESC
");

$stmt->execute();
$applications = $stmt->fetchAll();

require '../includes/sidebar.php';
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: 'Inter', sans-serif; }
        .data-card { background: white; border-radius: 24px; border: 1px solid #e2e8f0; padding: 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        
        /* DataTables Styling - Matched exactly to users.php */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e2e8f0; border-radius: 12px; padding: 8px 16px; outline: none; margin-bottom: 20px;
        }
        table.dataTable thead th { 
            background: #f8fafc; padding: 16px !important; font-size: 11px; 
            text-transform: uppercase; letter-spacing: 0.1em; color: #64748b; border-bottom: 1px solid #e2e8f0 !important;
        }
        table.dataTable tbody td { padding: 16px !important; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #1e293b; }
        
        /* Action Links & Badges - Matched exactly to users.php */
        .action-link { font-size: 12px; font-weight: 700; transition: all 0.2s; }
        .status-badge { padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase; }
    </style>
</head>

<div class="admin-main">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Partner Applications</h2>
            <p class="text-slate-500 text-sm mt-1">Review and verify new partnership requests for the HERNEST network.</p>
        </div>
        <div class="flex gap-3">
            <div class="inline-flex items-center bg-orange-50 text-orange-600 px-6 py-3 rounded-xl border border-orange-100 font-bold text-sm shadow-sm">
                <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse mr-2"></span>
                <?= count($applications) ?> Pending Reviews
            </div>
        </div>
    </div>

    <div class="data-card">
        <table id="applicationsTable" class="display w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Applicant Name</th>
                    <th>Contact Info</th>
                    <th>Requested Role</th>
                    <th>Application Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $app): ?>
                    <tr>
                        <td class="font-mono text-xs text-slate-400">#<?= $app['id'] ?></td>
                        <td>
                            <div class="font-bold text-slate-800"><?= htmlspecialchars($app['full_name']) ?></div>
                        </td>
                        <td>
                            <div class="text-sm"><?= htmlspecialchars($app['email']) ?></div>
                            <div class="text-[11px] text-slate-400 font-medium"><?= htmlspecialchars($app['phone']) ?></div>

                            <?php if(!empty($app['address'])): ?>
                                <div class="text-[11px] text-slate-500 mt-1">
                                    <?= htmlspecialchars($app['address']) ?>
                                </div>
                            <?php endif; ?>

                            <?php if(!empty($app['pincode'])): ?>
                                <div class="text-[10px] text-slate-400 font-semibold">
                                    PIN: <?= htmlspecialchars($app['pincode']) ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="px-2 py-1 bg-indigo-50 text-indigo-500 rounded text-[9px] font-black uppercase tracking-wider border border-indigo-100">
                                <?= htmlspecialchars($app['role_name']) ?>
                            </span>
                        </td>
                        <td class="font-medium text-slate-600">
                            <?= date('d M, Y', strtotime($app['created_at'])) ?>
                        </td>
                        <td>
                            <div class="flex gap-3">
                                <a href="approve_application.php?id=<?= $app['id'] ?>" 
                                   class="action-link text-emerald-600 hover:text-emerald-800">
                                   Approve
                                </a>
                                <span class="text-slate-200">|</span>
                                <a href="reject_application.php?id=<?= $app['id'] ?>" 
                                   class="action-link text-rose-500 hover:text-rose-700">
                                   Reject
                                </a>
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
    $('#applicationsTable').DataTable({
        "pageLength": 10,
        "ordering": true,
        "responsive": true,
        "language": {
            "search": "",
            "searchPlaceholder": "Search applications..."
        }
    });
});
</script>

<?php require '../includes/footer.php'; ?>