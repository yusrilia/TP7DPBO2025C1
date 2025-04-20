<?php
require_once 'config/db.php';

class Playlist {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllPlaylists() {
        $stmt = $this->db->query("SELECT p.*, u.username FROM playlist p JOIN user u ON p.user_id = u.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPlaylistById($id) {
        $stmt = $this->db->prepare("SELECT p.*, u.username FROM playlist p JOIN user u ON p.user_id = u.id WHERE p.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPlaylistMusic($id) {
        $stmt = $this->db->prepare("
            SELECT m.* FROM music m
            JOIN playlist_relations pr ON m.id = pr.music_id
            WHERE pr.playlist_id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPlaylist($name, $user_id) {
        $stmt = $this->db->prepare("INSERT INTO playlist (name, user_id) VALUES (?, ?)");
        return $stmt->execute([$name, $user_id]);
    }

    public function updatePlaylist($id, $name, $user_id) {
        $stmt = $this->db->prepare("UPDATE playlist SET name = ?, user_id = ? WHERE id = ?");
        return $stmt->execute([$name, $user_id, $id]);
    }

    public function deletePlaylist($id) {
        // First delete playlist relations
        $stmt = $this->db->prepare("DELETE FROM playlist_relations WHERE playlist_id = ?");
        $stmt->execute([$id]);
        
        // Then delete the playlist
        $stmt = $this->db->prepare("DELETE FROM playlist WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function addMusicToPlaylist($playlist_id, $music_id) {
        // Check if relation already exists
        $check = $this->db->prepare("SELECT id FROM playlist_relations WHERE playlist_id = ? AND music_id = ?");
        $check->execute([$playlist_id, $music_id]);
        
        if ($check->rowCount() == 0) {
            $stmt = $this->db->prepare("INSERT INTO playlist_relations (playlist_id, music_id) VALUES (?, ?)");
            return $stmt->execute([$playlist_id, $music_id]);
        }
        return false;
    }

    public function removeMusicFromPlaylist($playlist_id, $music_id) {
        $stmt = $this->db->prepare("DELETE FROM playlist_relations WHERE playlist_id = ? AND music_id = ?");
        return $stmt->execute([$playlist_id, $music_id]);
    }
}
?>