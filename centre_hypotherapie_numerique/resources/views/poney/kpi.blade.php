@extends('layouts.app')

@section('title', 'KPI - Gestion des Poneys')

@section('content')
<div class="container">
<h2 style="text-align: center;">Statistiques Poneys</h2>

    <!-- KPI en Cercles -->
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

    <!-- Utilisation des poneys (Rectangles) -->
    <h3 class="text-lg font-bold mt-6 text-center">Utilisation des poneys/jour</h3>
    <div class="grid grid-cols-3 gap-4 text-center">
        @foreach ($poneys as $poney)
            @php
                $percentage = $poney->max_work_time > 0 ? ($poney->work_time / $poney->max_work_time) * 100 : 0;
            @endphp
            <div class="flex flex-col items-center">
                <div style="width: 80px; height: 40px; background-color: #4caf50; opacity: {{ $percentage / 100 }};">
                    <p class="text-white font-bold">{{ $poney->work_time }}h</p>
                </div>
                <p class="mt-2">{{ $poney->name }}</p>
            </div>
        @endforeach
    </div>

    <!-- Sélecteur de Mois -->
    <h3 class="text-lg font-bold mt-6 text-center">Utilisation des poneys par période (h)</h3>
    <form method="GET" class="text-center">
        <input type="month" name="month" value="{{ $month }}" class="border p-2 rounded">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Choisir</button>
    </form>

    <!-- Histogramme Vertical -->
    <div class="flex justify-center items-end mt-6 space-x-4" style="height: 250px;">
        @foreach ($poneyUsage as $poneyName => $hours)
            @php
                $barHeight = $hours * 10; // Ajuste l'échelle pour la hauteur
                $color = '#' . substr(md5($poneyName), 0, 6); // Génère une couleur unique par poney
            @endphp
            <div class="flex flex-col items-center">
                <!-- Barre de l'histogramme -->
                <div style="width: 40px; height: {{ $barHeight }}px; background-color: {{ $color }}; border-radius: 5px;">
                </div>
                <p class="mt-2 text-sm font-semibold">{{ $poneyName }}</p>
                <p class="text-xs">{{ round($hours, 1) }}h</p>
            </div>
        @endforeach
    </div>

</div>
@endsection
