<?php
/**
 * Modèle produit
 */
class Product extends Model {
    
    protected $table = 'products';
    
    public function getAll($filters = []) {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];
        
        if (!empty($filters['type'])) {
            $sql .= " AND type = ?";
            $params[] = $filters['type'];
        }
        
        if (!empty($filters['capacity'])) {
            $sql .= " AND capacity = ?";
            $params[] = $filters['capacity'];
        }
        
        if (!empty($filters['min_price'])) {
            $sql .= " AND price >= ?";
            $params[] = floatval($filters['min_price']);
        }
        
        if (!empty($filters['max_price'])) {
            $sql .= " AND price <= ?";
            $params[] = floatval($filters['max_price']);
        }
        
        if (!empty($filters['search'])) {
            $sql .= " AND (name LIKE ? OR description LIKE ?)";
            $params[] = "%{$filters['search']}%";
            $params[] = "%{$filters['search']}%";
        }
        
        $sql .= " ORDER BY created_at DESC";
        
        return $this->fetchAll($sql, $params);
    }
    
    public function findById($id) {
        return $this->fetchOne("SELECT * FROM {$this->table} WHERE id = ?", [$id]);
    }
    
    public function getPromotions($limit = null) {
        $sql = "SELECT * FROM {$this->table} WHERE is_promotion = 1 ORDER BY created_at DESC";
        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
        return $this->fetchAll($sql);
    }
    
    public function getNewProducts($limit = null) {
        $sql = "SELECT * FROM {$this->table} WHERE is_new = 1 ORDER BY created_at DESC";
        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
        return $this->fetchAll($sql);
    }
    
    public function create($data) {
        return $this->insert($this->table, $data);
    }
    
    public function updateProduct($id, $data) {
        return parent::update($this->table, $data, 'id = ?', [$id]);
    }
    
    public function deleteProduct($id) {
        return parent::delete($this->table, 'id = ?', [$id]);
    }
    
    public function updateStock($id, $stock) {
        return parent::update($this->table, ['stock' => $stock], 'id = ?', [$id]);
    }
}