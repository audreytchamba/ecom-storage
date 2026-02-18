<div class="admin-container">
    <h1><?= isset($product) ? 'Modifier' : 'Ajouter' ?> un produit</h1>
    
    <form action="<?= isset($product) ? '/admin/editProduct/' . $product['id'] : '/admin/addProduct' ?>" 
          method="POST" enctype="multipart/form-data" class="admin-form">
        <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
        
        <div class="form-group">
            <label for="name">Nom du produit * :</label>
            <input type="text" id="name" name="name" value="<?= Security::escape($product['name'] ?? '') ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea id="description" name="description" rows="5"><?= Security::escape($product['description'] ?? '') ?></textarea>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="price">Prix (€) * :</label>
                <input type="number" id="price" name="price" step="0.01" 
                       value="<?= $product['price'] ?? '' ?>" required>
            </div>
            
            <div class="form-group">
                <label for="stock">Stock * :</label>
                <input type="number" id="stock" name="stock" 
                       value="<?= $product['stock'] ?? '' ?>" required>
            </div>
        </div>
        
        <div class="form-group">
            <label for="type">Type * :</label>
            <select id="type" name="type" required>
                <option value="SSD" <?= (isset($product) && $product['type'] == 'SSD') ? 'selected' : '' ?>>SSD</option>
                <option value="HDD" <?= (isset($product) && $product['type'] == 'HDD') ? 'selected' : '' ?>>HDD</option>
                <option value="USB" <?= (isset($product) && $product['type'] == 'USB') ? 'selected' : '' ?>>Clé USB</option>
                <option value="Memory Card" <?= (isset($product) && $product['type'] == 'Memory Card') ? 'selected' : '' ?>>Carte mémoire</option>
            </select>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="capacity">Capacité :</label>
                <input type="text" id="capacity" name="capacity" 
                       value="<?= Security::escape($product['capacity'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="speed">Vitesse :</label>
                <input type="text" id="speed" name="speed" 
                       value="<?= Security::escape($product['speed'] ?? '') ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label for="interface">Interface :</label>
            <input type="text" id="interface" name="interface" 
                   value="<?= Security::escape($product['interface'] ?? '') ?>">
        </div>
        
        <div class="form-group">
            <label for="image">Image :</label>
            <?php if (isset($product) && $product['image']): ?>
                <div class="current-image">
                    <img src="/uploads/products/<?= $product['image'] ?>" alt="Image actuelle" width="100">
                    <p>Image actuelle</p>
                </div>
            <?php endif; ?>
            <input type="file" id="image" name="image" accept="image/*">
        </div>
        
        <div class="form-checkbox">
            <label>
                <input type="checkbox" name="is_promotion" <?= (isset($product) && $product['is_promotion']) ? 'checked' : '' ?>>
                Mettre en promotion
            </label>
        </div>
        
        <div class="form-checkbox">
            <label>
                <input type="checkbox" name="is_new" <?= (isset($product) && $product['is_new']) ? 'checked' : '' ?>>
                Marquer comme nouveau
            </label>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="/admin/products" class="btn">Annuler</a>
        </div>
    </form>
</div>