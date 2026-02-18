<div class="auth-container">
    <h1>Inscription</h1>
    
    <form action="/user/register" method="POST" class="auth-form" id="register-form">
        <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
        
        <div class="form-group">
            <label for="username">Nom d'utilisateur * :</label>
            <input type="text" id="username" name="username" required minlength="3">
        </div>
        
        <div class="form-group">
            <label for="email">Email * :</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="full_name">Nom complet :</label>
            <input type="text" id="full_name" name="full_name">
        </div>
        
        <div class="form-group">
            <label for="password">Mot de passe * :</label>
            <input type="password" id="password" name="password" required 
                   pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}" 
                   title="8 caractères minimum, avec au moins une lettre et un chiffre">
            <small>8 caractères minimum, avec au moins une lettre et un chiffre</small>
        </div>
        
        <div class="form-group">
            <label for="confirm_password">Confirmer le mot de passe * :</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
    
    <p class="auth-link">
        Déjà inscrit ? <a href="/user/login">Se connecter</a>
    </p>
</div>

<script>
// Validation côté client
document.getElementById('register-form').addEventListener('submit', function(e) {
    var password = document.getElementById('password').value;
    var confirm = document.getElementById('confirm_password').value;
    
    if (password !== confirm) {
        e.preventDefault();
        alert('Les mots de passe ne correspondent pas');
    }
});
</script>