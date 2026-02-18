<!-- Bannière -->
<section class="hero">
    <div class="hero-content">
        <h1>StorageShop</h1>
        <p>Votre partenaire de confiance pour tous vos besoins de stockage</p>
        <a href="/products" class="btn btn-primary">Découvrir nos produits</a>
    </div>
</section>

<!-- Promotions -->
<section class="promotions">
    <h2>Promotions du moment</h2>
    <div class="products-grid">
        <?php foreach ($promotions as $product): ?>
            <div class="product-card">
                <img src="/uploads/products/<?= $product['image'] ?? 'default.jpg' ?>" 
                     alt="<?= Security::escape($product['name']) ?>">
                <h3><?= Security::escape($product['name']) ?></h3>
                <p class="price"><?= number_format($product['price'], 2) ?> €</p>
                <a href="/product/detail/<?= $product['id'] ?>" class="btn">Voir détails</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Nouveautés -->
<section class="new-products">
    <h2>Nouveautés</h2>
    <div class="products-grid">
        <?php foreach ($newProducts as $product): ?>
            <div class="product-card">
                <img src="/uploads/products/<?= $product['image'] ?? 'default.jpg' ?>" 
                     alt="<?= Security::escape($product['name']) ?>">
                <h3><?= Security::escape($product['name']) ?></h3>
                <p class="price"><?= number_format($product['price'], 2) ?> €</p>
                <a href="/product/detail/<?= $product['id'] ?>" class="btn">Voir détails</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>