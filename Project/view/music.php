<section class="music-section">
    <h2>Music Library</h2>
    
    <!-- Search Form -->
    <form method="GET" action="?page=music" class="search-form">
        <input type="hidden" name="page" value="music">
        <input type="text" name="search" placeholder="Search by title or artist" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit">Search</button>
        <?php if(isset($_GET['search']) && !empty($_GET['search'])): ?>
            <a href="?page=music" class="clear-search">Clear</a>
        <?php endif; ?>
    </form>
    
    <!-- Add Music Form -->
    <div class="form-container">
        <h3><?php echo isset($_GET['edit']) ? 'Edit' : 'Add'; ?> Music</h3>
        <form method="POST" action="index.php?page=music">
            <?php if(isset($_GET['edit'])): ?>
                <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>">
            <?php endif; ?>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required value="<?php echo isset($editMusic) ? htmlspecialchars($editMusic['title']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="artist">Artist:</label>
                <input type="text" id="artist" name="artist" required value="<?php echo isset($editMusic) ? htmlspecialchars($editMusic['artist']) : ''; ?>">
            </div>
            <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update_music' : 'add_music'; ?>">
                <?php echo isset($_GET['edit']) ? 'Update' : 'Add'; ?> Music
            </button>
            <?php if(isset($_GET['edit'])): ?>
                <a href="?page=music" class="cancel-btn">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
    
    <!-- Music List -->
    <div class="table-container">
        <h3>Music List</h3>
        <?php if(empty($musicList)): ?>
            <p>No music found.</p>
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
                    <?php foreach($musicList as $music): ?>
                        <tr>
                            <td><?php echo $music['id']; ?></td>
                            <td><?php echo htmlspecialchars($music['title']); ?></td>
                            <td><?php echo htmlspecialchars($music['artist']); ?></td>
                            <td class="actions">
                                <a href="?page=music&edit=<?php echo $music['id']; ?>" class="edit-btn">Edit</a>
                                <a href="?page=music&delete=<?php echo $music['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this music?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>