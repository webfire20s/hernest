<?php
require '../includes/auth.php';

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
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: sans-serif; }
        .main-content { margin-left: 260px; padding: 40px; }
        .data-card { background: white; border-radius: 24px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .avatar-circle {
            width: 36px;
            height: 36px;
            background: #f1f5f9;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.8rem;
            border: 1px solid #e2e8f0;
        }
        .role-badge {
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbeafe;
        }
    </style>
</head>

<div class="main-content">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">My Direct Downline</h2>
            <p class="text-slate-500 text-sm">Managing your immediate network of partners and agents.</p>
        </div>
        <a href="create_user.php" class="inline-flex items-center bg-slate-900 hover:bg-black text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-slate-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0"></path></svg>
            Create New User
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-5 rounded-2xl border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase">Active Network</p>
                <p class="text-xl font-bold text-slate-800"><?= count($downline) ?> Partners</p>
            </div>
        </div>
    </div>

    <div class="data-card">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Team Member</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Email Address</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Access Level</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if(empty($downline)): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic text-sm">You haven't added any users to your downline yet.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($downline as $user): 
                    $initials = strtoupper(substr($user['full_name'], 0, 1));
                ?>
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="avatar-circle"><?= $initials ?></div>
                            <span class="text-sm font-bold text-slate-700"><?= htmlspecialchars($user['full_name']) ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-slate-500"><?= htmlspecialchars($user['email']) ?></span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="role-badge"><?= htmlspecialchars($user['role_name']) ?></span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-slate-400 hover:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>