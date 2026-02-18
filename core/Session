<?php
/**
 * Gestion sécurisée des sessions
 */
class Session {
    
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            // Configuration de sécurité
            ini_set('session.cookie_httponly', 1);
            ini_set('session.use_only_cookies', 1);
            ini_set('session.cookie_secure', 1);
            
            session_start();
        }
        
        // Regénérer l'ID de session périodiquement
        if (!isset($_SESSION['LAST_ACTIVITY'])) {
            $_SESSION['LAST_ACTIVITY'] = time();
        } elseif (time() - $_SESSION['LAST_ACTIVITY'] > 1800) {
            // Session expirée après 30 minutes
            session_regenerate_id(true);
            $_SESSION['LAST_ACTIVITY'] = time();
        }
    }
    
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    public static function get($key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }
    
    public static function delete($key) {
        unset($_SESSION[$key]);
    }
    
    public static function destroy() {
        $_SESSION = [];
        session_destroy();
    }
    
    public static function regenerate() {
        session_regenerate_id(true);
    }
}