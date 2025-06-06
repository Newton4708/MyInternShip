<?php
// app/Models/Database.php
class Database {
    private static $instance = null;
    private $pdo;
    
    private function __construct() {
        $host = '20.16.247.171';
        $dbname = 'authentification';
        $username = 'Newton';
        $password = 'Newton@2025!';
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Vous pouvez retirer l'echo de confirmation dans l'environnement de production
            // echo "Connexion réussie à MySQL avec PDO!";
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}
