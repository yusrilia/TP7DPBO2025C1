<section class="users-section">
    <h2>Users</h2>
    
    <!-- Add User Form -->
    <div class="form-container">
        <h3><?php echo isset($_GET['edit']) ? 'Edit' : 'Add'; ?> User</h3>
        <form method="POST" action="index.php?page=users">
            <?php if(isset($_GET['edit'])): ?>
                <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>">
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required value="<?php echo isset($editUser) ? htmlspecialchars($editUser['username']) : ''; ?>">
            </div>
            <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update_user' : 'add_user'; ?>">
                <?php echo isset($_GET['edit']) ? 'Update' : 'Add'; ?> User
            </button>
            <?php if(isset($_GET['edit'])): ?>
                <a href="?page=users" class="cancel-btn">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
    
    <!-- Users List -->
    <div class="table-container">
        <h3>Users List</h3>
        <?php if(empty($usersList)): ?>
            <p>No users found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usersList as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td class="actions">
                                <a href="?page=users&edit=<?php echo $user['id']; ?>" class="edit-btn">Edit</a>
                                <a href="?page=users&delete=<?php echo $user['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user? All associated playlists will also be deleted.')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>