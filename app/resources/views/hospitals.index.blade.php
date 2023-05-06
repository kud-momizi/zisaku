@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>医療機関ホーム画面</h1>

        <a href="{{ route('hospitals.create') }}">医療機関情報を登録する</a>

        <!-- 以下、ホーム画面のコンテンツを表示する -->
    </div>
@endsection