/* Reset et styles de base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: #333;
    background-color: #f4f4f4;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Header */
header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1rem 0;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.header-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 1rem;
}

.logo a {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: white;
    font-size: 1.5rem;
    font-weight: bold;
}

.logo img {
    height: 50px;
    margin-right: 10px;
}

.search-bar {
    flex: 1;
    max-width: 500px;
    margin: 0 20px;
}

.search-bar form {
    display: flex;
}

.search-bar input {
    flex: 1;
    padding: 10px;
    border: none;
    border-radius: 5px 0 0 5px;
    font-size: 1rem;
}

.search-bar button {
    padding: 10px 15px;
    background: #ff6b6b;
    border: none;
    border-radius: 0 5px 5px 0;
    color: white;
    cursor: pointer;
}

.user-cart a {
    color: white;
    text-decoration: none;
    margin-left: 15px;
    padding: 5px 10px;
    border-radius: 5px;
    transition: background 0.3s;
}

.user-cart a:hover {
    background: rgba(255,255,255,0.2);
}

.cart-btn {
    background: #ff6b6b;
}

.cart-count {
    background: white;
    color: #ff6b6b;
    padding: 2px 6px;
    border-radius: 10px;
    font-size: 0.8rem;
    margin-left: 5px;
}

nav ul {
    display: flex;
    list-style: none;
    padding: 1rem 0;
}

nav ul li {
    margin-right: 20px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

nav ul li a:hover {
    color: #ffd700;
}

/* Main content */
main {
    min-height: calc(100vh - 200px);
    padding: 2rem 0;
}

/* Alertes */
.alert {
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 5px;
}

.alert.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Boutons */
.btn {
    display: inline-block;
    padding: 10px 20px;
    background: #667eea;
    color: white;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
    font-size: 1rem;
}

.btn:hover {
    background: #764ba2;
}

.btn-primary {
    background: #ff6b6b;
}

.btn-primary:hover {
    background: #ff5252;
}

.btn-secondary {
    background: #6c757d;
}

.btn-danger {
    background: #dc3545;
}

.btn-danger:hover {
    background: #c82333;
}

.btn-large {
    padding: 15px 30px;
    font-size: 1.1rem;
}

.btn-small {
    padding: 5px 10px;
    font-size: 0.9rem;
    text-decoration: none;
    color: white;
    background: #667eea;
    border-radius: 3px;
}

/* Grille de produits */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.product-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: transform 0.3s;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.product-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.product-card h3 {
    padding: 1rem;
    font-size: 1.1rem;
}

.product-card .price {
    padding: 0 1rem;
    font-size: 1.2rem;
    font-weight: bold;
    color: #667eea;
}

.product-card .stock {
    padding: 0 1rem;
    margin: 0.5rem 0;
}

.product-card .stock.in-stock {
    color: #28a745;
}

.product-card .stock.out-of-stock {
    color: #dc3545;
}

.product-card .btn {
    display: block;
    margin: 1rem;
    text-align: center;
}

/* Filtres */
.filters {
    background: white;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.filters form {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    align-items: flex-end;
}

.filter-group {
    flex: 1;
    min-width: 150px;
}

.filter-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

.filter-group select,
.filter-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 3px;
}

/* Page produit détail */
.product-detail {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    background: white;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 40px;
}

.product-images img {
    width: 100%;
    max-height: 400px;
    object-fit: contain;
}

.product-info h1 {
    margin-bottom: 20px;
}

.product-rating {
    color: #ffc107;
    margin-bottom: 20px;
}

.product-info .price {
    font-size: 2rem;
    color: #667eea;
    font-weight: bold;
    margin-bottom: 20px;
}

.product-info .stock {
    font-size: 1.1rem;
    margin-bottom: 20px;
}

.product-specs ul {
    list-style: none;
    margin: 20px 0;
    padding: 0;
}

.product-specs li {
    padding: 10px;
    border-bottom: 1px solid #eee;
}

.add-to-cart-form {
    margin-top: 20px;
}

.add-to-cart-form input[type="number"] {
    width: 80px;
    padding: 10px;
    margin-right: 10px;
    border: 1px solid #ddd;
    border-radius: 3px;
}

/* Avis clients */
.product-reviews {
    background: white;
    padding: 20px;
    border-radius: 5px;
}

.review-form {
    background: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    margin: 20px 0;
}

.reviews-list {
    margin-top: 20px;
}

.review-item {
    border-bottom: 1px solid #eee;
    padding: 15px 0;
}

.review-header {
    display: flex;
    gap: 15px;
    align-items: center;
    margin-bottom: 10px;
}

.review-header .rating {
    color: #ffc107;
    font-weight: bold;
}

.review-header .date {
    color: #666;
    font-size: 0.9rem;
}

/* Panier */
.cart-table {
    width: 100%;
    background: white;
    border-radius: 5px;
    overflow: hidden;
    border-collapse: collapse;
}

.cart-table th {
    background: #667eea;
    color: white;
    padding: 15px;
    text-align: left;
}

.cart-table td {
    padding: 15px;
    border-bottom: 1px solid #eee;
}

.cart-table .product-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.cart-table .product-info img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 5px;
}

.update-quantity {
    display: flex;
    gap: 5px;
    align-items: center;
}

.update-quantity input {
    width: 60px;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 3px;
}

.cart-actions {
    margin-top: 20px;
    display: flex;
    gap: 10px;
    justify-content: flex-end;
}

/* Checkout */
.checkout-container {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
}

.checkout-form {
    background: white;
    padding: 20px;
    border-radius: 5px;
}

.order-summary {
    background: white;
    padding: 20px;
    border-radius: 5px;
    height: fit-content;
}

.summary-table {
    width: 100%;
}

.summary-table tr {
    border-bottom: 1px solid #eee;
}

.summary-table td {
    padding: 10px;
}

.summary-table .total {
    font-weight: bold;
    font-size: 1.2rem;
    border-top: 2px solid #667eea;
}

/* Formulaires */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 3px;
    font-size: 1rem;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102,126,234,0.1);
}

.form-group small {
    display: block;
    margin-top: 5px;
    color: #666;
    font-size: 0.85rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-checkbox {
    margin: 20px 0;
}

/* Auth pages */
.auth-container {
    max-width: 400px;
    margin: 0 auto;
    background: white;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.auth-container h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #667eea;
}

.auth-form {
    margin-bottom: 20px;
}

.auth-link {
    text-align: center;
    margin-top: 20px;
}

.auth-link a {
    color: #667eea;
    text-decoration: none;
}

/* Profil utilisateur */
.profile-container {
    background: white;
    padding: 20px;
    border-radius: 5px;
}

.profile-tabs {
    display: flex;
    gap: 10px;
    margin: 20px 0;
    border-bottom: 2px solid #eee;
}

.profile-tabs .tab {
    padding: 10px 20px;
    text-decoration: none;
    color: #666;
    border-bottom: 2px solid transparent;
    margin-bottom: -2px;
}

.profile-tabs .tab.active {
    color: #667eea;
    border-bottom-color: #667eea;
}

.profile-content {
    padding: 20px 0;
}

/* Administration */
.admin-container {
    background: white;
    padding: 20px;
    border-radius: 5px;
}

.admin-actions {
    margin: 20px 0;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
}

.admin-table th {
    background: #667eea;
    color: white;
    padding: 12px;
    text-align: left;
}

.admin-table td {
    padding: 12px;
    border-bottom: 1px solid #eee;
}

.admin-table tr:hover {
    background: #f9f9f9;
}

.admin-table .actions {
    display: flex;
    gap: 5px;
}

/* Footer */
footer {
    background: #333;
    color: white;
    padding: 3rem 0 1rem;
    margin-top: 2rem;
}

.footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-bottom: 2rem;
}

.footer-col h4 {
    margin-bottom: 1rem;
    color: #ffd700;
}

.footer-col ul {
    list-style: none;
}

.footer-col ul li {
    margin-bottom: 0.5rem;
}

.footer-col a {
    color: white;
    text-decoration: none;
    transition: color 0.3s;
}

.footer-col a:hover {
    color: #ffd700;
}

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid #555;
}

/* Responsive */
@media (max-width: 768px) {
    .header-top {
        flex-direction: column;
        gap: 15px;
    }
    
    .search-bar {
        max-width: 100%;
        margin: 10px 0;
    }
    
    nav ul {
        flex-direction: column;
        align-items: center;
    }
    
    nav ul li {
        margin: 5px 0;
    }
    
    .product-detail {
        grid-template-columns: 1fr;
    }
    
    .checkout-container {
        grid-template-columns: 1fr;
    }
    
    .cart-table {
        font-size: 0.9rem;
    }
    
    .cart-table .product-info {
        flex-direction: column;
        text-align: center;
    }
}