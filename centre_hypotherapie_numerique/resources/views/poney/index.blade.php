@extends('layouts.app')

@section('Poney')

@section('content')

    <div style="padding: 15px;">
        <h2 class="flex justify-center text-xl font-bold mb-4 text-center">Gestion des poneys</h2>
        
        <div class="flex grid grid-cols-2 ">
            <div >
                @include('poney.list')
            </div>
            <div class="gap-2 ">
                @include('poney.create')
            </div>
        </div>
    </div>

@endsection
