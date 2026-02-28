<?php 
// Active page detection logic (Logic preserved, just for styling)
$current_page = basename($_SERVER['PHP_SELF']); 
?>
<style>
    :root {
        --admin-sidebar-w: 280px;
        --admin-primary: #4f46e5; /* Indigo */
        --admin-bg: #1e293b;
    }

    body { margin: 0; display: flex; background-color: #f8fafc; }

    .sidebar {
        width: var(--admin-sidebar-w);
        height: 100vh;
        background: var(--admin-bg);
        color: #f1f5f9;
        position: fixed;
        left: 0;
        top: 0;
        display: flex;
        flex-direction: column;
        z-index: 1000;
        box-shadow: 4px 0 10px rgba(0,0,0,0.1);
    }

    .sidebar h3 {
        padding: 32px 24px;
        margin: 0;
        font-size: 1.25rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        display: flex;
        align-items: center;
        gap: 12px;
        color: white;
    }

    .sidebar h3::before {
        content: '';
        width: 12px;
        height: 12px;
        background: var(--admin-primary);
        border-radius: 3px;
    }

    .sidebar ul {
        list-style: none;
        padding: 0 16px;
        margin: 0;
        flex-grow: 1;
    }

    .sidebar li { margin-bottom: 4px; }

    .sidebar li a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: #94a3b8;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.2s ease;
    }

    .sidebar li a:hover {
        background: rgba(255,255,255,0.05);
        color: white;
    }

    .sidebar li a.active {
        background: var(--admin-primary);
        color: white;
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
    }

    /* Logout Styling */
    .sidebar li:last-child a {
        margin-top: 20px;
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 20px;
        color: #fb7185;
    }

    .sidebar li:last-child a:hover {
        background: #4c0519;
        color: #fff;
    }

    .main-content {
        margin-left: var(--admin-sidebar-w);
        padding: 40px;
        width: calc(100% - var(--admin-sidebar-w));
        min-height: 100vh;
    }
</style>

<div class="sidebar">
    <h3>Admin Panel</h3>
    <ul>
        <li><a href="dashboard.php" class="<?= $current_page == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
        <li><a href="users.php" class="<?= $current_page == 'users.php' ? 'active' : '' ?>">Users</a></li>
        <li><a href="leads.php" class="<?= $current_page == 'leads.php' ? 'active' : '' ?>">Leads</a></li>
        <li><a href="services.php" class="<?= $current_page == 'services.php' ? 'active' : '' ?>">Services</a></li>
        <li><a href="update_commission.php" class="<?= $current_page == 'update_commission.php' ? 'active' : '' ?>">Commissions</a></li>
        <li><a href="withdrawals.php" class="<?= $current_page == 'withdrawals.php' ? 'active' : '' ?>">Withdrawals</a></li>
        <li><a href="commission_report.php" class="<?= $current_page == 'commission_report.php' ? 'active' : '' ?>">Commission Report</a></li>
        <li><a href="export_leads.php" class="<?= $current_page == 'export_leads.php' ? 'active' : '' ?>">Export</a></li>
        <li><a href="../logout.php">Logout</a></li>
    </ul>
</div>

<div class="main-content">