<!-- reservations/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">{{ __('予約フォーム') }}</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('予約') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('reservations.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="hospital_id" class="col-md-4 col-form-label text-md-right">{{ __('医療機関ID') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="hospital_id" name="hospital_id" value="{{ $hospital->id }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('ユーザーID') }}</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="user_id" name="user_id" value="{{ Auth::id() }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="am_pm" class="col-md-4 col-form-label text-md-right">{{ __('午前/午後') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="am_pm" name="am_pm">
                                        <option value="0">{{ __('午前') }}</option>
                                        <option value="1">{{ __('午後') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('日付') }}</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('コメント') }}</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" id="comment" name="comment" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">{{ __('予約する') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection