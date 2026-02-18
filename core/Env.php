<?php
/**
 * Classe de gestion des variables d'environnement
 */
class Env {
    private static $variables = [];
    private static $loaded = false;

    public static function load($path = '.env') {
        if (self::$loaded) {
            return;
        }

        if (!file_exists($path)) {
            throw new Exception("Fichier .env introuvable: $path");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            // Ignorer les commentaires
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Parser les variables
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                
                // Supprimer les guillemets
                if ((strpos($value, '"') === 0 && strrpos($value, '"') === strlen($value) - 1) ||
                    (strpos($value, "'") === 0 && strrpos($value, "'") === strlen($value) - 1)) {
                    $value = substr($value, 1, -1);
                }
                
                self::$variables[$key] = $value;
            }
        }

        self::$loaded = true;
    }

    public static function get($key, $default = null) {
        return self::$variables[$key] ?? $default;
    }

    public static function set($key, $value) {
        self::$variables[$key] = $value;
    }
}
