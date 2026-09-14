<?php
$activeNav = $activeNav ?? '';
?>
<div class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-badge">CS</div>
        <div>
            <div class="sidebar-title">ClubSphere</div>
            <div class="sidebar-subtitle">Captain: <?php echo htmlspecialchars($_SESSION['ign'] ?? ''); ?></div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="index.php?action=dashboard" class="<?php echo $activeNav == 'dashboard' ? 'active' : ''; ?>">Dashboard</a>
        <a href="index.php?action=roster" class="<?php echo $activeNav == 'roster' ? 'active' : ''; ?>">Manage Roster</a>
        <a href="index.php?action=tournaments" class="<?php echo $activeNav == 'tournaments' ? 'active' : ''; ?>">Tournaments</a>
        <a href="index.php?action=logout" style="color: var(--red); margin-top: 20px;">Logout</a>
    </nav>
</div>