<div class="admin-container">
    <h1>Gestion des produits</h1>
    
    <div class="admin-actions">
        <a href="/admin/addProduct" class="btn btn-primary">Ajouter un produit</a>
    </div>
    
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td>
                        <img src="/uploads/products/<?= $product['image'] ?? 'default.jpg' ?>" 
                             alt="<?= Security::escape($product['name']) ?>" width="50">
                    </td>
                    <td><?= Security::escape($product['name']) ?></td>
                    <td><?= number_format($product['price'], 2) ?> €</td>
                    <td><?= $product['stock'] ?></td>
                    <td><?= $product['type'] ?></td>
                    <td class="actions">
                        <a href="/admin/editProduct/<?= $product['id'] ?>" class="btn-small">Modifier</a>
                        <a href="/admin/deleteProduct/<?= $product['id'] ?>?csrf_token=<?= Security::generateCsrfToken() ?>" 
                           class="btn-small btn-danger"
                           onclick="return confirm('Supprimer ce produit ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>