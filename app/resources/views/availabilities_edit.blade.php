@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>予約可能時間の編集</h1>
        <h2>{{ $hospital->name }}</h2>

        <form action="{{ route('availabilities.update', ['availability_id' => $availability->id]) }}" method="POST">
            <input type="hidden" name="availability_id" value="{{ $availability->id }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="am_start_time">午前開始時間</label>
                    <input type="time" name="am_start_time" class="form-control" value="{{ $availability->am_start_time }}">
                </div>

                <div class="form-group">
                    <label for="am_end_time">午前終了時間</label>
                    <input type="time" name="am_end_time" class="form-control" value="{{ $availability->am_end_time }}">
                </div>

                <div class="form-group">
                    <label for="pm_start_time">午後開始時間</label>
                    <input type="time" name="pm_start_time" class="form-control" value="{{ $availability->pm_start_time }}">
                </div>

                <div class="form-group">
                    <label for="pm_end_time">午後終了時間</label>
                    <input type="time" name="pm_end_time" class="form-control" value="{{ $availability->pm_end_time }}">
                </div>

                <div class="form-group">
                    <label for="day_limit">受け入れ人数</label>
                    <input type="number" name="day_limit" class="form-control" value="{{ $availability->day_limit }}">
                </div>

                <div class="form-group">
                    <label for="day_of_week">曜日</label>
                    <select name="day_of_week" class="form-control" required>
                        <option value="0" @if($availability->day_of_week === 0) selected @endif>日曜日</option>
                        <option value="1" @if($availability->day_of_week === 1) selected @endif>月曜日</option>
                        <option value="2" @if($availability->day_of_week === 2) selected @endif>火曜日</option>
                        <option value="3" @if($availability->day_of_week === 3) selected @endif>水曜日</option>
                        <option value="4" @if($availability->day_of_week === 4) selected @endif>木曜日</option>
                        <option value="5" @if($availability->day_of_week === 5) selected @endif>金曜日</option>
                        <option value="6" @if($availability->day_of_week === 6) selected @endif>土曜日</option>
                    </select>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('更新') }}
                        </button>
                        <a href="{{ route('hospitals.home') }}" class="btn btn-secondary">{{ __('戻る') }}</a>
                    </div>
                </div>
        </form>
    </div>
@endsection