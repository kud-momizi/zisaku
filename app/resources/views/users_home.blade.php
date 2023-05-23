@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">ユーザーホーム画面</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">検索</div>
                    <div class="card-body">
                        <form action="{{ route('hospitals.search') }}" method="GET">
                            <div class="form-group">
                                <label for="search_hospital">フリーワード（病院名）</label>
                                <input type="text" name="search_hospital" id="search_hospital" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="search_prefecture">都道府県</label>
                                <input type="text" name="search_prefecture" id="search_prefecture" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="search_city">市区町村</label>
                                <input type="text" name="search_city" id="search_city" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="search_address">町名番地</label>
                                <input type="text" name="search_address" id="search_address" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="search_tag">タグ</label>
                                <select name="search_tag" id="search_tag" class="form-control">
                                    <option value="">選択してください</option>
                                    @isset($tags)
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
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
                                        <a href="{{ route('hospitals.show', $hospital->id) }}" class="btn btn-primary">詳細を見る</a>
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

        <div class="card mt-4">
            <div class="card-header">予約済みの病院</div>
            <div class="card-body">
                @if (isset($reservedHospitals) && $reservedHospitals->count() > 0)
                    <div class="row">
                        @foreach ($reservedHospitals as $hospital)
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">{{ $hospital->name }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>タイトル:</strong> {{ $hospital->title }}</p>
                                        <p><strong>住所:</strong> {{ $hospital->address->post_code }} {{ $hospital->address->ken_name }}{{ $hospital->address->city_name }}{{ $hospital->address->town_name }}{{ $hospital->address->block_name }}</p>
                                        <p><strong>予約日:</strong> {{ $hospital->reservation->date }}</p>
                                        <a href="{{ route('hospitals.show', $hospital->id) }}" class="btn btn-primary">詳細を見る</a>
                                        <form action="{{ route('reservations.cancel', $hospital->reservation->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">予約キャンセル</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center">予約済みの病院はありません</p>
                @endif
            </div>
        </div>
    </div>
@endsection
