@extends('layouts.app')

@section('content')

<div class="container">
    <h1>予約者一覧 - {{ $hospital->name }}</h1>
    <div class="row">
        @foreach($reservationsByDate as $date => $reservations)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ $date }}</div>
                    <div class="card-body">
                        <ul>
                            @foreach($reservations as $reservation)
                                <li>{{ $reservation->user->name }} - {{ $reservation->comment }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection