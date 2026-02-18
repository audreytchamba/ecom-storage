<div class="product-detail">
    <div class="product-images">
        <img src="/uploads/products/<?= $product['image'] ?? 'default.jpg' ?>" 
             alt="<?= Security::escape($product['name']) ?>">
    </div>
    
    <div class="product-info">
        <h1><?= Security::escape($product['name']) ?></h1>
        
        <div class="product-rating">
            Note moyenne : <?= $averageRating ?>/5
            (<?= count($reviews) ?> avis)
        </div>
        
        <p class="price"><?= number_format($product['price'], 2) ?> €</p>
        
        <p class="stock <?= $product['stock'] > 0 ? 'in-stock' : 'out-of-stock' ?>">
            <?= $product['stock'] > 0 ? 'En stock' : 'Rupture de stock' ?>
        </p>
        
        <div class="product-description">
            <h3>Description</h3>
            <p><?= nl2br(Security::escape($product['description'])) ?></p>
        </div>
        
        <div class="product-specs">
            <h3>Caractéristiques techniques</h3>
            <ul>
                <li><strong>Type :</strong> <?= Security::escape($product['type']) ?></li>
                <li><strong>Capacité :</strong> <?= Security::escape($product['capacity']) ?></li>
                <?php if ($product['speed']): ?>
                    <li><strong>Vitesse :</strong> <?= Security::escape($product['speed']) ?></li>
                <?php endif; ?>
                <?php if ($product['interface']): ?>
                    <li><strong>Interface :</strong> <?= Security::escape($product['interface']) ?></li>
                <?php endif; ?>
            </ul>
        </div>
        
        <?php if ($product['stock'] > 0): ?>
            <form action="/cart/add" method="POST" class="add-to-cart-form">
                <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                
                <label for="quantity">Quantité :</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?= $product['stock'] ?>">
                
                <button type="submit" class="btn btn-primary">Ajouter au panier</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<!-- Avis clients -->
<div class="product-reviews">
    <h2>Avis clients</h2>
    
    <?php if (Session::get('user_id')): ?>
        <?php
        $reviewModel = new Review();
        $hasReviewed = $reviewModel->hasUserReviewed($product['id'], Session::get('user_id'));
        ?>
        
        <?php if (!$hasReviewed): ?>
            <form action="/product/addReview" method="POST" class="review-form">
                <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                
                <h3>Donnez votre avis</h3>
                
                <div class="rating-select">
                    <label>Note :</label>
                    <select name="rating" required>
                        <option value="5">5 étoiles</option>
                        <option value="4">4 étoiles</option>
                        <option value="3">3 étoiles</option>
                        <option value="2">2 étoiles</option>
                        <option value="1">1 étoile</option>
                    </select>
                </div>
                
                <div class="comment-field">
                    <label for="comment">Commentaire :</label>
                    <textarea name="comment" id="comment" rows="4" required></textarea>
                </div>
                
                <button type="submit" class="btn">Publier</button>
            </form>
        <?php endif; ?>
    <?php else: ?>
        <p><a href="/user/login">Connectez-vous</a> pour laisser un avis.</p>
    <?php endif; ?>
    
    <div class="reviews-list">
        <?php foreach ($reviews as $review): ?>
            <div class="review-item">
                <div class="review-header">
                    <strong><?= Security::escape($review['username']) ?></strong>
                    <span class="rating"><?= $review['rating'] ?>/5</span>
                    <span class="date"><?= date('d/m/Y', strtotime($review['created_at'])) ?></span>
                </div>
                <p class="review-comment"><?= nl2br(Security::escape($review['comment'])) ?></p>
            </div>
        <?php endforeach; ?>
        
        <?php if (empty($reviews)): ?>
            <p>Aucun avis pour le moment.</p>
        <?php endif; ?>
    </div>
</div>