<?php
/**
 * Modèle utilisateur
 */
class User extends Model {
    
    protected $table = 'users';
    
    public function findAll() {
        return $this->fetchAll("SELECT * FROM {$this->table} ORDER BY created_at DESC");
    }
    
    public function findById($id) {
        return $this->fetchOne("SELECT * FROM {$this->table} WHERE id = ?", [$id]);
    }
    
    public function findByEmail($email) {
        return $this->fetchOne("SELECT * FROM {$this->table} WHERE email = ?", [$email]);
    }
    
    public function create($data) {
        return $this->insert($this->table, $data);
    }
    
    public function updateUser($id, $data) {
        return parent::update($this->table, $data, 'id = ?', [$id]);
    }
    
    public function updatePassword($id, $password) {
        return parent::update($this->table, ['password' => $password], 'id = ?', [$id]);
    }
    
    public function deleteUser($id) {
        return parent::delete($this->table, 'id = ?', [$id]);
    }
    
    public function getAll() {
        return $this->findAll();
    }
}