@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Gestion des Factures</h1>

    <!-- Div 1 : Historique des recettes -->
    <div class="row">
        <div class="col-md-6">
            <h3>Historique des Recettes</h3>
            <ul class="list-group">
                @foreach ($recettesParMois as $recette)
                    <li class="list-group-item">
                        <a href="{{ route('factures.index', ['mois' => $recette->mois]) }}">
                            {{ $recette->mois }} - {{ number_format($recette->total, 2) }}€
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Div 2 : Détails des réservations du mois sélectionné -->
    <div class="row mt-4">
        <div class="col-md-8">
            <h3>Recettes du Mois : {{ $moisSelectionne }}</h3>

            @if ($facturesDuMois->isEmpty())
                <p>Aucune réservation pour ce mois.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Jours Réservés</th>
                            <th>Total (€)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facturesDuMois as $facture)
                            <tr>
                                <td>{{ $facture->client }}</td>
                                <td>{{ $facture->jours_reserves }}</td>
                                <td>{{ number_format($facture->total_reservations, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Div 3 : Total du mois -->
    <div class="row mt-4">
        <div class="col-md-8">
            <h3>Total du Mois : {{ number_format($totalMois, 2) }}€</h3>
        </div>
    </div>
</div>
@endsection
