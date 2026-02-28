<?php
require '../includes/auth.php';
require '../includes/hierarchy.php';

// Logic Preserved: Downline user IDs and Fetching transactions
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <style>
        body { background-color: #f8fafc; margin: 0; font-family: 'Inter', sans-serif; }
        .main-content { margin-left: 260px; padding: 40px; }
        .data-card { background: white; border-radius: 24px; border: 1px solid #e2e8f0; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .filter-bar { background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px; margin-bottom: 30px; }
        
        .form-control { 
            background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 8px; 
            padding: 8px 12px; font-size: 0.85rem; color: #1e293b; font-weight: 500;
        }
        .form-control:focus { outline: none; border-color: #4f46e5; background: white; }

        /* DataTables Custom UI */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e2e8f0; border-radius: 10px; padding: 6px 12px; outline: none; margin-bottom: 15px;
        }
        table.dataTable thead th { 
            background: #f8fafc; padding: 14px !important; font-size: 11px; 
            text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; border-bottom: 1px solid #e2e8f0 !important;
        }
        table.dataTable tbody td { padding: 16px !important; border-bottom: 1px solid #f1f5f9; font-size: 13px; }
    </style>
</head>

<div class="main-content">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Commission Ledger</h2>
            <p class="text-slate-500 text-sm font-medium">Detailed breakdown of earnings from your personal sales and network growth.</p>
        </div>
        <div class="flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-700 rounded-xl text-xs font-bold border border-emerald-100 shadow-sm">
            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span> Ledger Verified
        </div>
    </div>

    <div class="filter-bar shadow-sm">
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
                <select name="service_id" class="form-control min-w-[150px]">
                    <option value="">All Services</option>
                    <?php
                    // Logic Preserved: Active Services Fetch
                    $services = $pdo->query("SELECT id, service_name FROM services WHERE is_active = 1")->fetchAll();
                    foreach ($services as $s) {
                        echo "<option value='{$s['id']}'>" . htmlspecialchars($s['service_name']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center gap-2 shadow-lg shadow-indigo-100 transform active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export CSV
            </button>
        </form>
    </div>

    <div class="data-card">
        <table id="commissionTable" class="display w-full">
            <thead>
                <tr>
                    <th>Lead ID</th>
                    <th>Customer Name</th>
                    <th class="text-right">Earnings</th>
                    <th class="text-right">Transaction Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($transactions as $t): ?>
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td>
                        <span class="text-xs font-mono font-bold text-indigo-600 bg-indigo-50 px-2 py-1 rounded-lg">#<?= $t['lead_id'] ?></span>
                    </td>
                    <td>
                        <div class="text-sm font-bold text-slate-700"><?= htmlspecialchars($t['customer_name']) ?></div>
                    </td>
                    <td class="text-right">
                        <div class="text-sm font-black text-emerald-600">+₹<?= number_format($t['commission_amount'], 2) ?></div>
                    </td>
                    <td class="text-right">
                        <div class="text-[13px] font-bold text-slate-600"><?= date('M j, Y', strtotime($t['created_at'])) ?></div>
                        <div class="text-[10px] text-slate-400 uppercase"><?= date('g:i A', strtotime($t['created_at'])) ?></div>
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
        "pageLength": 10,
        "order": [[ 3, "desc" ]], // Sort by date desc by default
        "language": {
            "search": "",
            "searchPlaceholder": "Search by lead or customer...",
            "emptyTable": "No commission transactions found in your network."
        },
        "drawCallback": function() {
            // Styles for the pagination buttons
            $('.paginate_button').addClass('rounded-lg font-bold text-xs');
        }
    });
});
</script>

<?php require '../includes/footer.php'; ?>