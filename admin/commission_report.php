<?php
require '../includes/middleware_admin.php';
require '../includes/header.php';
require '../includes/sidebar.php';

// Logic Preserved: Filter Construction
$conditions = [];
$params = [];

if (!empty($_GET['from']) && !empty($_GET['to'])) {
    $conditions[] = "DATE(ct.created_at) BETWEEN ? AND ?";
    $params[] = $_GET['from'];
    $params[] = $_GET['to'];
}

if (!empty($_GET['user_id'])) {
    $conditions[] = "ct.user_id = ?";
    $params[] = $_GET['user_id'];
}

$where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";

// Logic Preserved: Five-Table Join
$stmt = $pdo->prepare("
    SELECT ct.*, 
           users.full_name AS user_name,
           roles.role_name,
           leads.customer_name,
           services.service_name
    FROM commission_transactions ct
    JOIN users ON ct.user_id = users.id
    JOIN roles ON ct.role_id = roles.id
    JOIN leads ON ct.lead_id = leads.id
    JOIN services ON leads.service_id = services.id
    $where
    ORDER BY ct.created_at DESC
");
$stmt->execute($params);
$transactions = $stmt->fetchAll();
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: 'Inter', sans-serif; }
        .report-card { background: white; border-radius: 24px; border: 1px solid #e2e8f0; padding: 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        
        /* Filter Bar Styling */
        .filter-input { 
            background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; 
            padding: 8px 12px; font-size: 0.875rem; color: #475569; width: 100%;
        }
        .filter-label { font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 4px; display: block; }

        /* DataTables Customization */
        .dataTables_wrapper .dataTables_filter { display: none; } /* Using our custom filters instead */
        table.dataTable thead th { 
            background: #f8fafc; padding: 14px !important; font-size: 11px; 
            text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; border-bottom: 1px solid #e2e8f0 !important;
        }
        table.dataTable tbody td { padding: 14px !important; border-bottom: 1px solid #f1f5f9; font-size: 13px; }
    </style>
</head>

<div class="admin-main">
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Commission Report</h2>
            <p class="text-slate-500 text-sm mt-1">Detailed audit log of all generated and distributed commissions.</p>
        </div>
        <div class="flex gap-2">
            <button onclick="window.print()" class="bg-white border border-slate-200 text-slate-600 px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-slate-50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Print PDF
            </button>
        </div>
    </div>

    <div class="bg-slate-900 rounded-3xl p-6 mb-8 shadow-xl shadow-slate-200">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
            <div>
                <label class="filter-label text-slate-400">Date From</label>
                <input type="date" name="from" value="<?= $_GET['from'] ?? '' ?>" class="filter-input">
            </div>
            <div>
                <label class="filter-label text-slate-400">Date To</label>
                <input type="date" name="to" value="<?= $_GET['to'] ?? '' ?>" class="filter-input">
            </div>
            <div>
                <label class="filter-label text-slate-400">Filter User ID</label>
                <input type="number" name="user_id" value="<?= $_GET['user_id'] ?? '' ?>" class="filter-input" placeholder="e.g. 101">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="w-full bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-2 rounded-xl transition-all">
                    Apply Filters
                </button>
                <a href="commission_report.php" class="bg-slate-700 hover:bg-slate-600 text-white px-4 py-2 rounded-xl flex items-center justify-center transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </a>
            </div>
        </form>
    </div>

    <div class="report-card">
        <table id="commissionTable" class="display w-full">
            <thead>
                <tr>
                    <th>Lead</th>
                    <th>Customer</th>
                    <th>Service</th>
                    <th>Partner / Role</th>
                    <th>Earnings</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($transactions as $t): ?>
                <tr>
                    <td class="font-mono text-xs text-slate-400">#<?= $t['lead_id'] ?></td>
                    <td class="font-semibold text-slate-800"><?= htmlspecialchars($t['customer_name']) ?></td>
                    <td><span class="text-indigo-600 font-medium"><?= htmlspecialchars($t['service_name']) ?></span></td>
                    <td>
                        <div class="font-bold text-slate-900"><?= htmlspecialchars($t['user_name']) ?></div>
                        <div class="text-[10px] text-slate-400 uppercase font-black tracking-widest"><?= $t['role_name'] ?></div>
                    </td>
                    <td>
                        <div class="text-emerald-600 font-black text-base">₹<?= number_format($t['commission_amount'], 2) ?></div>
                    </td>
                    <td class="text-slate-500 text-xs">
                        <?= date('M d, Y', strtotime($t['created_at'])) ?>
                        <div class="text-[10px] text-slate-300"><?= date('H:i A', strtotime($t['created_at'])) ?></div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#commissionTable').DataTable({
        "pageLength": 25,
        "ordering": true,
        "language": {
            "emptyTable": "No commission data found for the selected period."
        }
    });
});
</script>

<?php require '../includes/footer.php'; ?>