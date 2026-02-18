<?php
/**
 * Modèle article de commande
 */
class OrderItem extends Model {
    
    protected $table = 'order_items';
    
    public function getByOrderId($orderId) {
        return $this->fetchAll(
            "SELECT oi.*, p.name, p.image 
             FROM {$this->table} oi
             JOIN products p ON oi.product_id = p.id
             WHERE oi.order_id = ?",
            [$orderId]
        );
    }
    
    public function create($data) {
        return $this->insert($this->table, $data);
    }
}