@extends('layouts.app')

@section('title', 'Liste des Voitures')

@section('content')
        <h2>Gestion des utilisateurs</h2>
        <a href="{{ route('users.logoutAndRegister') }}" role="button" class="outline">Ajouter un utilisateur</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="outline">Modifier</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="outline secondary">Supprimer</button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
@endsection
