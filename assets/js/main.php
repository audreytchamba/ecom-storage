// Validation des formulaires
document.addEventListener('DOMContentLoaded', function() {
    
    // Confirmation de suppression
    const deleteLinks = document.querySelectorAll('.delete-confirm');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
                e.preventDefault();
            }
        });
    });
    
    // Validation du formulaire d'inscription
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            const password = document.getElementById('password');
            const confirm = document.getElementById('confirm_password');
            
            if (password.value !== confirm.value) {
                e.preventDefault();
                alert('Les mots de passe ne correspondent pas');
            }
        });
    }
    
    // Mise à jour automatique du panier
    const quantityInputs = document.querySelectorAll('.update-quantity input[type="number"]');
    quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
            this.closest('form').submit();
        });
    });
    
    // Filtres automatiques
    const filterSelects = document.querySelectorAll('.filters select');
    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });
    });
    
    // Animation du panier
    const addToCartButtons = document.querySelectorAll('.add-to-cart-form .btn');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const originalText = this.textContent;
            this.textContent = 'Ajouté !';
            this.style.background = '#28a745';
            
            setTimeout(() => {
                this.textContent = originalText;
                this.style.background = '';
            }, 2000);
        });
    });
    
    // Validation du formulaire de paiement
    const checkoutForm = document.querySelector('.checkout-form form');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            const cardNumber = document.getElementById('card_number');
            const expiry = document.getElementById('expiry');
            const cvv = document.getElementById('cvv');
            
            if (cardNumber && cardNumber.value) {
                // Validation basique du numéro de carte
                if (!/^\d{16}$/.test(cardNumber.value.replace(/\s/g, ''))) {
                    e.preventDefault();
                    alert('Numéro de carte invalide');
                    return;
                }
            }
            
            if (expiry && expiry.value) {
                // Validation de la date d'expiration
                if (!/^\d{2}\/\d{2}$/.test(expiry.value)) {
                    e.preventDefault();
                    alert('Format de date invalide (MM/AA)');
                    return;
                }
            }
            
            if (cvv && cvv.value) {
                // Validation du CVV
                if (!/^\d{3}$/.test(cvv.value)) {
                    e.preventDefault();
                    alert('CVV invalide (3 chiffres)');
                    return;
                }
            }
        });
    }
    
    // Prévisualisation d'image avant upload
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.querySelector('.current-image img');
                    if (preview) {
                        preview.src = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
});

// Fonction pour mettre à jour le compteur du panier
function updateCartCount(count) {
    const cartCount = document.querySelector('.cart-count');
    if (cartCount) {
        cartCount.textContent = count;
    }
}

// Smooth scroll pour les ancres
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});