<?php
require '../includes/auth.php';

// Logic Preserved: Fetching direct downline only
$stmt = $pdo->prepare("
    SELECT u.id, u.full_name, u.email, r.role_name
    FROM users u
    JOIN roles r ON u.role_id = r.id
    WHERE u.parent_id = ?
");
$stmt->execute([$currentUser['id']]);
$downline = $stmt->fetchAll();

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
        
        .avatar-circle {
            width: 36px; height: 36px; background: #f1f5f9; color: #475569;
            display: flex; align-items: center; justify-content: center;
            border-radius: 10px; font-weight: 700; font-size: 0.8rem; border: 1px solid #e2e8f0;
        }
        
        .role-badge {
            padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 700;
            text-transform: uppercase; background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe;
        }

        /* DataTables Styling Overrides */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e2e8f0; border-radius: 12px; padding: 8px 16px; margin-bottom: 20px; outline: none;
        }
        table.dataTable thead th { 
            background: #f8fafc; padding: 16px !important; font-size: 11px; 
            text-transform: uppercase; letter-spacing: 0.1em; color: #64748b; border-bottom: 1px solid #e2e8f0 !important;
        }
        table.dataTable tbody td { padding: 16px !important; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
    </style>
</head>

<div class="main-content">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">My Direct Downline</h2>
            <p class="text-slate-500 text-sm mt-1">Managing your immediate network of partners and agents.</p>
        </div>
        <a href="create_user.php" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold text-sm transition-all shadow-lg shadow-indigo-100 transform active:scale-95">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0"></path></svg>
            Add Team Member
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl border border-slate-100 flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Active Network</p>
                <p class="text-xl font-black text-slate-800"><?= count($downline) ?> Partners</p>
            </div>
        </div>
    </div>

    <div class="data-card">
        <table id="downlineTable" class="display w-full">
            <thead>
                <tr>
                    <th>Team Member</th>
                    <th>Email Address</th>
                    <th>Access Level</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($downline as $user): 
                    $initials = strtoupper(substr($user['full_name'], 0, 1));
                ?>
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar-circle"><?= $initials ?></div>
                            <span class="text-sm font-bold text-slate-700"><?= htmlspecialchars($user['full_name']) ?></span>
                        </div>
                    </td>
                    <td>
                        <span class="text-sm text-slate-500 font-medium"><?= htmlspecialchars($user['email']) ?></span>
                    </td>
                    <td>
                        <span class="role-badge"><?= htmlspecialchars($user['role_name']) ?></span>
                    </td>
                    <td class="text-right">
                        <button class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#downlineTable').DataTable({
        "pageLength": 10,
        "ordering": true,
        "language": {
            "search": "",
            "searchPlaceholder": "Filter team members...",
            "emptyTable": "You haven't added any users to your downline yet."
        }
    });
});
</script>

<?php require '../includes/footer.php'; ?>