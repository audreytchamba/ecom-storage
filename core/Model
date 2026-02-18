<?php
/**
 * Classe de base pour tous les modèles
 */
class Model {
    protected $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    protected function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    protected function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }
    
    protected function fetchOne($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }
    
    protected function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $this->query($sql, array_values($data));
        
        return $this->db->lastInsertId();
    }
    
    protected function update($table, $data, $where, $whereParams = []) {
        $set = implode(' = ?, ', array_keys($data)) . ' = ?';
        
        $sql = "UPDATE $table SET $set WHERE $where";
        $params = array_merge(array_values($data), $whereParams);
        
        $this->query($sql, $params);
        
        return true;
    }
    
    protected function delete($table, $where, $params = []) {
        $sql = "DELETE FROM $table WHERE $where";
        $this->query($sql, $params);
        
        return true;
    }
}