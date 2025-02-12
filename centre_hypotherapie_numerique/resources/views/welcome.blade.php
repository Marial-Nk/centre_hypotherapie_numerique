<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        .buttons {
            margin-top: 20px;
        }
        a {
            display: inline-block;
            margin: 10px;
            padding: 15px 25px;
            font-size: 18px;
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h1>Bienvenue sur notre application Laravel</h1>
    <p>Veuillez vous inscrire ou vous connecter pour accéder au tableau de bord.</p>

    <div class="buttons">
        <a href="{{ route('register') }}">S'inscrire</a>
        <a href="{{ route('login') }}">Se connecter</a>
    </div>

</body>
</html>
