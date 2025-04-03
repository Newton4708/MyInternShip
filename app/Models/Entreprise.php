<?php
// app/Models/User.php
require_once __DIR__ . '/Database.php';

class Entreprise {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }

}

