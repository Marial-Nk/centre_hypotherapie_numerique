@extends('layouts.app')

@section('title', 'Gestion des Factures')

@section('content')

<div style="padding: 15px;">    
    <h2 class="text-xl font-bold mb-4 text-center">{{ \Carbon\Carbon::now()->isoFormat('dddd D MMMM YYYY') }}</h2>

    <div class="flex grid grid-cols-2  mt-4">
        <div >
            @include('factures.historique')
        </div>
        <div class="gap-2 ">
            @include('factures.facture')
        </div>
    </div>
</div>


@endsection
