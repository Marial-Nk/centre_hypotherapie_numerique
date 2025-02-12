<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Réservation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h2>Ajouter une Réservation</h2>

        <form action="{{ route('reservation.store') }}" method="POST">
    @csrf

    <label>Nom du client :
        <input type="text" name="client_name" value="{{ old('client_name') }}" required>
    </label>

    <label>Nombre de personnes :
        <input type="number" name="people_count" min="1" value="{{ old('people_count') }}" required>
    </label>

    <label>Tranche horaire :
        <input type="time" name="start_time" value="{{ old('start_time') }}" required> -
        <input type="time" name="end_time" value="{{ old('end_time') }}" required>
    </label>

    <label>Prix (€) :
        <input type="number" name="price" min="0" value="{{ old('price') }}" required>
    </label>

    <label>Poneys assignés :</label>
    @foreach($poneys as $poney)
        <label>
            <input type="checkbox" name="poneys[]" value="{{ $poney->id }}" 
                   {{ (is_array(old('poneys')) && in_array($poney->id, old('poneys'))) ? 'checked' : '' }}>
            {{ $poney->name }}
        </label>
    @endforeach

    @if ($errors->has('poneys'))
        <p style="color: red;">{{ $errors->first('poneys') }}</p>
    @endif

    <button type="submit" class="primary">Confirmer</button>
</form>

    </main>
</body>
</html>
