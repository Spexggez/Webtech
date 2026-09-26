<?php require_once 'View/partials/header.php'; ?>

<div class="logo-bar">ClubSphere </div>
<div class="card">
    <h2>Captain Login</h2>
    
    <?php 
    $savedEmail = isset($_COOKIE['remember_email']) ? $_COOKIE['remember_email'] : "";
    if (isset($_GET['error'])) echo '<div class="msg error">Invalid email or password.</div>';
    if (isset($_GET['success'])) echo '<div class="msg success">Account created! Please log in.</div>';
    ?>
    
    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="login">
        
        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($savedEmail); ?>" required>
        
        <label>Password</label>
        <input type="password" name="password" required>
        
        <label style="display: flex; align-items: center; gap: 8px; margin-top: 15px;">
            <input type="checkbox" name="remember_me" <?php if ($savedEmail != "") echo "checked"; ?> style="width: auto;"> Remember Me
        </label>
        
        <button type="submit">Login</button>
    </form>
    
    <div class="dash-links">
        <span class="sidebar-subtitle">Don't have an account?</span>
        <a href="index.php?action=register_page">Register Here</a>
    </div>
</div>

<?php require_once 'View/partials/footer.php'; ?>