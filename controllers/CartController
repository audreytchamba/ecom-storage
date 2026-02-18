<?php
/**
 * Contrôleur du panier
 */
class CartController extends Controller {
    
    private $productModel;
    
    public function __construct() {
        $this->productModel = new Product();
    }
    
    public function index() {
        $cart = Session::get('cart', []);
        $items = [];
        $total = 0;
        
        foreach ($cart as $productId => $quantity) {
            $product = $this->productModel->findById($productId);
            
            if ($product) {
                $subtotal = $product['price'] * $quantity;
                $total += $subtotal;
                
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ];
            }
        }
        
        $data = [
            'items' => $items,
            'total' => $total
        ];
        
        $this->view('cart/index', $data);
    }
    
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/products');
        }
        
        if (!Security::validateCsrfToken($_POST['csrf_token'] ?? '')) {
            die('Token CSRF invalide');
        }
        
        $productId = $_POST['product_id'] ?? 0;
        $quantity = (int)($_POST['quantity'] ?? 1);
        
        if ($productId && $quantity > 0) {
            $product = $this->productModel->findById($productId);
            
            if ($product && $product['stock'] >= $quantity) {
                $cart = Session::get('cart', []);
                $cart[$productId] = ($cart[$productId] ?? 0) + $quantity;
                Session::set('cart', $cart);
                
                $_SESSION['success'] = "Produit ajouté au panier";
            } else {
                $_SESSION['error'] = "Stock insuffisant";
            }
        }
        
        $this->redirect('/product/detail/' . $productId);
    }
    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/cart');
        }
        
        if (!Security::validateCsrfToken($_POST['csrf_token'] ?? '')) {
            die('Token CSRF invalide');
        }
        
        $productId = $_POST['product_id'] ?? 0;
        $quantity = (int)($_POST['quantity'] ?? 0);
        
        if ($productId) {
            $cart = Session::get('cart', []);
            
            if ($quantity > 0) {
                $product = $this->productModel->findById($productId);
                
                if ($product && $product['stock'] >= $quantity) {
                    $cart[$productId] = $quantity;
                } else {
                    $_SESSION['error'] = "Stock insuffisant";
                }
            } else {
                unset($cart[$productId]);
            }
            
            Session::set('cart', $cart);
        }
        
        $this->redirect('/cart');
    }
    
    public function remove($productId) {
        $cart = Session::get('cart', []);
        unset($cart[$productId]);
        Session::set('cart', $cart);
        
        $this->redirect('/cart');
    }
    
    public function clear() {
        Session::set('cart', []);
        $this->redirect('/cart');
    }
}