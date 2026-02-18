<div class="confirmation">
    <h1>Commande confirmée !</h1>
    
    <div class="confirmation-message">
        <p>Merci pour votre commande n° <?= $order['id'] ?></p>
        <p>Un email de confirmation vous a été envoyé.</p>
    </div>
    
    <div class="order-details">
        <h2>Détails de la commande</h2>
        
        <table class="order-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= Security::escape($item['name']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['price'], 2) ?> €</td>
                        <td><?= number_format($item['price'] * $item['quantity'], 2) ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="total-label">Total</td>
                    <td class="total-amount"><?= number_format($order['total'], 2) ?> €</td>
                </tr>
            </tfoot>
        </table>
        
        <div class="shipping-info">
            <h3>Adresse de livraison</h3>
            <p><?= nl2br(Security::escape($order['shipping_address'])) ?></p>
        </div>
        
        <div class="order-actions">
            <a href="/" class="btn">Retour à l'accueil</a>
            <a href="/user/orders" class="btn">Voir mes commandes</a>
        </div>
    </div>
</div>