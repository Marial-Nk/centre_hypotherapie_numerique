<!-- Sélecteur de Mois -->
<div style="border-raduis:100px; padding: 10px;background-color: #98F5F9;">
    <u><h2 class="flex justify-center font-bold mb-4 text-center mt-6 mb-6">Utilisation des poneys par période (h)</h2> </u>
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
            <div class="flex flex-col items-center " style="margin-left: 10px;">
                <p class="text-xs">{{ round($hours, 1) }}h</p>
                <p class="mt-2 text-sm font-semibold">{{ $poneyName }} </p>
                <!-- Barre de l'histogramme -->
                <div style="width: 40px; height: {{ $barHeight }}px; background-color: {{ $color }}; border-radius: 5px;">
                </div>
                
            </div>
        @endforeach
    </div>
</div>