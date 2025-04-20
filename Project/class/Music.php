<?php
require_once 'config/db.php';

class Music {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllMusic($search = '') {
        if (!empty($search)) {
            $stmt = $this->db->prepare("SELECT * FROM music WHERE title LIKE ? OR artist LIKE ?");
            $searchTerm = "%$search%";
            $stmt->execute([$searchTerm, $searchTerm]);
        } else {
            $stmt = $this->db->query("SELECT * FROM music");
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMusicById($id) {
        $stmt = $this->db->prepare("SELECT * FROM music WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createMusic($title, $artist) {
        $stmt = $this->db->prepare("INSERT INTO music (title, artist) VALUES (?, ?)");
        return $stmt->execute([$title, $artist]);
    }

    public function updateMusic($id, $title, $artist) {
        $stmt = $this->db->prepare("UPDATE music SET title = ?, artist = ? WHERE id = ?");
        return $stmt->execute([$title, $artist, $id]);
    }

    public function deleteMusic($id) {
        // First delete any playlist relations
        $stmt = $this->db->prepare("DELETE FROM playlist_relations WHERE music_id = ?");
        $stmt->execute([$id]);
        
        // Then delete the music
        $stmt = $this->db->prepare("DELETE FROM music WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>