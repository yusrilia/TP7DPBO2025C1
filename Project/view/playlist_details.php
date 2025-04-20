<section class="playlist-details">
    <h2>Playlist: <?php echo htmlspecialchars($playlistData['name']); ?></h2>
    <p>Created by: <?php echo htmlspecialchars($playlistData['username']); ?></p>
    
    <!-- Add Music to Playlist Form -->
    <div class="form-container">
        <h3>Add Music to Playlist</h3>
        <form method="POST" action="index.php?page=playlist_details&id=<?php echo $playlistData['id']; ?>">
            <input type="hidden" name="playlist_id" value="<?php echo $playlistData['id']; ?>">
            <div class="form-group">
                <label for="music_id">Music:</label>
                <select id="music_id" name="music_id" required>
                    <option value="">Select Music</option>
                    <?php foreach($allMusic as $music): ?>
                        <option value="<?php echo $music['id']; ?>">
                            <?php echo htmlspecialchars($music['title']); ?> - <?php echo htmlspecialchars($music['artist']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="add_to_playlist">Add to Playlist</button>
        </form>
    </div>
    
    <!-- Music in Playlist -->
    <div class="table-container">
        <h3>Music in Playlist</h3>
        <?php if(empty($playlistMusic)): ?>
            <p>No music in this playlist.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($playlistMusic as $music): ?>
                        <tr>
                            <td><?php echo $music['id']; ?></td>
                            <td><?php echo htmlspecialchars($music['title']); ?></td>
                            <td><?php echo htmlspecialchars($music['artist']); ?></td>
                            <td class="actions">
                                <a href="?page=playlist_details&id=<?php echo $playlistData['id']; ?>&remove=<?php echo $music['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to remove this music from the playlist?')">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    
    <a href="?page=playlists" class="back-btn">Back to Playlists</a>
</section>