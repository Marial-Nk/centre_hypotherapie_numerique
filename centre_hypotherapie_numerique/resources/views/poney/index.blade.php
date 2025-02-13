<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Poneys</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h2>Liste des Poneys</h2>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Temps de Travail (h)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($poneys as $poney)
                <tr>
                    <td>{{ $poney->name }}</td>
                    <td>{{ $poney->work_time }} h</td>
                    <td>
                        <a href="{{ route('poney.edit', $poney->id) }}" class="outline">Modifier</a>

                        <form action="{{ route('poney.destroy', $poney->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="outline secondary">Supprimer</button>
                        </form>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Formulaire d'ajout d'un nouveau poney -->
        <div class="container">
            <h3>Ajouter un Poney</h3>
            <form action="{{ route('poney.store') }}" method="POST">
                @csrf

                <label>Nom :
                    <input type="text" name="name" placeholder="Nom du poney" required>
                </label>

                <label>Temps de Travail (h) :
                    <input type="number" name="work_time" placeholder="Heures de travail" required>
                </label>

                <button type="submit" class="primary">Ajouter</button>
            </form>
        </div>

    </main>
</body>
</html>
