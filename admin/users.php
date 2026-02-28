<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';
require '../includes/wallet.php';

// Fetch all users with role name (Logic Preserved)
$stmt = $pdo->query("
SELECT u.id, u.full_name, u.email, u.phone, 
u.wallet_balance, u.is_active,
r.role_name
FROM users u
JOIN roles r ON u.role_id = r.id
ORDER BY r.hierarchy_level ASC
");
$users = $stmt->fetchAll();
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
            border: 1px solid #e2e8f0; border-radius: 12px; padding: 8px 16px; outline: none; margin-bottom: 20px;
        }
        table.dataTable thead th { 
            background: #f8fafc; padding: 16px !important; font-size: 11px; 
            text-transform: uppercase; letter-spacing: 0.1em; color: #64748b; border-bottom: 1px solid #e2e8f0 !important;
        }
        table.dataTable tbody td { padding: 16px !important; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #1e293b; }
        
        /* Action Links */
        .action-link { font-size: 12px; font-weight: 700; transition: all 0.2s; }
        .status-badge { padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase; }
    </style>
</head>

<div class="admin-main">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">User Management</h2>
            <p class="text-slate-500 text-sm mt-1">Full administrative control over system users and roles.</p>
        </div>
        <a href="create_user.php" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold text-sm transition-all shadow-lg shadow-indigo-100">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Create New User
        </a>
    </div>

    <div class="data-card">
        <table id="usersTable" class="display w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Contact Info</th>
                    <th>Role</th>
                    <th>Wallet Balance</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <?php
                        // Calculate wallet dynamically (Logic Preserved)
                        $walletBalance = getUserWallet($pdo, $user['id']);
                        $isActive = $user['is_active'];
                    ?>
                    <tr>
                        <td class="font-mono text-xs text-slate-400">#<?= $user['id'] ?></td>
                        <td>
                            <div class="font-bold text-slate-800"><?= htmlspecialchars($user['full_name']) ?></div>
                        </td>
                        <td>
                            <div class="text-sm"><?= htmlspecialchars($user['email']) ?></div>
                            <div class="text-[11px] text-slate-400 font-medium"><?= htmlspecialchars($user['phone']) ?></div>
                        </td>
                        <td>
                            <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded text-[10px] font-black uppercase tracking-wider border border-blue-100">
                                <?= $user['role_name'] ?>
                            </span>
                        </td>
                        <td class="font-bold text-slate-900">₹<?= number_format($walletBalance, 2) ?></td>
                        <td>
                            <?php if ($isActive): ?>
                                <span class="status-badge bg-emerald-50 text-emerald-600 border border-emerald-100">Active</span>
                            <?php else: ?>
                                <span class="status-badge bg-rose-50 text-rose-600 border border-rose-100">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                <a href="toggle_user_status.php?id=<?= $user['id'] ?>" 
                                   class="action-link <?= $isActive ? 'text-rose-500 hover:text-rose-700' : 'text-emerald-500 hover:text-emerald-700' ?>">
                                   <?= $isActive ? "Deactivate" : "Activate" ?>
                                </a>
                            <?php else: ?>
                                <span class="text-[10px] font-bold text-slate-300 uppercase">You</span>
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
    $('#usersTable').DataTable({
        "pageLength": 10,
        "ordering": true,
        "responsive": true,
        "language": {
            "search": "",
            "searchPlaceholder": "Search users by name, email or role..."
        }
    });
});
</script>

<?php require '../includes/footer.php'; ?>