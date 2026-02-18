<?php
/**
 * Contrôleur d'administration
 */
class AdminController extends Controller {
    
    private $productModel;
    private $orderModel;
    private $userModel;
    
    public function __construct() {
        $this->requireAdmin();
        
        $this->productModel = new Product();
        $this->orderModel = new Order();
        $this->userModel = new User();
    }
    
    public function dashboard() {
        $stats = [
            'total_products' => count($this->productModel->getAll()),
            'total_orders' => count($this->orderModel->getAll()),
            'total_users' => count($this->userModel->getAll()),
            'recent_orders' => $this->orderModel->getRecent(5)
        ];
        
        $this->view('admin/dashboard', $stats);
    }
    
    public function products() {
        $products = $this->productModel->getAll();
        $this->view('admin/products', ['products' => $products]);
    }
    
    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::validateCsrfToken($_POST['csrf_token'] ?? '')) {
                die('Token CSRF invalide');
            }
            
            $data = [
                'name' => Security::sanitize($_POST['name'] ?? ''),
                'description' => Security::sanitize($_POST['description'] ?? ''),
                'price' => floatval($_POST['price'] ?? 0),
                'stock' => intval($_POST['stock'] ?? 0),
                'type' => $_POST['type'] ?? '',
                'capacity' => Security::sanitize($_POST['capacity'] ?? ''),
                'speed' => Security::sanitize($_POST['speed'] ?? ''),
                'interface' => Security::sanitize($_POST['interface'] ?? ''),
                'is_promotion' => isset($_POST['is_promotion']) ? 1 : 0,
                'is_new' => isset($_POST['is_new']) ? 1 : 0
            ];
            
            // Gestion de l'image
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxSize = 2 * 1024 * 1024; // 2MB
                
                if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                    $_SESSION['error'] = "Type de fichier non autorisé";
                    $this->redirect('/admin/products');
                }
                
                if ($_FILES['image']['size'] > $maxSize) {
                    $_SESSION['error'] = "Fichier trop volumineux (max 2MB)";
                    $this->redirect('/admin/products');
                }
                
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = uniqid() . '.' . $extension;
                $uploadPath = 'uploads/products/' . $filename;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    $data['image'] = $filename;
                }
            }
            
            $this->productModel->create($data);
            $_SESSION['success'] = "Produit ajouté avec succès";
            $this->redirect('/admin/products');
        }
        
        $this->view('admin/edit_product');
    }
    
    public function editProduct($id) {
        $product = $this->productModel->findById($id);
        
        if (!$product) {
            $this->redirect('/admin/products');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Security::validateCsrfToken($_POST['csrf_token'] ?? '')) {
                die('Token CSRF invalide');
            }
            
            $data = [
                'name' => Security::sanitize($_POST['name'] ?? ''),
                'description' => Security::sanitize($_POST['description'] ?? ''),
                'price' => floatval($_POST['price'] ?? 0),
                'stock' => intval($_POST['stock'] ?? 0),
                'type' => $_POST['type'] ?? '',
                'capacity' => Security::sanitize($_POST['capacity'] ?? ''),
                'speed' => Security::sanitize($_POST['speed'] ?? ''),
                'interface' => Security::sanitize($_POST['interface'] ?? ''),
                'is_promotion' => isset($_POST['is_promotion']) ? 1 : 0,
                'is_new' => isset($_POST['is_new']) ? 1 : 0
            ];
            
            // Gestion de l'image
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                // Supprimer l'ancienne image
                if ($product['image'] && file_exists('uploads/products/' . $product['image'])) {
                    unlink('uploads/products/' . $product['image']);
                }
                
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxSize = 2 * 1024 * 1024;
                
                if (in_array($_FILES['image']['type'], $allowedTypes) && $_FILES['image']['size'] <= $maxSize) {
                    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $filename = uniqid() . '.' . $extension;
                    $uploadPath = 'uploads/products/' . $filename;
                    
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                        $data['image'] = $filename;
                    }
                }
            }
            
            $this->productModel->updateProduct($id, $data);
            $_SESSION['success'] = "Produit modifié avec succès";
            $this->redirect('/admin/products');
        }
        
        $this->view('admin/edit_product', ['product' => $product]);
    }
    
    public function deleteProduct($id) {
        if (!Security::validateCsrfToken($_GET['csrf_token'] ?? '')) {
            die('Token CSRF invalide');
        }
        
        $product = $this->productModel->findById($id);
        
        if ($product && $product['image']) {
            $imagePath = 'uploads/products/' . $product['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        $this->productModel->deleteProduct($id);
        $_SESSION['success'] = "Produit supprimé";
        $this->redirect('/admin/products');
    }
    
    public function orders() {
        $orders = $this->orderModel->getAllWithDetails();
        $this->view('admin/orders', ['orders' => $orders]);
    }
    
    public function updateOrderStatus() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/orders');
        }
        
        if (!Security::validateCsrfToken($_POST['csrf_token'] ?? '')) {
            die('Token CSRF invalide');
        }
        
        $orderId = $_POST['order_id'] ?? 0;
        $status = $_POST['status'] ?? '';
        
        $allowedStatuses = ['pending', 'paid', 'shipped', 'delivered', 'cancelled'];
        
        if (in_array($status, $allowedStatuses)) {
            $this->orderModel->updateStatus($orderId, $status);
            $_SESSION['success'] = "Statut de la commande mis à jour";
        }
        
        $this->redirect('/admin/orders');
    }
}