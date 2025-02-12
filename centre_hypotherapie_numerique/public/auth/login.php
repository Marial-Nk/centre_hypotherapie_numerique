<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <div class="container">
        <h1>Se connecter</h1>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="error" style="color:red"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <form action="/login" method="POST">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" placeholder="Nom" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Mot de passe" required>

            <button type="submit">Connexion</button>
        </form>
    </div>
</body>
</html>
