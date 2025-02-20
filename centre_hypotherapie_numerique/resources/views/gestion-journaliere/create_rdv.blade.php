<!-- Ajouter un client spontané -->
<h3 class="text-xl font-bold mb-4 text-center">Enregistrer un nouveau client:</h3>

<form action="{{ route('reservation.store') }}" method="POST" style="border: 0.7px solid black; padding: 10px; background-color: #E8E8E8;">
    @csrf

        <div class="flex grid grid-cols-2 justify-between">
            <input type="text" name="client_name" value="{{ old('client_name') }}" required placeholder="Nom du client">
            <input type="number" id="people_count" name="people_count" min="1" value="{{ old('people_count') }}" required placeholder="Nbre personnes">
        </div>
        
        <div class="flex grid grid-cols-2 justify-between">
            De:<input type="time" name="start_time" value="{{ old('start_time') }}" required> à
            <input type="time" name="end_time" value="{{ old('end_time') }}" required>
        </div>
        <input type="number" name="price" min="0" value="{{ old('price') }}" required placeholder="Prix">

    <strong>Assigner des poneys</strong>
    @foreach($poneys as $poney)
        <div class="flex grid grid-cols-2 justify-between">
            <div>
                <input type="checkbox" name="poneys[]" value="{{ $poney->id }}">
                {{ $poney->name }}
            </div>
            
        </div>
    @endforeach

    @if ($errors->has('poneys'))
        <p style="color: red;">{{ $errors->first('poneys') }}</p>
    @endif

    <button type="submit" class="primary mt-4">Confirmer</button>
</form>