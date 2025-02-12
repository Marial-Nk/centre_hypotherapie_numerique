<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <div class="container">
        <h1>Créer un compte</h1>

        <?php if (isset($_SESSION['success'])): ?>
            <p style="color: green;"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <form action="/register" method="POST">
            <label for="name">Nom*</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email*</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe*</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirmation">Confirmez le mot de passe*</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <button type="submit">ENREGISTRER</button>
        </form>
    </div>
</body>
</html>
