<!-- Liste des rendez-vous du jour -->
<h3 class="text-xl font-bold mb-4 text-center">Rendez-vous prévus:</h3>

<table class="table" style="border: 0.7px solid black;">
    <tbody>
        @forelse($reservations as $reservation)
        <tr>
            <td style="border: 0.7px solid black;">
                <details>
                    <summary>{{ $reservation->client_name }} <span style="padding-left: 15em; "> {{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }} à {{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }} </span></summary>
                    <p><strong>Nombre de personnes :</strong> {{ $reservation->people_count }}</p>
                    <p><strong>Poneys assignés :</strong> {{ $reservation->poneys->pluck('name')->implode(', ') ?: 'Aucun' }}</p>
                </details>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="4" style="border: 0.7px solid black;">Aucun rendez-vous prévu aujourd’hui.</td>
        </tr>
        @endforelse
    </tbody>
</table>
