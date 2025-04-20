<?php
require_once 'config/db.php';

class PlaylistRelation {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllRelations() {
        $stmt = $this->db->query("
            SELECT pr.*, p.name as playlist_name, m.title as music_title 
            FROM playlist_relations pr
            JOIN playlist p ON pr.playlist_id = p.id
            JOIN music m ON pr.music_id = m.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRelationById($id) {
        $stmt = $this->db->prepare("
            SELECT pr.*, p.name as playlist_name, m.title as music_title 
            FROM playlist_relations pr
            JOIN playlist p ON pr.playlist_id = p.id
            JOIN music m ON pr.music_id = m.id
            WHERE pr.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createRelation($playlist_id, $music_id) {
        $stmt = $this->db->prepare("INSERT INTO playlist_relations (playlist_id, music_id) VALUES (?, ?)");
        return $stmt->execute([$playlist_id, $music_id]);
    }

    public function updateRelation($id, $playlist_id, $music_id) {
        $stmt = $this->db->prepare("UPDATE playlist_relations SET playlist_id = ?, music_id = ? WHERE id = ?");
        return $stmt->execute([$playlist_id, $music_id, $id]);
    }

    public function deleteRelation($id) {
        $stmt = $this->db->prepare("DELETE FROM playlist_relations WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>