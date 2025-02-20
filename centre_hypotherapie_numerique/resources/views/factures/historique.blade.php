<div style=" justify-content: left;">
    <!-- Historique des recettes -->
    
    <h3 class="font-bold mb-4  text-center">Historique des Recettes:</h3>

    <table class="table">
        <tbody>
            @foreach ($recettesParMois as $recette)
            <tr>
                <td style="border: 0.7px solid black;">
                    <details>
                        <summary>{{ \Carbon\carbon::parse(trim($recette->mois))->translatedFormat('F Y') }}  <span style="padding-left: 15em; ">  {{ number_format($recette->total, 2) }}€ </span> </summary>
                        @foreach ($clientsParMois as $mois => $clients)
                            @foreach ($clients as $client)
                                <p class="flex grid grid-cols-2 justify-between">
                                    <span> {{$client->client_name}}  </span>
                                    <span class="flex justify-end">  {{$client-> total_client}}€ </span>
                                </p>
                            @endforeach
                        @endforeach
                    </details>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>