@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">ユーザー一覧</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ユーザー一覧</div>
                    <div class="card-body">
                        <form action="{{ route('users.index') }}" method="GET" class="mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="ユーザー名で検索">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">検索</button>
                                </div>
                            </div>
                        </form>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ユーザー名</th>
                                    <th>作成日時</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($users))
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">削除</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection