<h1>Votre panier</h1>

<?php if (empty($items)): ?>
    <div class="empty-cart">
        <p>Votre panier est vide.</p>
        <a href="/products" class="btn btn-primary">Continuer vos achats</a>
    </div>
<?php else: ?>
    <table class="cart-table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td class="product-info">
                        <img src="/uploads/products/<?= $item['product']['image'] ?? 'default.jpg' ?>" 
                             alt="<?= Security::escape($item['product']['name']) ?>" width="50">
                        <span><?= Security::escape($item['product']['name']) ?></span>
                    </td>
                    <td><?= number_format($item['product']['price'], 2) ?> €</td>
                    <td>
                        <form action="/cart/update" method="POST" class="update-quantity">
                            <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
                            <input type="hidden" name="product_id" value="<?= $item['product']['id'] ?>">
                            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" 
                                   min="0" max="<?= $item['product']['stock'] ?>">
                            <button type="submit" class="btn-small">✓</button>
                        </form>
                    </td>
                    <td><?= number_format($item['subtotal'], 2) ?> €</td>
                    <td>
                        <a href="/cart/remove/<?= $item['product']['id'] ?>" 
                           class="btn-small btn-danger"
                           onclick="return confirm('Supprimer cet article ?')">
                            ✗
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="total-label">Total</td>
                <td class="total-amount"><?= number_format($total, 2) ?> €</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    
    <div class="cart-actions">
        <a href="/products" class="btn">Continuer les achats</a>
        <a href="/order/checkout" class="btn btn-primary">Passer la commande</a>
        <a href="/cart/clear" class="btn btn-danger" 
           onclick="return confirm('Vider le panier ?')">Vider le panier</a>
    </div>
<?php endif; ?>