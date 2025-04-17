@extends('layouts.app')

@section('title', 'Confirmation de réservation')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body text-center">
            <h2 class="mb-4 text-success">🎉 Réservation confirmée !</h2>
            <p>{{ $prestation->id }}</p>
        </div>
    </div>
</div>
@endsection
