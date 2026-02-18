<?php
/**
 * Contrôleur des produits
 */
class ProductController extends Controller {
    
    private $productModel;
    private $reviewModel;
    
    public function __construct() {
        $this->productModel = new Product();
        $this->reviewModel = new Review();
    }
    
    public function index() {
        // Récupérer les filtres
        $filters = [
            'type' => $_GET['type'] ?? '',
            'capacity' => $_GET['capacity'] ?? '',
            'min_price' => $_GET['min_price'] ?? '',
            'max_price' => $_GET['max_price'] ?? '',
            'search' => $_GET['search'] ?? ''
        ];
        
        $products = $this->productModel->getAll($filters);
        
        $data = [
            'products' => $products,
            'filters' => $filters
        ];
        
        $this->view('products/list', $data);
    }
    
    public function detail($id) {
        $product = $this->productModel->findById($id);
        
        if (!$product) {
            $this->redirect('/products');
        }
        
        $reviews = $this->reviewModel->getByProductId($id);
        $averageRating = $this->reviewModel->getAverageRating($id);
        
        $data = [
            'product' => $product,
            'reviews' => $reviews,
            'averageRating' => $averageRating
        ];
        
        $this->view('products/detail', $data);
    }
    
    public function addReview() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/products');
        }
        
        if (!Security::validateCsrfToken($_POST['csrf_token'] ?? '')) {
            die('Token CSRF invalide');
        }
        
        $this->requireLogin();
        
        $productId = $_POST['product_id'] ?? 0;
        $rating = $_POST['rating'] ?? 0;
        $comment = Security::sanitize($_POST['comment'] ?? '');
        
        if ($rating < 1 || $rating > 5) {
            $_SESSION['error'] = "La note doit être comprise entre 1 et 5";
            $this->redirect('/product/detail/' . $productId);
        }
        
        $userId = Session::get('user_id');
        
        try {
            $this->reviewModel->create([
                'product_id' => $productId,
                'user_id' => $userId,
                'rating' => $rating,
                'comment' => $comment
            ]);
            
            $_SESSION['success'] = "Votre avis a été ajouté";
        } catch (Exception $e) {
            $_SESSION['error'] = "Vous avez déjà donné un avis sur ce produit";
        }
        
        $this->redirect('/product/detail/' . $productId);
    }
}