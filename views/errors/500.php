<?php
/**
 * Vue d'erreur 500
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Erreur serveur</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            text-align: center;
            background: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .container h1 {
            font-size: 80px;
            color: #e74c3c;
            margin-bottom: 20px;
        }
        
        .container h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }
        
        .container p {
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>500</h1>
        <h2>Erreur serveur</h2>
        <p>Une erreur s'est produite. Veuillez réessayer plus tard.</p>
        <a href="/" class="btn">Retourner à l'accueil</a>
    </div>
</body>
</html>
