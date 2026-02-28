<?php
require '../includes/middleware_admin.php';
require '../includes/db.php';
require '../includes/header.php';
require '../includes/sidebar.php';

// Fetch roles except Company (Logic Preserved)
$roles = $pdo->query("
    SELECT id, role_name, hierarchy_level
    FROM roles
    WHERE hierarchy_level > 1
")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $role_id = $_POST['role_id'];
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Validate role (Logic Preserved)
    $stmt = $pdo->prepare("
        SELECT hierarchy_level FROM roles WHERE id = ?
    ");
    $stmt->execute([$role_id]);
    $new_role_level = $stmt->fetchColumn();

    if (!$new_role_level || $new_role_level <= 1) {
        die("Invalid role selection.");
    }

    // Insert user (parent = Admin) (Logic Preserved)
    $stmt = $pdo->prepare("
        INSERT INTO users 
        (role_id, parent_id, full_name, email, phone, password_hash)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $role_id,
        $_SESSION['user_id'],
        $name,
        $email,
        $phone,
        $password
    ]);

    header("Location: users.php");
    exit;
}
?>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; margin: 0; font-family: 'Inter', sans-serif; }
        .form-container { max-width: 800px; margin: 0 auto; }
        .input-card { background: white; border-radius: 24px; border: 1px solid #e2e8f0; padding: 40px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        
        .field-label { display: block; font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; margin-left: 4px; }
        .modern-input { 
            width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; 
            font-size: 0.95rem; color: #1e293b; background: #fcfcfd; transition: all 0.2s;
        }
        .modern-input:focus { outline: none; border-color: #4f46e5; background: white; ring: 4px; ring-color: rgba(79, 70, 229, 0.1); }
        
        .role-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.2em;
        }
    </style>
</head>

<div class="admin-main">
    <div class="form-container">
        <div class="mb-8">
            <a href="users.php" class="text-xs font-bold text-indigo-600 uppercase tracking-widest flex items-center gap-2 mb-2 hover:text-indigo-800 transition-colors">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Back to User Management
            </a>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Create System User</h2>
            <p class="text-slate-500 text-sm mt-1">Register a new partner, manager, or agent into the hierarchy.</p>
        </div>

        <form method="POST" class="input-card">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <label class="field-label">Full Name</label>
                    <input type="text" name="full_name" class="modern-input" placeholder="User Name" required>
                </div>

                <div>
                    <label class="field-label">Assigned Role</label>
                    <select name="role_id" class="modern-input role-select" required>
                        <option value="" disabled selected>Select a role level...</option>
                        <?php foreach($roles as $role): ?>
                            <option value="<?= $role['id'] ?>">
                                <?= htmlspecialchars($role['role_name']) ?> (Level <?= $role['hierarchy_level'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="field-label">Email Address</label>
                    <input type="email" name="email" class="modern-input" placeholder="User Email" required>
                </div>

                <div>
                    <label class="field-label">Phone Number</label>
                    <input type="text" name="phone" class="modern-input" placeholder="User Contact Number">
                </div>

                <div class="md:col-span-2">
                    <label class="field-label">System Password</label>
                    <input type="password" name="password" class="modern-input" placeholder="••••••••" required>
                    <p class="text-[10px] text-slate-400 mt-2 italic">User can change this password after their first login via Profile settings.</p>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-2 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    <span class="text-[11px] font-medium">Secure Enrollment Process</span>
                </div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-10 rounded-xl shadow-lg shadow-indigo-100 transition-all transform active:scale-95">
                    Create Account
                </button>
            </div>
        </form>
    </div>
</div>

<?php require '../includes/footer.php'; ?>