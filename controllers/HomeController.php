<?php
/**
 * Contrôleur de la page d'accueil
 */
class HomeController extends Controller {
    
    public function index() {
        $productModel = new Product();
        
        // Récupérer les promotions et nouveautés
        $promotions = $productModel->getPromotions(4);
        $newProducts = $productModel->getNewProducts(4);
        
        $data = [
            'promotions' => $promotions,
            'newProducts' => $newProducts
        ];
        
        $this->view('home/index', $data);
    }
}