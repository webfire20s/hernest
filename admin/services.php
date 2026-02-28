<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';

// Fetch all services (Logic Preserved)
$services = $pdo->query("
    SELECT * FROM services ORDER BY created_at DESC
")->fetchAll();
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
        table.dataTable tbody td { padding: 16px !important; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #1e293b; }

        .status-pill { padding: 4px 10px; border-radius: 8px; font-size: 10px; font-weight: 800; text-transform: uppercase; }
        .btn-outline { 
            font-size: 12px; font-weight: 700; padding: 6px 12px; border-radius: 8px; 
            border: 1px solid #e2e8f0; color: #64748b; transition: all 0.2s;
        }
        .btn-outline:hover { border-color: #4f46e5; color: #4f46e5; background: #f5f3ff; }
    </style>
</head>

<div class="admin-main">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Services Management</h2>
            <p class="text-slate-500 text-sm mt-1">Configure and monitor the financial services available in your network.</p>
        </div>
        <a href="create_service.php" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold text-sm transition-all shadow-lg shadow-indigo-100">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Add New Service
        </a>
    </div>

    <div class="data-card">
        <table id="servicesTable" class="display w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Service Name</th>
                    <th>Base Pricing</th>
                    <th>Availability</th>
                    <th class="text-right">Configuration</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($services as $service): ?>
                <tr>
                    <td class="font-mono text-xs text-slate-400">#<?= $service['id'] ?></td>
                    <td>
                        <div class="font-bold text-slate-800"><?= htmlspecialchars($service['service_name']) ?></div>
                    </td>
                    <td class="font-bold text-indigo-600">
                        ₹<?= number_format($service['base_price'], 2) ?>
                    </td>
                    <td>
                        <?php if($service['is_active']): ?>
                            <span class="status-pill bg-emerald-50 text-emerald-600 border border-emerald-100">Active</span>
                        <?php else: ?>
                            <span class="status-pill bg-slate-100 text-slate-400 border border-slate-200">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-right">
                        <div class="flex justify-end gap-2">
                            <a href="edit_service.php?id=<?= $service['id'] ?>" class="btn-outline">
                                Edit Details
                            </a>
                            <a href="update_commission.php?id=<?= $service['id'] ?>" class="btn-outline border-indigo-100 text-indigo-600 bg-indigo-50/50">
                                Set Commission
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
    $('#servicesTable').DataTable({
        "pageLength": 10,
        "ordering": true,
        "language": {
            "search": "",
            "searchPlaceholder": "Search services..."
        }
    });
});
</script>

<?php require '../includes/footer.php'; ?>