<?php require_once 'View/partials/header.php'; ?>

<div class="admin-layout">
    <?php 
    $activeNav = 'dashboard';
    require_once 'View/partials/captain_sidebar.php'; 
    ?>

    <div class="admin-main">
        <div class="admin-stats">
            <div class="stat-box" style="border-left: 4px solid var(--blue);">
                <div class="stat-icon blue">📋</div>
                <div>
                    <div class="stat-value">Roster</div>
                    <div class="stat-label">Manage active roster</div>
                </div>
            </div>
            
            <div class="stat-box" style="border-left: 4px solid var(--red);">
                <div class="stat-icon purple" style="background: var(--red);">📸</div>
                <div>
                    <div class="stat-value">Score Proof</div>
                    <div class="stat-label">Submit match evidence</div>
                </div>
            </div>
        </div>

        <div class="card wide">
            <h2>Submit Match Score Evidence</h2>
            <p class="sidebar-subtitle">Self-report match outcomes and upload screenshot evidence for Moderator review.</p>
            
            <form action="index.php" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
                <input type="hidden" name="action" value="submit_score">
                
                <label>Select Tournament</label>
                <select name="tournament_id" required>
                    <option value="">-- Choose Active Tournament --</option>
                    <?php foreach($tournaments as $tournament) { ?>
                        <option value="<?php echo $tournament['id']; ?>"><?php echo htmlspecialchars($tournament['title']); ?></option>
                    <?php } ?>
                </select>
                
                <label>Match Score</label>
                <input type="text" name="score" placeholder="e.g., 13-10 or 2-0" required>
                
                <label>Upload Screenshot Proof</label>
                <input type="file" name="screenshot" accept="image/png, image/jpeg" required style="padding: 10px 0;">
                
                <button type="submit">Upload Proof</button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'View/partials/footer.php'; ?>