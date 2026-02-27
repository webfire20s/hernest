<?php
require '../includes/auth.php';
require '../includes/wallet.php';

if ($currentUser['hierarchy_level'] == 1) {
    header("Location: /admin/dashboard.php");
    exit;
}

$walletBalance = getUserWallet($pdo, $currentUser['id']);

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name']);

    // Update name
    $stmt = $pdo->prepare("
        UPDATE users
        SET full_name = ?
        WHERE id = ?
    ");
    $stmt->execute([$fullName, $currentUser['id']]);

    // Update password if provided
    if (!empty($_POST['new_password'])) {
        $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("
            UPDATE users
            SET password_hash = ?
            WHERE id = ?
        ");
        $stmt->execute([$newPassword, $currentUser['id']]);
    }

    $message = "Profile updated successfully.";

    // Refresh current user data
    header("Location: profile.php?updated=1");
    exit;
}

require 'sidebar.php';
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: sans-serif; }
        .main-content { margin-left: 260px; padding: 40px; }
        .profile-card { background: white; border-radius: 24px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .input-group label { display: block; font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 6px; }
        .form-input { 
            width: 100%; padding: 10px 14px; border: 1px solid #e2e8f0; border-radius: 10px; 
            font-size: 0.9rem; color: #1e293b; background: #fff; transition: all 0.2s ease;
        }
        .form-input:focus { outline: none; border-color: #2563eb; ring: 3px; ring-color: rgba(37, 99, 235, 0.1); }
        .form-input[readonly] { background: #f8fafc; color: #64748b; cursor: not-allowed; }
        .update-btn { 
            background: #2563eb; color: white; padding: 12px 24px; border-radius: 12px; 
            font-weight: 700; font-size: 0.9rem; transition: all 0.2s;
        }
        .update-btn:hover { background: #1d4ed8; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2); }
    </style>
</head>

<div class="main-content">
    
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Account Settings</h2>
        <p class="text-slate-500 text-sm">Update your personal information and manage security preferences.</p>
    </div>

    <?php if(isset($_GET['updated'])): ?>
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl text-sm font-bold flex items-center gap-2 animate-fade-in">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            Profile updated successfully.
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 space-y-6">
            <div class="profile-card p-6 text-center">
                <div class="w-20 h-20 bg-blue-600 text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4 border-4 border-blue-50">
                    <?= strtoupper(substr($currentUser['full_name'], 0, 1)) ?>
                </div>
                <h3 class="font-bold text-slate-800 text-lg"><?= htmlspecialchars($currentUser['full_name']) ?></h3>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest"><?= htmlspecialchars($currentUser['role_name']) ?></p>
                
                <div class="mt-6 pt-6 border-t border-slate-50 text-left">
                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Financial Status</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-semibold text-slate-600">Wallet Balance</span>
                        <span class="text-sm font-bold text-emerald-600">₹<?= number_format($walletBalance, 2) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="profile-card p-8">
                <form method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="input-group">
                            <label>Full Name</label>
                            <input type="text" name="full_name" class="form-input" value="<?= htmlspecialchars($currentUser['full_name']) ?>" required>
                        </div>
                        <div class="input-group">
                            <label>Email Address (Readonly)</label>
                            <input type="email" class="form-input" value="<?= htmlspecialchars($currentUser['email']) ?>" readonly>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="input-group">
                            <label>User Role</label>
                            <input type="text" class="form-input" value="<?= htmlspecialchars($currentUser['role_name']) ?>" readonly>
                        </div>
                        <div class="input-group">
                            <label>Current Wallet</label>
                            <input type="text" class="form-input" value="₹<?= number_format($walletBalance, 2) ?>" readonly>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100">
                        <div class="input-group max-w-md">
                            <label>Change Password (Optional)</label>
                            <input type="password" name="new_password" class="form-input" placeholder="Enter new password to change">
                            <p class="text-[10px] text-slate-400 mt-2 italic">Leave blank if you don't want to change your password.</p>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="update-btn">
                            Save Profile Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>