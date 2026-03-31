<?php
require 'includes/db.php';

$roles = $pdo->prepare("
    SELECT id, role_name 
    FROM roles 
    WHERE hierarchy_level > 1
");
$roles->execute();
$roles = $roles->fetchAll();

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role_id'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->fetch()) {
        $message = "Email already exists.";
    } else {

        $insert = $pdo->prepare("
            INSERT INTO partner_applications
            (full_name,email,phone,password_hash,requested_role_id,address,pincode)
            VALUES (?,?,?,?,?,?,?)
        ");

        $insert->execute([
            $name,
            $email,
            $phone,
            $password,
            $role,
            $address,
            $pincode
        ]);

        $message = "Application submitted. Waiting for admin approval.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partner Application | HERNEST</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; overflow-x: hidden; }
        .gradient-text {
            background: linear-gradient(135deg, #0f172a 0%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .form-input {
            width: 100%; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 12px;
            padding: 12px 16px; font-size: 0.9rem; font-weight: 500; color: #1e293b;
            transition: all 0.2s ease;
        }
        .form-input:focus { outline: none; border-color: #3b82f6; background: white; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
        .glass-card { background: white; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 md:p-6 bg-slate-50 relative">
    
    <div class="fixed top-0 left-0 w-full h-full bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:24px_24px] opacity-40 -z-10"></div>

    <div class="w-full max-w-md animate-in fade-in zoom-in duration-500">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Partner <span class="text-blue-600">Registration</span>
            </h1>
            <p class="text-slate-500 text-sm mt-1">Join the HERNEST distribution network</p>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-xl shadow-slate-200/60 border border-slate-100">
            
            <?php if($message): ?>
                <div class="mb-6 p-4 rounded-xl text-xs font-bold border flex items-center gap-3 <?= $isError ? 'bg-red-50 text-red-600 border-red-100' : 'bg-emerald-50 text-emerald-600 border-emerald-100' ?>">
                    <span class="w-2 h-2 rounded-full animate-pulse <?= $isError ? 'bg-red-500' : 'bg-emerald-500' ?>"></span>
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-4">
                
                <div class="space-y-1">
                    <label class="text-[10px] uppercase font-bold text-slate-400 tracking-widest ml-1">Full Name</label>
                    <input type="text" name="full_name" placeholder="Enter your name" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-sm" required>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase font-bold text-slate-400 tracking-widest ml-1">Email</label>
                        <input type="email" name="email" placeholder="Email address" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-sm" required>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase font-bold text-slate-400 tracking-widest ml-1">Phone</label>
                        <input type="text" name="phone" placeholder="Mobile number" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-sm" required>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] uppercase font-bold text-slate-400 tracking-widest ml-1">Complete Address</label>
                    <textarea name="address" rows="2" placeholder="Street, Colony, Area..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-sm resize-none" required></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase font-bold text-slate-400 tracking-widest ml-1">Pincode</label>
                        <input type="text" name="pincode" placeholder="6-digit code" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-sm" required>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase font-bold text-slate-400 tracking-widest ml-1">Partner Role</label>
                        <select name="role_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-sm appearance-none bg-white" required>
                            <option value="">Select Level</option>
                            <?php foreach($roles as $role): ?>
                                <option value="<?= $role['id'] ?>"><?= htmlspecialchars($role['role_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] uppercase font-bold text-slate-400 tracking-widest ml-1">Set Password</label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none text-sm" required>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-xl font-bold text-sm shadow-lg hover:bg-blue-600 hover:-translate-y-1 active:scale-95 transition-all duration-300 flex items-center justify-center gap-2">
                        Submit Application
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-400 font-medium tracking-tight">
                    Already a partner? <a href="login.php" class="text-blue-600 font-bold hover:underline">Sign In</a>
                </p>
            </div>
        </div>
        
        <div class="mt-6 flex justify-center gap-4 opacity-40">
            <div class="text-[9px] font-black uppercase tracking-widest text-slate-500 border border-slate-300 px-2 py-1 rounded">SSL Secure</div>
            <div class="text-[9px] font-black uppercase tracking-widest text-slate-500 border border-slate-300 px-2 py-1 rounded">Identity Verified</div>
        </div>
    </div>
</body>
</html>