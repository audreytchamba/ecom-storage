<?php
/**
 * Classe de base pour tous les contrôleurs
 */
class Controller {
    
    protected function view($view, $data = []) {
        extract($data);
        
        $viewPath = 'views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            require_once 'views/layouts/header.php';
            require_once $viewPath;
            require_once 'views/layouts/footer.php';
        } else {
            die("Vue non trouvée : " . $view);
        }
    }
    
    protected function redirect($url) {
        header("Location: " . $url);
        exit();
    }
    
    protected function isLoggedIn() {
        return Session::get('user_id') !== null;
    }
    
    protected function isAdmin() {
        return Session::get('user_role') === 'admin';
    }
    
    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            $this->redirect('/user/login');
        }
    }
    
    protected function requireAdmin() {
        if (!$this->isAdmin()) {
            $this->redirect('/');
        }
    }
}