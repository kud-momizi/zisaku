@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>予約者一覧</h1>
        <div class="row">
            @foreach($reservationsByDate as $date => $reservations)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">{{ $date }}</div>
                        <div class="card-body">
                            <ul>
                                @if($reservations->isEmpty())
                                    <li>予約者はいません</li>
                                @else
                                    @foreach($reservations as $reservation)
                                        @if ($reservation->user)
                                            <li>{{ $reservation->user->name }}</li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection