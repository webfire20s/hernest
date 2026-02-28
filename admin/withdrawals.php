<?php
require '../includes/sidebar.php';
require '../includes/middleware_admin.php';

// Logic Preserved: Hierarchy Check
if ($currentUser['hierarchy_level'] != 1) {
    die("Access Denied");
}
    
// Logic Preserved: Approve Handler
if (isset($_GET['approve'])) {
    $id = intval($_GET['approve']);
    $stmt = $pdo->prepare("
        UPDATE withdrawals 
        SET status = 'Approved',
            processed_at = NOW()
            WHERE id = ?
    ");
    $stmt->execute([$id]);
    header("Location: withdrawals.php");
    exit;
}

// Logic Preserved: Reject Handler
if (isset($_GET['reject'])) {
    $id = intval($_GET['reject']);
    $stmt = $pdo->prepare("
        UPDATE withdrawals 
        SET status = 'Rejected',
            processed_at = NOW()
        WHERE id = ?
    ");
    $stmt->execute([$id]);
    header("Location: withdrawals.php");
    exit;
}

// Fetch requests (Logic Preserved)
$stmt = $pdo->query("
    SELECT w.*, u.full_name
    FROM withdrawals w
    JOIN users u ON w.user_id = u.id
    ORDER BY w.requested_at DESC
");
$withdrawals = $stmt->fetchAll();
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: 'Inter', sans-serif; }
        .data-card { background: white; border-radius: 24px; border: 1px solid #e2e8f0; padding: 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        
        /* DataTables Styling */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e2e8f0; border-radius: 12px; padding: 8px 16px; margin-bottom: 20px; outline: none;
        }
        table.dataTable thead th { 
            background: #f8fafc; padding: 16px !important; font-size: 11px; 
            text-transform: uppercase; letter-spacing: 0.1em; color: #64748b; border-bottom: 1px solid #e2e8f0 !important;
        }
        table.dataTable tbody td { padding: 16px !important; border-bottom: 1px solid #f1f5f9; font-size: 14px; }

        /* Status Badges */
        .w-badge { padding: 4px 10px; border-radius: 8px; font-size: 10px; font-weight: 800; text-transform: uppercase; }
        .w-pending { background: #fffbeb; color: #b45309; border: 1px solid #fef3c7; }
        .w-approved { background: #ecfdf5; color: #047857; border: 1px solid #d1fae5; }
        .w-rejected { background: #fff1f2; color: #be123c; border: 1px solid #ffe4e6; }

        /* Action Buttons */
        .btn-approve { background: #10b981; color: white; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; transition: 0.2s; }
        .btn-approve:hover { background: #059669; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2); }
        .btn-reject { background: #f43f5e; color: white; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; transition: 0.2s; }
        .btn-reject:hover { background: #e11d48; box-shadow: 0 4px 12px rgba(244, 63, 94, 0.2); }
    </style>
</head>

<div class="admin-main">
    <div class="mb-10 flex justify-between items-end">
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Withdrawal Requests</h2>
            <p class="text-slate-500 text-sm mt-1">Review and process partner payout requests.</p>
        </div>
        <div class="bg-slate-900 text-white px-4 py-2 rounded-2xl flex items-center gap-3">
            <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
            <span class="text-xs font-bold uppercase tracking-widest">Payout Queue Live</span>
        </div>
    </div>

    <div class="data-card">
        <table id="withdrawalsTable" class="display w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Partner Name</th>
                    <th>Amount</th>
                    <th>Requested At</th>
                    <th>Status</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($withdrawals as $w): 
                    $statusClass = 'w-pending';
                    if($w['status'] == 'Approved') $statusClass = 'w-approved';
                    if($w['status'] == 'Rejected') $statusClass = 'w-rejected';
                ?>
                <tr>
                    <td class="font-mono text-xs text-slate-400">#<?= $w['id'] ?></td>
                    <td class="font-bold text-slate-800"><?= htmlspecialchars($w['full_name']) ?></td>
                    <td class="font-black text-slate-900 text-lg">₹<?= number_format($w['amount'], 2) ?></td>
                    <td class="text-xs text-slate-500 font-medium"><?= date('M d, Y • h:i A', strtotime($w['requested_at'])) ?></td>
                    <td>
                        <span class="w-badge <?= $statusClass ?>"><?= $w['status'] ?></span>
                    </td>
                    <td class="text-right">
                        <?php if($w['status'] == 'Pending'): ?>
                            <div class="flex justify-end gap-2">
                                <a href="?approve=<?= $w['id'] ?>" class="btn-approve" onclick="return confirm('Approve this withdrawal?')">Approve</a>
                                <a href="?reject=<?= $w['id'] ?>" class="btn-reject" onclick="return confirm('Reject this withdrawal?')">Reject</a>
                            </div>
                        <?php else: ?>
                            <span class="text-[10px] font-bold text-slate-300 uppercase italic tracking-widest">
                                Processed <?= $w['processed_at'] ? 'on '.date('M d', strtotime($w['processed_at'])) : '' ?>
                            </span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#withdrawalsTable').DataTable({
        "pageLength": 10,
        "order": [[ 0, "desc" ]],
        "language": {
            "search": "",
            "searchPlaceholder": "Filter requests..."
        }
    });
});
</script>

<?php require '../includes/footer.php'; ?>