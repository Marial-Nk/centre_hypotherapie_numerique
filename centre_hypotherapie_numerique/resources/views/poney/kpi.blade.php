@extends('layouts.app')

@section('title', 'KPI - Gestion des Poneys')

@section('content')

<div style="padding: 15px;">    

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <div class="flex grid grid-cols-2   mt-8">
        <div > 
            <div >
                @include('poney.kpi_cercle')
            </div>
            <div >
                @include('poney.kpi_rectangle')
            </div>
        </div>

        <div class="gap-2 ">
            @include('poney.kpi_histogram')
        </div>
    </div>
</div>

@endsection
