<?php
/**
 * Contrôleur des commandes
 */
class OrderController extends Controller {
    
    private $orderModel;
    private $orderItemModel;
    private $productModel;
    
    public function __construct() {
        $this->orderModel = new Order();
        $this->orderItemModel = new OrderItem();
        $this->productModel = new Product();
    }
    
    public function checkout() {
        $this->requireLogin();
        
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            $this->redirect('/cart');
        }
        
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
        
        $userModel = new User();
        $user = $userModel->findById(Session::get('user_id'));
        
        $data = [
            'items' => $items,
            'total' => $total,
            'user' => $user
        ];
        
        $this->view('order/checkout', $data);
    }
    
    public function place() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/cart');
        }
        
        if (!Security::validateCsrfToken($_POST['csrf_token'] ?? '')) {
            die('Token CSRF invalide');
        }
        
        $this->requireLogin();
        
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            $this->redirect('/cart');
        }
        
        // Validation des données
        $address = Security::sanitize($_POST['address'] ?? '');
        $city = Security::sanitize($_POST['city'] ?? '');
        $postalCode = Security::sanitize($_POST['postal_code'] ?? '');
        $country = Security::sanitize($_POST['country'] ?? '');
        $paymentMethod = $_POST['payment_method'] ?? 'card';
        
        if (empty($address) || empty($city) || empty($postalCode) || empty($country)) {
            $_SESSION['error'] = "Tous les champs sont obligatoires";
            $this->redirect('/order/checkout');
        }
        
        $shippingAddress = "$address, $postalCode $city, $country";
        
        // Simulation de paiement
        $paymentSuccess = $this->simulatePayment($_POST);
        
        if (!$paymentSuccess) {
            $_SESSION['error'] = "Le paiement a échoué";
            $this->redirect('/order/checkout');
        }
        
        // Création de la commande avec transaction
        $db = Database::getInstance();
        
        try {
            $db->beginTransaction();
            
            // Calculer le total
            $total = 0;
            $items = [];
            
            foreach ($cart as $productId => $quantity) {
                $product = $this->productModel->findById($productId);
                
                if (!$product) {
                    throw new Exception("Produit non trouvé");
                }
                
                if ($product['stock'] < $quantity) {
                    throw new Exception("Stock insuffisant pour " . $product['name']);
                }
                
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity
                ];
                
                $total += $product['price'] * $quantity;
            }
            
            // Créer la commande
            $orderId = $this->orderModel->create([
                'user_id' => Session::get('user_id'),
                'total' => $total,
                'shipping_address' => $shippingAddress,
                'payment_method' => $paymentMethod,
                'status' => 'paid'
            ]);
            
            // Ajouter les articles
            foreach ($items as $item) {
                $this->orderItemModel->create([
                    'order_id' => $orderId,
                    'product_id' => $item['product']['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['product']['price']
                ]);
                
                // Mettre à jour le stock
                $this->productModel->updateStock(
                    $item['product']['id'],
                    $item['product']['stock'] - $item['quantity']
                );
            }
            
            $db->commit();
            
            // Vider le panier
            Session::set('cart', []);
            
            $_SESSION['success'] = "Commande confirmée !";
            $this->redirect('/order/confirmation/' . $orderId);
            
        } catch (Exception $e) {
            $db->rollBack();
            $_SESSION['error'] = $e->getMessage();
            $this->redirect('/order/checkout');
        }
    }
    
    public function confirmation($orderId) {
        $this->requireLogin();
        
        $order = $this->orderModel->findById($orderId);
        
        if (!$order || $order['user_id'] != Session::get('user_id')) {
            $this->redirect('/');
        }
        
        $items = $this->orderItemModel->getByOrderId($orderId);
        
        $data = [
            'order' => $order,
            'items' => $items
        ];
        
        $this->view('order/confirmation', $data);
    }
    
    private function simulatePayment($postData) {
        // Simulation simple - toujours réussir
        return true;
    }
}