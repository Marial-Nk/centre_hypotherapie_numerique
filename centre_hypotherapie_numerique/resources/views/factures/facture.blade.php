<!-- Div 2 : Détails des réservations du mois sélectionné -->
<div style=" justify-content: right;">
    <div class="col-md-8">
        <h3 class=" font-bold mb-4 text-center" >Mois en cours :</h3>
        @foreach ($recettesParMois as $recette)
            @if ( \Carbon\carbon::parse(trim($recette->mois))->month  ==  \Carbon\Carbon::now()->month )
                <div  style="border: 0.7px solid black;">
                    <div style="border: 0.7px solid black;">
                        <div class="flex grid grid-cols-3 justify-between" >
                            <div class="font-bold">Nom du client</div>
                            <div class="font-bold">Nombre de jours</div>
                            <div class="font-bold">Montant à payer</div>
                        </div>
                    </div>
                    <div class="mt-4  mb-6">
                        @foreach ($clientsParMois as $mois => $clients)
                            @foreach ($clients as $client)
                                <div  class="flex grid grid-cols-3 justify-between">
                                    <div >{{ $client->client_name }}</div>
                                    <div class="flex justify-center">{{ $client->jours_reserves }}</div>
                                    <div class="flex justify-center ">{{ number_format($client->total_client, 2) }}€</div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            @endif 
        @endforeach
    </div>

    <div>
        @foreach ($recettesParMois as $recette)
            @if ( \Carbon\carbon::parse(trim($recette->mois))->month  ==  \Carbon\Carbon::now()->month )
                <p class="flex grid grid-cols-2 justify-between" style="border: 0.7px solid black;  padding: 10px;">
                    <span class="font-bold" > Total : {{ number_format($recette->total, 2) }}€  </span>
                    <span class="flex justify-end">  <a href="#" style="color:blue;">Envoyer toutes les factures  <i class="fa-solid fa-paper-plane"></i> </a> </span>
                </p>   
            
            @endif 
        @endforeach
    
</div>
</div>
