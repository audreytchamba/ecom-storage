<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StorageShop - Supports de stockage</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-top">
                <div class="logo">
                    <a href="/">
                        <img src="/assets/images/logo.png" alt="StorageShop">
                        <span>StorageShop</span>
                    </a>
                </div>
                <div class="search-bar">
                    <form action="/products" method="GET">
                        <input type="text" name="search" placeholder="Rechercher un produit...">
                        <button type="submit">🔍</button>
                    </form>
                </div>
                <div class="user-cart">
                    <?php if (Session::get('user_id')): ?>
                        <a href="/user/profile" class="user-btn"><?= Security::escape(Session::get('user_name')) ?></a>
                        <?php if (Session::get('user_role') === 'admin'): ?>
                            <a href="/admin/dashboard" class="admin-btn">Admin</a>
                        <?php endif; ?>
                        <a href="/user/logout" class="logout-btn">Déconnexion</a>
                    <?php else: ?>
                        <a href="/user/login" class="login-btn">Connexion</a>
                        <a href="/user/register" class="register-btn">Inscription</a>
                    <?php endif; ?>
                    <a href="/cart" class="cart-btn">
                        Panier 
                        <span class="cart-count">
                            <?= array_sum(Session::get('cart', [])) ?>
                        </span>
                    </a>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="/">Accueil</a></li>
                    <li><a href="/products">Produits</a></li>
                    <li><a href="/cart">Panier</a></li>
                    <li><a href="/user/profile">Mon compte</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert success">
                    <?= Security::escape($_SESSION['success']) ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert error">
                    <?= Security::escape($_SESSION['error']) ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['errors']) && is_array($_SESSION['errors'])): ?>
                <div class="alert error">
                    <ul>
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <li><?= Security::escape($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php unset($_SESSION['errors']); ?>
                </div>
            <?php endif; ?>