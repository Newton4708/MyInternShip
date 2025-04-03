<?php
// core/Middleware.php

class Middleware {
    public static function checkAdmin() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['statut'] !== 'administrateur') {
            header("Location: $BASE_URL./index.php?controller=auth&action=loginForm");
            exit();
        }
    }
    
    public static function checkEtudiantAdmin() {
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['statut'], ['etudiant', 'administrateur'])) {
            header("Location: $BASE_URL./index.php?controller=auth&action=loginForm");
            exit();
        }
    }

    public static function checkAuth() {
        if (!isset($_SESSION['user'])) {
            header("Location:  $BASE_URL./index.php?controller=auth&action=loginForm");
            exit();
        }
    }

    public static function checkAdminOrPilote() {
        if (!isset($_SESSION['user']) || ($_SESSION['user']['statut'] !== 'administrateur' && $_SESSION['user']['statut'] !== 'pilote')) {
            header("Location: $BASE_URL./index.php?controller=auth&action=loginForm");
            exit();
        }

    }

}
?>
