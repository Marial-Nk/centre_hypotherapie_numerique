@extends('layouts.app')

@section('Poney')

@section('content')
    <div class="flex max-w-6xl mx-auto p-6 space-x-8">
        <!-- Div 1 : Liste des poneys -->
        <div class="w-1/2">
            <h2 class="text-xl font-bold mb-4 text-center">Poneys</h2>

            <div class="space-y-4">
                @foreach($poneys as $poney)
                    <div class="grid grid-cols-3 items-center p-2">
                        <span>{{ $poney->name }}</span>
                        <span>
                            {{ $poney->work_time }}h sur {{ $poney->max_work_time }}h
                            <br>
                            <progress value="{{ $poney->work_time }}" max="{{ $poney->max_work_time }}"></progress>
                        </span>
                        <div class="flex space-x-2">
                            <a href="{{ route('poney.edit', $poney->id) }}" class="text-blue-600">Modifier</a>

                            <form action="{{ route('poney.destroy', $poney->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Div 2 : Formulaire d'ajout -->
        <div class="w-1/2">
            <h3 class="text-xl font-bold mb-4 text-center">Ajouter un nouveau poney</h3>
            
            <form action="{{ route('poney.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block">Nom du poney</label>
                    <input type="text" name="name" placeholder="Nom du poney" required class="w-full p-2 border-gray-300 border rounded">
                </div>

                <div>
                    <label class="block">Heure de travail max (h)</label>
                    <input type="number" name="max_work_time" required min="1" class="w-full p-2 border-gray-300 border rounded">
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Ajouter</button>
            </form>
        </div>
    </div>
@endsection
