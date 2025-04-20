<?php
require_once 'class/Music.php';
require_once 'class/User.php';
require_once 'class/Playlist.php';
require_once 'class/PlaylistRelation.php';

$music = new Music();
$user = new User();
$playlist = new Playlist();
$playlistRelation = new PlaylistRelation();

// Music CRUD Operations
if (isset($_POST['add_music'])) {
    $music->createMusic($_POST['title'], $_POST['artist']);
    header("Location: index.php?page=music");
    exit;
}

if (isset($_POST['update_music'])) {
    $music->updateMusic($_POST['id'], $_POST['title'], $_POST['artist']);
    header("Location: index.php?page=music");
    exit;
}

if (isset($_GET['delete']) && $_GET['page'] == 'music') {
    $music->deleteMusic($_GET['delete']);
    header("Location: index.php?page=music");
    exit;
}

// User CRUD Operations
if (isset($_POST['add_user'])) {
    $user->createUser($_POST['username']);
    header("Location: index.php?page=users");
    exit;
}

if (isset($_POST['update_user'])) {
    $user->updateUser($_POST['id'], $_POST['username']);
    header("Location: index.php?page=users");
    exit;
}

if (isset($_GET['delete']) && $_GET['page'] == 'users') {
    $user->deleteUser($_GET['delete']);
    header("Location: index.php?page=users");
    exit;
}

// Playlist CRUD Operations
if (isset($_POST['add_playlist'])) {
    $playlist->createPlaylist($_POST['name'], $_POST['user_id']);
    header("Location: index.php?page=playlists");
    exit;
}

if (isset($_POST['update_playlist'])) {
    $playlist->updatePlaylist($_POST['id'], $_POST['name'], $_POST['user_id']);
    header("Location: index.php?page=playlists");
    exit;
}

if (isset($_GET['delete']) && $_GET['page'] == 'playlists') {
    $playlist->deletePlaylist($_GET['delete']);
    header("Location: index.php?page=playlists");
    exit;
}

// Playlist Relations Operations
if (isset($_POST['add_to_playlist'])) {
    $playlist->addMusicToPlaylist($_POST['playlist_id'], $_POST['music_id']);
    header("Location: index.php?page=playlist_details&id=" . $_POST['playlist_id']);
    exit;
}

if (isset($_GET['remove']) && isset($_GET['id']) && $_GET['page'] == 'playlist_details') {
    $playlist->removeMusicFromPlaylist($_GET['id'], $_GET['remove']);
    header("Location: index.php?page=playlist_details&id=" . $_GET['id']);
    exit;
}

// Load data for views
$page = isset($_GET['page']) ? $_GET['page'] : 'music';

if ($page == 'music') {
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $musicList = $music->getAllMusic($search);
    
    if (isset($_GET['edit'])) {
        $editMusic = $music->getMusicById($_GET['edit']);
    }
}

if ($page == 'users' || $page == 'playlists') {
    $usersList = $user->getAllUsers();
    
    if ($page == 'users' && isset($_GET['edit'])) {
        $editUser = $user->getUserById($_GET['edit']);
    }
}

if ($page == 'playlists') {
    $playlistsList = $playlist->getAllPlaylists();
    
    if (isset($_GET['edit'])) {
        $editPlaylist = $playlist->getPlaylistById($_GET['edit']);
    }
}

if ($page == 'playlist_details' && isset($_GET['id'])) {
    $playlist_id = $_GET['id'];
    // FIX: Use a different variable name for the playlist data
    $playlistData = $playlist->getPlaylistById($playlist_id);
    $playlistMusic = $playlist->getPlaylistMusic($playlist_id);
    $allMusic = $music->getAllMusic();
}

if ($page == 'relations') {
    $relationsList = $playlistRelation->getAllRelations();
    $playlistsList = $playlist->getAllPlaylists();
    $musicList = $music->getAllMusic();
    
    if (isset($_GET['edit'])) {
        $editRelation = $playlistRelation->getRelationById($_GET['edit']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MelodyMuse</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'view/header.php'; ?>
    <main>
        <nav class="main-nav">
            <a href="?page=music" class="<?php echo $page == 'music' ? 'active' : ''; ?>">Music</a>
            <a href="?page=users" class="<?php echo $page == 'users' ? 'active' : ''; ?>">Users</a>
            <a href="?page=playlists" class="<?php echo $page == 'playlists' ? 'active' : ''; ?>">Playlists</a>
        </nav>

        <?php
        if ($page == 'music') include 'view/music.php';
        elseif ($page == 'users') include 'view/users.php';
        elseif ($page == 'playlists') include 'view/playlists.php';
        elseif ($page == 'playlist_details') include 'view/playlist_details.php';
        else include 'view/music.php';
        ?>
    </main>
    <?php include 'view/footer.php'; ?>
</body>
</html>