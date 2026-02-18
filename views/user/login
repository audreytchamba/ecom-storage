<div class="auth-container">
    <h1>Connexion</h1>
    
    <form action="/user/login" method="POST" class="auth-form">
        <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
        
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
    
    <p class="auth-link">
        Pas encore de compte ? <a href="/user/register">S'inscrire</a>
    </p>
</div>