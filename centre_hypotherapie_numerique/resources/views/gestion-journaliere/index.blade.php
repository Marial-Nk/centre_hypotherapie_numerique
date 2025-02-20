@extends('layouts.app')

@section('title', 'Gestion journalière')

@section('content')


<div style="padding: 15px;">    
    <h2 class="text-xl font-bold mb-4 text-center">{{ \Carbon\Carbon::now()->isoFormat('dddd D MMMM YYYY') }}</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <div class="flex grid grid-cols-2  mt-4">
        <div >
            @include('gestion-journaliere.list_rdv')
        </div>
        <div class="gap-2 ">
            @include('gestion-journaliere.create_rdv')
        </div>
    </div>
</div>
@endsection