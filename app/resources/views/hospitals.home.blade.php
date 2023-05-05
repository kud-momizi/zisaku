@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Hospital Home') }}</div>

                <div class="card-body">
                    <h3>{{ $hospital->name }}</h3>
                    <img src="{{ $hospital->image }}" alt="{{ $hospital->name }}">

                    <h4>Information</h4>
                    <p>{{ $hospital->description }}</p>
                    <p>Address: {{ $hospital->address }}</p>
                    <p>Phone: {{ $hospital->phone }}</p>
                    <p>Email: {{ $hospital->email }}</p>
                    <p>Map: {{ $hospital->map }}</p>

                    <h4>Reservations</h4>
                    <ul>
                        @foreach($reservations as $reservation)
                            <li>{{ $reservation->user->name }} {{ $reservation->date }} {{ $reservation->time }}</li>
                        @endforeach
                    </ul>

                    <h4>Tags</h4>
                    <ul>
                        @foreach($hospital->tags as $tag)
                            <li>{{ $tag->name }}</li>
                        @endforeach
                    </ul>

                    <a href="{{ route('hospital.edit', ['id' => $hospital->id]) }}" class="btn btn-primary">Edit Hospital Information</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection