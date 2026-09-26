<?php require_once 'View/partials/header.php'; ?>

<div class="logo-bar">ClubSphere</div>
<div class="card">
    <h2>Register New Captain</h2>
    
    <form action="index.php" method="POST" id="registerForm">
        <input type="hidden" name="action" value="register">
        
        <label>Real Name</label>
        <input type="text" name="name" required>
        
        <label>In-Game Name (IGN)</label>
        <input type="text" name="ign" required>
        
        <label>Phone Number</label>
        <input type="text" name="phone" required>
        
        <label>Email Address</label>
        <input type="email" name="email" required>
        
        <label>Primary Game</label>
        <select name="game" required>
            <option value="">Select Game</option>
            <option value="VALORANT">VALORANT</option>
            <option value="FC26">FC26</option>
            <option value="MLBB">MLBB</option>
            <option value="PUBG">PUBG</option>
        </select>
        
        <label>Password</label>
        <input type="password" name="password" id="regPassword" required>
        
        <button type="submit">Create Account</button>
        <div id="errorText" class="msg error" style="display:none; margin-top: 10px;"></div>
    </form>
    
    <div class="dash-links" style="justify-content: center; margin-top: 15px;">
        <a href="index.php?action=login_page">← Back to Login</a>
    </div>
</div>

<script>
document.getElementById('registerForm').addEventListener('submit', function(event) {
    var passwordInput = document.getElementById('regPassword').value;
    var errorDiv = document.getElementById('errorText');
    if (passwordInput.length < 6) {
        event.preventDefault();
        errorDiv.style.display = 'block';
        errorDiv.innerText = "Password must be at least 6 characters.";
    }
});
</script>

<?php require_once 'View/partials/footer.php'; ?>