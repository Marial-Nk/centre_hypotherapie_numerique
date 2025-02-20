@extends('layouts.app')

@section('title', 'Liste des Utilisateurs')

@section('content')
        <h2  class="text-xl font-bold mb-4 text-center">Gestion des utilisateurs</h2>
        <a href="{{ route('users.logoutAndRegister') }}" role="button" class="outline mb-4">Ajouter un utilisateur</a>

        <div style="border: 0.7px solid black;">
            <div style="border: 0.7px solid black; padding: 10px;" >
                <div class="flex grid grid-cols-4 justify-between">
                    <div class="font-bold">ID</div>
                    <div class="font-bold">Nom</div>
                    <div class="font-bold">Email</div>
                    <div class="font-bold">Actions</div>
                </div>
            </div>
            <div >
                @foreach($users as $user)
                <div class="flex grid grid-cols-4 justify-between" style="border: 0.7px solid black;" >
                    <div style="padding: 10px;">{{ $user->id }}</div>
                    <div style="padding: 10px;">{{ $user->name }}</div>
                    <div style="padding: 10px;">{{ $user->email }}</div>
                    <div style="padding: 10px;" class="flex space-x-2" >
                        <form action="{{ route('users.edit', $user->id) }}" method="POST" class="inline">
                            @csrf
                            @method('GET')
                            <button type="submit" ><i class="fa fa-edit"></i></button>
                        </form>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="background-color: #d9534f; margin-left: 10px;"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>

                </div>
                @endforeach
        </div>
    </div>
@endsection
