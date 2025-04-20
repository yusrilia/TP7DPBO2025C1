<?php
require_once 'config/db.php';

class User {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT * FROM user");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($username) {
        $stmt = $this->db->prepare("INSERT INTO user (username) VALUES (?)");
        return $stmt->execute([$username]);
    }

    public function updateUser($id, $username) {
        $stmt = $this->db->prepare("UPDATE user SET username = ? WHERE id = ?");
        return $stmt->execute([$username, $id]);
    }

    public function deleteUser($id) {
        // First delete related playlists
        $playlists = $this->db->prepare("SELECT id FROM playlist WHERE user_id = ?");
        $playlists->execute([$id]);
        
        foreach ($playlists->fetchAll(PDO::FETCH_ASSOC) as $playlist) {
            // Delete playlist relations
            $stmt = $this->db->prepare("DELETE FROM playlist_relations WHERE playlist_id = ?");
            $stmt->execute([$playlist['id']]);
        }
        
        // Delete playlists
        $stmt = $this->db->prepare("DELETE FROM playlist WHERE user_id = ?");
        $stmt->execute([$id]);
        
        // Delete user
        $stmt = $this->db->prepare("DELETE FROM user WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>