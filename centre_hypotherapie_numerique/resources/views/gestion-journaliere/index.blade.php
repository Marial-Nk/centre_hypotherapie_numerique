<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Journalière</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h2>📅 Gestion Journalière - {{ $date_du_jour }}</h2>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <!-- Liste des rendez-vous du jour -->
        <h3>📌 Rendez-vous prévus</h3>
        <table>
            <thead>
                <tr>
                    <th>Nom du Client</th>
                    <th>Personnes</th>
                    <th>Horaire</th>
                    <th>Poneys Assignés</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->client_name }}</td>
                    <td>{{ $reservation->people_count }}</td>
                    <td>{{ $reservation->start_time }} - {{ $reservation->end_time }}</td>
                    <td>
                        @foreach($reservation->poneys as $poney)
                            {{ $poney->name }},
                        @endforeach
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Aucun rendez-vous prévu aujourd’hui.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Ajouter un client spontané -->
        <h3>➕ Ajouter un Client Spontané</h3>
        <form action="{{ route('reservation.store') }}" method="POST">
            @csrf

            <label>Nom du client :
                <input type="text" name="client_name" value="{{ old('client_name') }}" required>
            </label>

            <label>Nombre de personnes :
                <input type="number" id="people_count" name="people_count" min="1" value="{{ old('people_count') }}" required>
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
                    <input type="checkbox" name="poneys[]" value="{{ $poney->id }}">
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
