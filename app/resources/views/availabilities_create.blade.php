@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>予約可能時間の登録</h1>
        <h2>{{ $hospital->name }}</h2>

        <form action="{{ route('availabilities.store',  ['hospital_id' => $hospital->id]) }}" method="POST">
            <input type="hidden" name="hospital_id" value="{{ $hospital->id }}">
            @csrf

            <div class="form-group">
                <label for="am_start_time">午前開始時間</label>
                <input type="time" name="am_start_time" class="form-control">
            </div>

            <div class="form-group">
                <label for="am_end_time">午前終了時間</label>
                <input type="time" name="am_end_time" class="form-control">
            </div>

            <div class="form-group">
                <label for="pm_start_time">午後開始時間</label>
                <input type="time" name="pm_start_time" class="form-control">
            </div>

            <div class="form-group">
                <label for="pm_end_time">午後終了時間</label>
                <input type="time" name="pm_end_time" class="form-control">
            </div>

            <div class="form-group">
                <label for="day_limit">受け入れ人数</label>
                <input type="number" name="day_limit" class="form-control">
            </div>

            <div class="form-group">
                <label for="day_of_week">曜日</label>
                <select name="day_of_week" class="form-control" required>
                    <option value="0">日曜日</option>
                    <option value="1">月曜日</option>
                    <option value="2">火曜日</option>
                    <option value="3">水曜日</option>
                    <option value="4">木曜日</option>
                    <option value="5">金曜日</option>
                    <option value="6">土曜日</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">登録する</button>
        </form>
    </div>
@endsection