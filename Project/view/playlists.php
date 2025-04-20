<section class="playlists-section">
    <h2>Playlists</h2>
    
    <!-- Add Playlist Form -->
    <div class="form-container">
        <h3><?php echo isset($_GET['edit']) ? 'Edit' : 'Add'; ?> Playlist</h3>
        <form method="POST" action="index.php?page=playlists">
            <?php if(isset($_GET['edit'])): ?>
                <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>">
            <?php endif; ?>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required value="<?php echo isset($editPlaylist) ? htmlspecialchars($editPlaylist['name']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="user_id">User:</label>
                <select id="user_id" name="user_id" required>
                    <option value="">Select User</option>
                    <?php foreach($usersList as $user): ?>
                        <option value="<?php echo $user['id']; ?>" <?php echo isset($editPlaylist) && $editPlaylist['user_id'] == $user['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($user['username']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update_playlist' : 'add_playlist'; ?>">
                <?php echo isset($_GET['edit']) ? 'Update' : 'Add'; ?> Playlist
            </button>
            <?php if(isset($_GET['edit'])): ?>
                <a href="?page=playlists" class="cancel-btn">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
    
    <!-- Playlists List -->
    <div class="table-container">
        <h3>Playlists List</h3>
        <?php if(empty($playlistsList)): ?>
            <p>No playlists found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>User</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($playlistsList as $playlist): ?>
                        <tr>
                            <td><?php echo $playlist['id']; ?></td>
                            <td><?php echo htmlspecialchars($playlist['name']); ?></td>
                            <td><?php echo htmlspecialchars($playlist['username']); ?></td>
                            <td class="actions">
                                <a href="?page=playlist_details&id=<?php echo $playlist['id']; ?>" class="view-btn">View</a>
                                <a href="?page=playlists&edit=<?php echo $playlist['id']; ?>" class="edit-btn">Edit</a>
                                <a href="?page=playlists&delete=<?php echo $playlist['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this playlist?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>