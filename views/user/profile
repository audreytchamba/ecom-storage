<div class="profile-container">
    <h1>Mon profil</h1>
    
    <div class="profile-tabs">
        <a href="/user/profile" class="tab active">Informations</a>
        <a href="/user/orders" class="tab">Mes commandes</a>
    </div>
    
    <div class="profile-content">
        <form action="/user/profile" method="POST" class="profile-form">
            <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
            
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" value="<?= Security::escape($user['username']) ?>" disabled>
            </div>
            
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" value="<?= Security::escape($user['email']) ?>" disabled>
            </div>
            
            <div class="form-group">
                <label for="full_name">Nom complet :</label>
                <input type="text" id="full_name" name="full_name" 
                       value="<?= Security::escape($user['full_name'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="address">Adresse :</label>
                <textarea id="address" name="address" rows="3"><?= Security::escape($user['address'] ?? '') ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
        
        <hr>
        
        <h2>Changer le mot de passe</h2>
        
        <form action="/user/changePassword" method="POST" class="password-form" id="password-form">
            <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
            
            <div class="form-group">
                <label for="current_password">Mot de passe actuel :</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            
            <div class="form-group">
                <label for="new_password">Nouveau mot de passe :</label>
                <input type="password" id="new_password" name="new_password" required 
                       pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}">
                <small>8 caractères minimum, avec au moins une lettre et un chiffre</small>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirmer :</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
        </form>
    </div>
</div>

<script>
document.getElementById('password-form').addEventListener('submit', function(e) {
    var newPass = document.getElementById('new_password').value;
    var confirm = document.getElementById('confirm_password').value;
    
    if (newPass !== confirm) {
        e.preventDefault();
        alert('Les mots de passe ne correspondent pas');
    }
});
</script>