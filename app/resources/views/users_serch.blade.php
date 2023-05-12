@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">医療機関ホーム画面</h1>

    <div class="row justify-content-center mb-4">
        <div class="col-md-4">
            <a href="{{ route('hospitals.create') }}" class="btn btn-outline-secondary btn-sm btn-block">{{ __('医療機関情報を登録する') }}</a>
        </div>
    </div>

    <div class="row justify-content-center">
        @if ($hospitals->count() > 0)
            @foreach ($hospitals as $hospital)
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h2 class="mb-0">{{ $hospital->name }}</h2>
                            <h4>{{ $hospital->title }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset('storage/'.$hospital->image) }}" alt="{{ $hospital->name }}" class="img-fluid mb-4">
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $hospital->intro }}</p>
                                    <ul class="list-group">
                                        <li class="list-group-item">{{ __('電話番号') }}：{{ $hospital->tel }}</li>
                                        <li class="list-group-item">{{ __('Webサイト') }}：<a href="{{ $hospital->web_url }}">{{ $hospital->web_url }}</a></li>
                                        @if ($hospital->address)
                                        <li class="list-group-item">{{ __('住所') }}：{{ $hospital->address->post_code }} {{ $hospital->address->ken_name }}{{ $hospital->address->city_name }}{{ $hospital->address->town_name }}{{ $hospital->address->block_name }}</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">{{ __('情報がありません') }}</p>
        @endif
    </div>

    
</div>
@endsection