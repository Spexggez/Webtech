<?php require_once 'View/partials/header.php'; ?>

<div class="admin-layout">
    <?php 
    $activeNav = 'roster';
    require_once 'View/partials/captain_sidebar.php'; 
    ?>

    <div class="admin-main">
        <div class="card wide">
            <h2>Add New Player</h2>
            <form action="index.php" method="POST" class="inline-form" style="gap: 10px;">
                <input type="hidden" name="action" value="add_roster">
                <input type="text" name="ign" placeholder="In-Game Name" required style="flex: 1;">
                <input type="text" name="real_name" placeholder="Real Name" required style="flex: 1;">
                <input type="text" name="phone" placeholder="Phone" required style="flex: 1;">
                <button type="submit" style="background: var(--green); margin-top: 0;">Add Player</button>
            </form>
        </div>

        <div class="card wide">
            <h2>Active Team Roster</h2>
            <table>
                <thead>
                    <tr>
                        <th>IGN</th>
                        <th>Real Name</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($roster as $member) { ?>
                    <tr id="row-<?php echo $member['id']; ?>">
                        <form action="index.php" method="POST" class="inline-form">
                            <input type="hidden" name="action" value="edit_roster">
                            <input type="hidden" name="member_id" value="<?php echo $member['id']; ?>">
                            
                            <td><input type="text" name="ign" value="<?php echo htmlspecialchars($member['ign']); ?>" required></td>
                            <td><input type="text" name="real_name" value="<?php echo htmlspecialchars($member['real_name']); ?>" required></td>
                            <td><input type="text" name="phone" value="<?php echo htmlspecialchars($member['phone']); ?>" required></td>
                            
                            <td style="display: flex; gap: 5px;">
                                <button type="submit" style="padding: 6px 12px; margin:0;">Save</button>
                                <button type="button" class="danger" onclick="deleteMember(<?php echo $member['id']; ?>)" style="padding: 6px 12px; margin:0;">Remove</button>
                            </td>
                        </form>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function deleteMember(memberId) {
    if (confirm("Remove this player from the roster?")) {
        var payload = { action: 'delete_roster', id: memberId };

        fetch('index.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status == 'success') {
                document.getElementById('row-' + memberId).remove();
            }
        });
    }
}
</script>

<?php require_once 'View/partials/footer.php'; ?>