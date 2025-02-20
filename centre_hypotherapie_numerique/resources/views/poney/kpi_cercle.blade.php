<!-- KPI en Cercles -->
<div style="border-raduis:100px; padding: 10px;background-color: #E8E8E8;">
    <u> <h2  class="flex justify-center text-xl font-bold mb-6 text-center" >Statistiques Poneys</h2> </u>

    <div class="grid grid-cols-3 gap-4 text-center">
            @foreach ([
                ['label' => 'Heures travaillées / Heures max  ', 'value' => $workHourRatio, 'color' => '#4caf50'],
                ['label' => 'Poneys Disponibles', 'value' => $availablePoneys, 'color' => '#4caf50'],
                ['label' => 'Poneys en Repos', 'value' => $restingPoneys, 'color' => '#4caf50']
            ] as $kpi)
                @php
                    $radius = 40;
                    $circumference = 2 * pi() * $radius;
                    $offset = $circumference - ($kpi['value'] / max(1, 100)) * $circumference;
                @endphp
                <div class="flex flex-col items-center">
                    <svg width="100" height="100" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="{{ $radius }}" stroke="#ddd" stroke-width="10" fill="none"/>
                        <circle cx="50" cy="50" r="{{ $radius }}" stroke="{{ $kpi['color'] }}" stroke-width="10" fill="none"
                            stroke-dasharray="{{ $circumference }}" stroke-dashoffset="{{ $offset }}"
                            stroke-linecap="round"
                            transform="rotate(-90 50 50)"/>
                        <text x="50" y="50" text-anchor="middle" alignment-baseline="middle" font-size="14" fill="#000">
                            {{ $kpi['value'] }}%
                        </text>
                    </svg>
                    <p class="mt-2 font-semibold">{{ $kpi['label'] }}</p>
                </div>
            @endforeach
    </div>

</div>