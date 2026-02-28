<?php $active = basename($_SERVER['PHP_SELF']); ?>
<style>
    :root { --sidebar-w: 260px; }
    .side-nav {
        width: var(--sidebar-w);
        height: 100vh;
        background: #ffffff;
        border-right: 1px solid #e2e8f0;
        position: fixed;
        left: 0;
        top: 0;
        display: flex;
        flex-direction: column;
        z-index: 1000;
    }
    .nav-brand {
        padding: 32px 24px;
        font-weight: 800;
        font-size: 1.25rem;
        color: #1e293b;
        letter-spacing: -0.025em;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .nav-list { list-style: none; padding: 0 16px; margin: 0; flex-grow: 1; }
    .nav-item { margin-bottom: 4px; }
    .nav-link {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        color: #64748b;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.2s ease;
    }
    .nav-link:hover {
        background: #f1f5f9;
        color: #1e293b;
    }
    .nav-link.active {
        background: #eff6ff;
        color: #2563eb;
    }
    .logout-box {
        padding: 24px 16px;
        border-top: 1px solid #f1f5f9;
    }
    .logout-link {
        color: #ef4444;
        background: #fef2f2;
    }
    .logout-link:hover {
        background: #fee2e2;
        color: #b91c1c;
    }
</style>

<aside class="side-nav">
    <div class="nav-brand">
        <div style="width: 32px; height: 32px; background: #2563eb; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px;">H</div>
        <span>HERNEST <span style="color: #2563eb;">.</span></span>
    </div>

    <ul class="nav-list">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?= $active == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="leads.php" class="nav-link <?= $active == 'leads.php' ? 'active' : '' ?>">Leads</a>
        </li>
        <li class="nav-item">
            <a href="submit_lead.php" class="nav-link <?= $active == 'submit_lead.php' ? 'active' : '' ?>">Submit Lead</a>
        </li>
        <li class="nav-item">
            <a href="commission.php" class="nav-link <?= $active == 'commission.php' ? 'active' : '' ?>">Commission</a>
        </li>
        <li class="nav-item">
            <a href="request_withdrawal.php" class="nav-link <?= $active == 'request_withdrawal.php' ? 'active' : '' ?>">Withdrawal</a>
        </li>
        <li class="nav-item">
            <a href="users.php" class="nav-link <?= $active == 'users.php' ? 'active' : '' ?>">My Downline</a>
        </li>
        <li class="nav-item">
            <a href="profile.php" class="nav-link <?= $active == 'profile.php' ? 'active' : '' ?>">Profile</a>
        </li>
    </ul>

    <?php if (isset($currentUser)) : ?>
    <div style="padding: 16px 24px; border-top: 1px solid #f1f5f9;">
        <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:14px;">
            <div style="font-size:0.9rem; font-weight:700; color:#1e293b;">
                <?= htmlspecialchars($currentUser['full_name']) ?>
            </div>
            <div style="font-size:0.75rem; font-weight:600; color:#64748b; margin-top:4px;">
                <?= htmlspecialchars($currentUser['role_name']) ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    

    <div class="logout-box">
        <a href="../logout.php" class="nav-link logout-link">Logout</a>
    </div>
</aside>