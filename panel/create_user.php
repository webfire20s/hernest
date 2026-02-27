<?php
require '../includes/auth.php';

$currentLevel = $currentUser['hierarchy_level'];
$nextLevel = $currentLevel + 1;

$stmt = $pdo->prepare("SELECT id, role_name FROM roles WHERE hierarchy_level = ?");
$stmt->execute([$nextLevel]);
$role = $stmt->fetch();

if (!$role) {
    die("You cannot create any further users.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $insert = $pdo->prepare("
        INSERT INTO users (parent_id, role_id, full_name, email, password_hash)
        VALUES (?, ?, ?, ?, ?)
    ");

    $insert->execute([
        $currentUser['id'],
        $role['id'],
        $name,
        $email,
        $password
    ]);

    header("Location: users.php");
    exit;
}

require 'sidebar.php';
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: sans-serif; }
        .main-content { margin-left: 260px; padding: 60px 40px; display: flex; justify-content: center; align-items: flex-start; min-height: 100vh; }
        .form-card { width: 100%; max-width: 450px; background: white; border-radius: 24px; padding: 40px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); }
        .input-field { 
            width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; 
            font-size: 0.9rem; margin-top: 6px; transition: all 0.2s; background: #fcfcfd;
        }
        .input-field:focus { outline: none; border-color: #2563eb; background: white; ring: 3px; ring-color: rgba(37, 99, 235, 0.1); }
        .label-text { font-size: 0.7rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-left: 4px; }
    </style>
</head>

<div class="main-content">
    <div class="form-card">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Create <?= htmlspecialchars($role['role_name']) ?></h2>
            <p class="text-slate-400 text-xs mt-1 font-medium">Add a new partner to your direct network.</p>
        </div>

        <form method="POST" class="space-y-5">
            <div>
                <label class="label-text">Partner Name</label>
                <input type="text" name="full_name" class="input-field" placeholder="Full Name" required>
            </div>

            <div>
                <label class="label-text">Login Email</label>
                <input type="email" name="email" class="input-field" placeholder="Email Address" required>
            </div>

            <div>
                <label class="label-text">Secure Password</label>
                <input type="password" name="password" class="input-field" placeholder="••••••••" required>
                <p class="text-[10px] text-slate-400 mt-2 italic px-1">Ensure the password is at least 8 characters long.</p>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-100 transition-all flex items-center justify-center gap-2">
                    Confirm & Create Account
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="users.php" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest">
                Cancel Request
            </a>
        </div>
    </div>
</div>