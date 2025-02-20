<!-- Utilisation des poneys (Rectangles) -->
<div class="mt-6" style="border: 0.7px solid black; padding: 10px;">
    <u> <h3 class="flex justify-center text-xl font-bold mb-4 text-center mt-6 mb-6">Utilisation des poneys/jour</h3> </u>
    <div class="grid grid-cols-3 gap-4 text-center mb-6">
        @foreach ($poneys as $poney)
            @php
                $percentage = $poney->max_work_time > 0 ? ($poney->work_time / $poney->max_work_time) * 100 : 0;
            @endphp
            <div class="flex flex-col items-center">
                <div style="width: 80px; height: 40px; background-color: green; opacity: {{ $percentage / 100 }};">
                    <p class="text-white font-bold">{{ $poney->work_time }}h</p>
                </div>
                <p class="mt-2">{{ $poney->name }}</p>
            </div>
        @endforeach
    </div>
</div>