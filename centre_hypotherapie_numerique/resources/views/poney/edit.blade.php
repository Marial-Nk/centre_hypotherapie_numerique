<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Poney</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h2>Modifier Poney</h2>

        <form action="{{ route('poney.update', $poney->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nom :
                <input type="text" name="name" value="{{ $poney->name }}" required>
            </label>

            <label>Temps de Travail (h) :
                <input type="number" name="work_time" value="{{ $poney->work_time }}" required>
            </label>

            <button type="submit">Mettre à jour</button>
        </form>

        <a href="{{ route('poney.index') }}" role="button" class="outline">Annuler</a>
    </main>
</body>
</html>
