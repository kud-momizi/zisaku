@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">管理者ホーム画面</h1>

        <div class="row">
            <div class="col-md-3">
                @include('partials.sidebar')
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">検索</div>
                    <div class="card-body">
                        <form action="{{ route('admins.search') }}" method="GET">
                            <div class="form-group">
                                <label for="search_hospital">フリーワード（病院名）</label>
                                <input type="text" name="search_hospital" id="search_hospital" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="search_address">住所</label>
                                <input type="text" name="search_address" id="search_address" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="search_hours">診療時間</label>
                                <input type="text" name="search_hours" id="search_hours" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">検索</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


<div class="card mt-4">
        <div class="card-header">検索結果</div>
        <div class="card-body">
            @if (isset($hospitals) && $hospitals->count() > 0)
                <div class="row">
                    @foreach ($hospitals as $hospital)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">{{ $hospital->name }}</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>タイトル:</strong> {{ $hospital->title }}</p>
                                    <p><strong>住所:</strong> {{ $hospital->address->post_code }} {{ $hospital->address->ken_name }}{{ $hospital->address->city_name }}{{ $hospital->address->town_name }}{{ $hospital->address->block_name }}</p>
                                    <a href="{{ route('admins.show', $hospital->id) }}" class="btn btn-primary">詳細を見る</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center">検索結果がありません</p>
            @endif
        </div>
    </div>
@endsection