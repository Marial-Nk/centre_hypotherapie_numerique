@extends('layouts.app')

@section('title', 'Gestion journalière')

@section('content')
<h2>{{ \Carbon\Carbon::now()->isoFormat('dddd D MMMM YYYY') }}</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<!-- Liste des rendez-vous du jour -->
<h3>Rendez-vous prévus</h3>
<table class="table">
    <tbody>
        @forelse($reservations as $reservation)
        <tr>
            <td>
                <details>
                    <summary>{{ $reservation->client_name }}</summary>
                    <p><strong>Nombre de personnes :</strong> {{ $reservation->people_count }}</p>
                    <p><strong>Poneys assignés :</strong> {{ $reservation->poneys->pluck('name')->implode(', ') ?: 'Aucun' }}</p>
                </details>
            </td>
            <td>{{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }} à {{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}</td>
        </tr>

        @empty
        <tr>
            <td colspan="4">Aucun rendez-vous prévu aujourd’hui.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Ajouter un client spontané -->
<h3>Enregistrer un nouveau client</h3>
<form action="{{ route('reservation.store') }}" method="POST">
    @csrf

        <input type="text" name="client_name" value="{{ old('client_name') }}" required placeholder="Nom du client">

        <input type="number" id="people_count" name="people_count" min="1" value="{{ old('people_count') }}" required placeholder="Nbre personnes">

        <input type="time" name="start_time" value="{{ old('start_time') }}" required> à
        <input type="time" name="end_time" value="{{ old('end_time') }}" required>

        <input type="number" name="price" min="0" value="{{ old('price') }}" required placeholder="Prix">

    <label>Assigner des poneys</label>
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
@endsection