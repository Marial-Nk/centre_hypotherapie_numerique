@extends('layouts.app')

@section('title', 'Gestion des Factures')

@section('content')
<h2>{{ \Carbon\Carbon::now()->isoFormat('dddd D MMMM YYYY') }}</h2>

<div class="container">
    <!-- Historique des recettes -->
    <div class="row">
        <div class="col-md-6">
            <h3>Historique des Recettes</h3>
        </div>
    </div>

    <table class="table">
        <tbody>
            @foreach ($recettesParMois as $recette)
            <tr>
                <td>
                    <details>
                        <summary>{{ \Carbon\carbon::parse(trim($recette->mois))->translatedFormat('F Y') }}</summary>
                        @foreach ($clientsParMois as $mois => $clients)
                            @foreach ($clients as $client)
                                <p>{{$client->client_name}}              {{$client-> total_client}}€</p>
                            @endforeach
                        @endforeach
                    </details>
                </td>
                <td>{{ number_format($recette->total, 2) }}€</td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>

<!-- Div 2 : Détails des réservations du mois sélectionné -->
<div class="row mt-4">
    <div class="col-md-8">
        <h3>Mois en cours</h3>
        @foreach ($recettesParMois as $recette)
            @if ( \Carbon\carbon::parse(trim($recette->mois))->month  ==  \Carbon\Carbon::now()->month )
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom du client</th>
                            <th>Nombre de jours</th>
                            <th>Montant à payer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientsParMois as $mois => $clients)
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->client_name }}</td>
                                    <td>{{ $client->jours_reserves }}</td>
                                    <td>{{ number_format($client->total_client, 2) }}€</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            @endif 
        @endforeach
    </div>

    <div>
        @foreach ($recettesParMois as $recette)
            @if ( \Carbon\carbon::parse(trim($recette->mois))->month  ==  \Carbon\Carbon::now()->month )
                <p> Total : {{ number_format($recette->total, 2) }}€   <a href="#">Envoyer toutes les factures </a></p>
            @endif 
        @endforeach
    
</div>
</div>



@endsection
