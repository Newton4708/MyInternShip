<?php
// app/Controllers/AuthController.php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/User.php';

class AuthController extends Controller {
    public function loginForm() {
        // Affiche la vue de connexion
        $this->render('auth/login');
    }
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer les valeurs du formulaire
            $login = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            $userModel = new User();
            $user = $userModel->findByEmail($login);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    // Enregistrer les informations de l'utilisateur en session
                    $_SESSION['user'] = [
                        'id'      => $user['id'],
                        'statut'  => $user['statut'],
                        'prenom'  => $user['prenom'],
                        'nom'     => $user['nom'],
                        'email'   => $user['email']
                    ];
                    // Redirection selon le rôle
                    if ($user['statut'] == 'etudiant') {
                        header("Location: $BASE_URL./index.php?controller=dashboard&action=student");
                    } elseif ($user['statut'] == 'pilote') {
                        header("Location: $BASE_URL./index.php?controller=dashboard&action=pilot");
                    } elseif ($user['statut'] == 'administrateur') {
                        header("Location: $BASE_URL./index.php?controller=dashboard&action=admin");
                    }
                    exit();
                } else {
                    $error = "Mot de passe incorrect";
                }
            } else {
                $error = "Aucun utilisateur trouvé avec cet email";
            }
        }
        // Affiche la vue login
        $this->render('auth/login', ['error' => $error ?? null]);
    }
    
    public function logout() {
        session_start();
        $_SESSION = [];
        session_destroy();
        header("Location:  $BASE_URL./index.php?controller=auth&action=login");
        exit();
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $prenom = trim($_POST["prenom"]);
            $nom = trim($_POST["nom"]);
            $email = trim($_POST["email"]);
            $statut = $_POST["statut"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirm_password"];
        
            if (empty($statut) || empty($prenom) || empty($nom) || empty($email) || empty($password) || empty($confirmPassword)) {
                $error = "Tous les champs sont requis !";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email invalide !";
            } elseif (strlen($password) < 8) {
                $error = "Le mot de passe doit contenir au moins 8 caractères !";
            } elseif ($password !== $confirmPassword) {
                $error = "Les mots de passe ne correspondent pas !";
            }
        
            if (!isset($error)) {
                $userModel = new User();
                if ($userModel->findByEmail($email)) {
                    $error = "Cet email est déjà utilisé !";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $db = Database::getInstance();
                    $stmt = $db->prepare("INSERT INTO utilisateurs (statut, prenom, nom, email, password) VALUES (:statut, :prenom, :nom, :email, :password)");
                    $result = $stmt->execute([
                        ':statut' => $statut,
                        ':prenom' => $prenom,
                        ':nom'    => $nom,
                        ':email'  => $email,
                        ':password' => $hashedPassword
                    ]);
                    if ($result) {
                        // Enregistrement réussi, redirection vers la page de connexion
                        header("Location: $BASE_URL./index.php?controller=auth&action=login");
                        exit();
                    } else {
                        $error = "Erreur lors de l'inscription.";
                    }
                }
            }
        }
        $this->render('auth/inscription', ['error' => $error ?? null]);
    }
}

