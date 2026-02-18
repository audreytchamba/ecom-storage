<?php
/**
 * Contrôleur des utilisateurs
 */
class UserController extends Controller {
    
    private $userModel;
    private $orderModel;
    
    public function __construct() {
        $this->userModel = new User();
        $this->orderModel = new Order();
    }
    
    public function login() {
        if ($this->isLoggedIn()) {
            $this->redirect('/');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::validateCsrfToken($_POST['csrf_token'] ?? '')) {
                die('Token CSRF invalide');
            }
            
            $email = Security::sanitize($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            
            $user = $this->userModel->findByEmail($email);
            
            if ($user && password_verify($password, $user['password'])) {
                Session::set('user_id', $user['id']);
                Session::set('user_name', $user['full_name']);
                Session::set('user_role', $user['role']);
                Session::regenerate();
                
                $this->redirect('/');
            } else {
                $_SESSION['error'] = "Email ou mot de passe incorrect";
            }
        }
        
        $this->view('user/login');
    }
    
    public function register() {
        if ($this->isLoggedIn()) {
            $this->redirect('/');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::validateCsrfToken($_POST['csrf_token'] ?? '')) {
                die('Token CSRF invalide');
            }
            
            $username = Security::sanitize($_POST['username'] ?? '');
            $email = Security::sanitize($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $fullName = Security::sanitize($_POST['full_name'] ?? '');
            
            // Validation
            $errors = [];
            
            if (strlen($username) < 3) {
                $errors[] = "Le nom d'utilisateur doit contenir au moins 3 caractères";
            }
            
            if (!Security::validateEmail($email)) {
                $errors[] = "Email invalide";
            }
            
            if (!Security::validatePassword($password)) {
                $errors[] = "Le mot de passe doit contenir au moins 8 caractères, une lettre et un chiffre";
            }
            
            if ($password !== $confirmPassword) {
                $errors[] = "Les mots de passe ne correspondent pas";
            }
            
            if (empty($errors)) {
                try {
                    $this->userModel->create([
                        'username' => $username,
                        'email' => $email,
                        'password' => password_hash($password, PASSWORD_BCRYPT),
                        'full_name' => $fullName
                    ]);
                    
                    $_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                    $this->redirect('/user/login');
                } catch (PDOException $e) {
                    if ($e->errorInfo[1] == 1062) {
                        $errors[] = "Cet email ou nom d'utilisateur existe déjà";
                    } else {
                        $errors[] = "Erreur lors de l'inscription";
                    }
                }
            }
            
            $_SESSION['errors'] = $errors;
        }
        
        $this->view('user/register');
    }
    
    public function logout() {
        Session::destroy();
        $this->redirect('/');
    }
    
    public function profile() {
        $this->requireLogin();
        
        $user = $this->userModel->findById(Session::get('user_id'));
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::validateCsrfToken($_POST['csrf_token'] ?? '')) {
                die('Token CSRF invalide');
            }
            
            $data = [
                'full_name' => Security::sanitize($_POST['full_name'] ?? ''),
                'address' => Security::sanitize($_POST['address'] ?? '')
            ];
            
            $this->userModel->updateUser(Session::get('user_id'), $data);
            Session::set('user_name', $data['full_name']);
            
            $_SESSION['success'] = "Profil mis à jour";
            $this->redirect('/user/profile');
        }
        
        $data = ['user' => $user];
        $this->view('user/profile', $data);
    }
    
    public function orders() {
        $this->requireLogin();
        
        $orders = $this->orderModel->getByUserId(Session::get('user_id'));
        
        $data = ['orders' => $orders];
        $this->view('user/orders', $data);
    }
    
    public function changePassword() {
        $this->requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/user/profile');
        }
        
        if (!Security::validateCsrfToken($_POST['csrf_token'] ?? '')) {
            die('Token CSRF invalide');
        }
        
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        $user = $this->userModel->findById(Session::get('user_id'));
        
        if (!password_verify($currentPassword, $user['password'])) {
            $_SESSION['error'] = "Mot de passe actuel incorrect";
            $this->redirect('/user/profile');
        }
        
        if (!Security::validatePassword($newPassword)) {
            $_SESSION['error'] = "Le nouveau mot de passe doit contenir au moins 8 caractères, une lettre et un chiffre";
            $this->redirect('/user/profile');
        }
        
        if ($newPassword !== $confirmPassword) {
            $_SESSION['error'] = "Les mots de passe ne correspondent pas";
            $this->redirect('/user/profile');
        }
        
        $this->userModel->updatePassword(
            Session::get('user_id'),
            password_hash($newPassword, PASSWORD_BCRYPT)
        );
        
        $_SESSION['success'] = "Mot de passe modifié avec succès";
        $this->redirect('/user/profile');
    }
}