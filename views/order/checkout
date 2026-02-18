<h1>Finaliser la commande</h1>

<div class="checkout-container">
    <div class="checkout-form">
        <h2>Informations de livraison</h2>
        
        <form action="/order/place" method="POST">
            <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
            
            <div class="form-group">
                <label for="full_name">Nom complet :</label>
                <input type="text" id="full_name" value="<?= Security::escape($user['full_name']) ?>" disabled>
            </div>
            
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" value="<?= Security::escape($user['email']) ?>" disabled>
            </div>
            
            <div class="form-group">
                <label for="address">Adresse * :</label>
                <input type="text" id="address" name="address" 
                       value="<?= Security::escape($user['address'] ?? '') ?>" required>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="city">Ville * :</label>
                    <input type="text" id="city" name="city" required>
                </div>
                
                <div class="form-group">
                    <label for="postal_code">Code postal * :</label>
                    <input type="text" id="postal_code" name="postal_code" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="country">Pays * :</label>
                <input type="text" id="country" name="country" value="France" required>
            </div>
            
            <h2>Paiement</h2>
            
            <div class="form-group">
                <label for="payment_method">Mode de paiement :</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="card">Carte bancaire</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>
            
            <!-- Simulation de formulaire de carte bancaire -->
            <div class="payment-details" id="card-details">
                <div class="form-group">
                    <label for="card_number">Numéro de carte :</label>
                    <input type="text" id="card_number" name="card_number" 
                           placeholder="1234 5678 9012 3456" pattern="[0-9]{16}" maxlength="16">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="expiry">Date d'expiration :</label>
                        <input type="text" id="expiry" name="expiry" placeholder="MM/AA">
                    </div>
                    
                    <div class="form-group">
                        <label for="cvv">CVV :</label>
                        <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3">
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-large">Confirmer la commande</button>
            </div>
        </form>
    </div>
    
    <div class="order-summary">
        <h2>Récapitulatif</h2>
        
        <table class="summary-table">
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= Security::escape($item['product']['name']) ?> x<?= $item['quantity'] ?></td>
                    <td><?= number_format($item['subtotal'], 2) ?> €</td>
                </tr>
            <?php endforeach; ?>
            <tr class="total">
                <td>Total</td>
                <td><?= number_format($total, 2) ?> €</td>
            </tr>
        </table>
    </div>
</div>

<script>
// Basculer les champs de paiement selon la méthode choisie
document.getElementById('payment_method').addEventListener('change', function(e) {
    var cardDetails = document.getElementById('card-details');
    cardDetails.style.display = e.target.value === 'card' ? 'block' : 'none';
});
</script>