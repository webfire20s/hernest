<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';

// Total Users (Logic Preserved)
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

// Total Leads (Logic Preserved)
$totalLeads = $pdo->query("SELECT COUNT(*) FROM leads")->fetchColumn();

// Lead Status Summary (Logic Preserved)
$statusSummary = $pdo->query("
    SELECT current_status, COUNT(*) as total
    FROM leads
    GROUP BY current_status
")->fetchAll();

// Total Commission Distributed (Logic Preserved)
$totalCommission = $pdo->query("
    SELECT IFNULL(SUM(commission_amount),0)
    FROM commission_transactions
")->fetchColumn();
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: 'Inter', sans-serif; color: #1e293b; }
        /* The sidebar fix is handled in sidebar.php, but we ensure main-content alignment here */
        .admin-main-wrapper { width: 100%; box-sizing: border-box; }
        
        .glass-card { background: white; border: 1px solid #e2e8f0; border-radius: 24px; padding: 28px; }
        .dark-card { background: #0f172a; border-radius: 24px; padding: 28px; color: white; border: none; }
        
        /* DataTable Clean-up */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e2e8f0; border-radius: 10px; padding: 8px 12px; margin-bottom: 10px;
        }
        table.dataTable thead th { border-bottom: 1px solid #f1f5f9 !important; color: #64748b; font-size: 12px; text-transform: uppercase; }
    </style>
</head>

<div class="admin-main-wrapper">
    <div class="flex items-end justify-between mb-10">
        <div>
            <span class="text-indigo-600 font-bold text-xs uppercase tracking-[0.2em]">Management Console</span>
            <h1 class="text-4xl font-black tracking-tight text-slate-900 mt-1">Global Dashboard</h1>
        </div>
        <div class="hidden md:block text-right">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></span> System Live
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="glass-card shadow-sm">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Total Partners</p>
            <h3 class="text-3xl font-black text-slate-800"><?php echo number_format($totalUsers); ?></h3>
            <div class="mt-4 flex items-center text-xs font-bold text-blue-600">
                <a href="users.php">
                    <span>View Network →</span>
                </a>
            </div>
        </div>

        <div class="glass-card shadow-sm">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Total Leads</p>
            <h3 class="text-3xl font-black text-slate-800"><?php echo number_format($totalLeads); ?></h3>
            <div class="mt-4 flex items-center text-xs font-bold text-indigo-600">
                <a href="leads.php">
                    <span>View Pipeline →</span>
                </a>
            </div>
        </div>

        <div class="dark-card shadow-xl shadow-slate-200">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Commission Distributed</p>
            <h3 class="text-3xl font-black text-white">
                ₹<?php 
                    // Ensure the value is treated as a number even if null/empty
                    $displayCommission = !empty($totalCommission) ? $totalCommission : 0;
                    echo number_format((float)$displayCommission, 2); 
                ?>
            </h3>
            <div class="mt-4 flex items-center text-xs font-bold text-emerald-400">
                <span>Global Ledger Verified</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm">
        <h3 class="text-xl font-bold text-slate-800 mb-6">Lead Status Summary</h3>
        <table id="adminStatusTable" class="display w-full">
            <thead>
                <tr>
                    <th>Status</th>
                    <th class="text-right">Total Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($statusSummary as $row): ?>
                <tr>
                    <td>
                        <span class="px-3 py-1 bg-slate-100 rounded-lg text-[11px] font-bold text-slate-600 uppercase border border-slate-200">
                            <?php echo htmlspecialchars($row['current_status']); ?>
                        </span>
                    </td>
                    <td class="text-right font-black text-indigo-600 text-lg">
                        <?php echo number_format($row['total']); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#adminStatusTable').DataTable({
        "pageLength": 10,
        "ordering": true,
        "info": false,
        "language": {
            "search": "",
            "searchPlaceholder": "Search statuses..."
        }
    });
});
</script>

<?php require '../includes/footer.php'; ?>