<?php
/**
 * Modèle avis
 */
class Review extends Model {
    
    protected $table = 'reviews';
    
    public function getByProductId($productId) {
        return $this->fetchAll(
            "SELECT r.*, u.username 
             FROM {$this->table} r
             JOIN users u ON r.user_id = u.id
             WHERE r.product_id = ?
             ORDER BY r.created_at DESC",
            [$productId]
        );
    }
    
    public function getAverageRating($productId) {
        $result = $this->fetchOne(
            "SELECT AVG(rating) as average FROM {$this->table} WHERE product_id = ?",
            [$productId]
        );
        
        return $result ? round($result['average'], 1) : 0;
    }
    
    public function create($data) {
        return $this->insert($this->table, $data);
    }
    
    public function hasUserReviewed($productId, $userId) {
        $result = $this->fetchOne(
            "SELECT COUNT(*) as count FROM {$this->table} WHERE product_id = ? AND user_id = ?",
            [$productId, $userId]
        );
        
        return $result['count'] > 0;
    }
}