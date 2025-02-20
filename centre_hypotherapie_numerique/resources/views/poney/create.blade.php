<!-- Div 2 : Formulaire d'ajout -->
<div style="border: 1px solid black;  padding: 10px; justify-content: right;background-color: #E8E8E8;">

    <h3 class="text-xl font-bold mb-4 text-center">Ajouter un nouveau poney</h3>
    
    <form action="{{ route('poney.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="flex grid grid-cols-2 justify-between">
            <div>
                <label class="block">Nom du poney</label>
                <input type="text" name="name" placeholder="Nom du poney" required class="w-full p-2 border-gray-300 border rounded">
            </div>

            <div>
                <label class="block">Heure de travail max (h)</label>
                <input type="number" name="max_work_time" required min="1" class="w-full p-2 border-gray-300 border rounded">
            </div>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Ajouter</button>
    </form>
</div>