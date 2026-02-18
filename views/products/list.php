<h1>Catalogue produits</h1>

<!-- Filtres -->
<div class="filters">
    <form method="GET" action="/products" id="filter-form">
        <div class="filter-group">
            <label for="type">Type :</label>
            <select name="type" id="type">
                <option value="">Tous</option>
                <option value="SSD" <?= $filters['type'] == 'SSD' ? 'selected' : '' ?>>SSD</option>
                <option value="HDD" <?= $filters['type'] == 'HDD' ? 'selected' : '' ?>>HDD</option>
                <option value="USB" <?= $filters['type'] == 'USB' ? 'selected' : '' ?>>Clé USB</option>
                <option value="Memory Card" <?= $filters['type'] == 'Memory Card' ? 'selected' : '' ?>>Carte mémoire</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="capacity">Capacité :</label>
            <select name="capacity" id="capacity">
                <option value="">Toutes</option>
                <option value="128GB" <?= $filters['capacity'] == '128GB' ? 'selected' : '' ?>>128 Go</option>
                <option value="256GB" <?= $filters['capacity'] == '256GB' ? 'selected' : '' ?>>256 Go</option>
                <option value="512GB" <?= $filters['capacity'] == '512GB' ? 'selected' : '' ?>>512 Go</option>
                <option value="1TB" <?= $filters['capacity'] == '1TB' ? 'selected' : '' ?>>1 To</option>
                <option value="2TB" <?= $filters['capacity'] == '2TB' ? 'selected' : '' ?>>2 To</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="min_price">Prix min :</label>
            <input type="number" name="min_price" id="min_price" 
                   value="<?= Security::escape($filters['min_price']) ?>" step="0.01">
        </div>

        <div class="filter-group">
            <label for="max_price">Prix max :</label>
            <input type="number" name="max_price" id="max_price" 
                   value="<?= Security::escape($filters['max_price']) ?>" step="0.01">
        </div>

        <button type="submit" class="btn">Filtrer</button>
        <a href="/products" class="btn btn-secondary">Réinitialiser</a>
    </form>
</div>

<!-- Résultats -->
<div class="products-count">
    <?= count($products) ?> produit(s) trouvé(s)
</div>

<div class="products-grid">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <img src="/uploads/products/<?= $product['image'] ?? 'default.jpg' ?>" 
                 alt="<?= Security::escape($product['name']) ?>">
            <h3><?= Security::escape($product['name']) ?></h3>
            <p class="price"><?= number_format($product['price'], 2) ?> €</p>
            <p class="stock <?= $product['stock'] > 0 ? 'in-stock' : 'out-of-stock' ?>">
                <?= $product['stock'] > 0 ? 'En stock' : 'Rupture' ?>
            </p>
            <a href="/product/detail/<?= $product['id'] ?>" class="btn">Voir détails</a>
        </div>
    <?php endforeach; ?>
</div>

<?php if (empty($products)): ?>
    <p class="no-results">Aucun produit ne correspond à vos critères.</p>
<?php endif; ?>