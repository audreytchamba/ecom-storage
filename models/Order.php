<?php
/**
 * Modèle commande
 */
class Order extends Model {
    
    protected $table = 'orders';
    
    public function findAll() {
        return $this->fetchAll("SELECT * FROM {$this->table} ORDER BY created_at DESC");
    }
    
    public function findById($id) {
        return $this->fetchOne("SELECT * FROM {$this->table} WHERE id = ?", [$id]);
    }
    
    public function getByUserId($userId) {
        return $this->fetchAll(
            "SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY created_at DESC",
            [$userId]
        );
    }
    
    public function getRecent($limit = 10) {
        return $this->fetchAll(
            "SELECT o.*, u.full_name FROM {$this->table} o 
             JOIN users u ON o.user_id = u.id 
             ORDER BY o.created_at DESC LIMIT ?",
            [$limit]
        );
    }
    
    public function getAllWithDetails() {
        return $this->fetchAll(
            "SELECT o.*, u.full_name, u.email,
             (SELECT COUNT(*) FROM order_items WHERE order_id = o.id) as items_count
             FROM {$this->table} o
             JOIN users u ON o.user_id = u.id
             ORDER BY o.created_at DESC"
        );
    }
    
    public function create($data) {
        return $this->insert($this->table, $data);
    }
    
    public function updateTotal($id, $total) {
        return parent::update($this->table, ['total' => $total], 'id = ?', [$id]);
    }
    
    public function updateStatus($id, $status) {
        return parent::update($this->table, ['status' => $status], 'id = ?', [$id]);
    }
    
    public function getAll() {
        return $this->findAll();
    }
}