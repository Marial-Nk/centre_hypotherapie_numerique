<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h2>Modifier l'utilisateur</h2>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nom :
                <input type="text" name="name" value="{{ $user->name }}" required>
            </label>

            <label>Email :
                <input type="email" name="email" value="{{ $user->email }}" required>
            </label>

            <button type="submit">Mettre à jour</button>
        </form>

        <a href="{{ route('users.index') }}" role="button" class="outline">Annuler</a>
    </main>
</body>
</html>
