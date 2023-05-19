@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>タグの新規作成</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tags.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">タグ名</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">作成</button>
        </form>

        <h4 class="mt-4">タグ一覧</h4>
        <div class="row mt-4">
            @foreach ($tags as $tag)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            {{ $tag->name }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>

    
@endsection