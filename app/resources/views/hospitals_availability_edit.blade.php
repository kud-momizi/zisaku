@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('編集') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('availabilities.update', $availability->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="am_start_time" class="col-md-4 col-form-label text-md-right">{{ __('午前開始時間') }}</label>

                                <div class="col-md-6">
                                    <input id="am_start_time" type="time" class="form-control @error('am_start_time') is-invalid @enderror" name="am_start_time" value="{{ $availability->am_start_time ?? old('am_start_time') }}" required autofocus>

                                    @error('am_start_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="am_end_time" class="col-md-4 col-form-label text-md-right">{{ __('午前終了時間') }}</label>

                                <div class="col-md-6">
                                    <input id="am_end_time" type="time" class="form-control @error('am_end_time') is-invalid @enderror" name="am_end_time" value="{{ $availability->am_end_time ?? old('am_end_time') }}" required>

                                    @error('am_end_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="am_limit" class="col-md-4 col-form-label text-md-right">{{ __('午前予約可能数') }}</label>

                                <div class="col-md-6">
                                    <input id="am_limit" type="number" class="form-control @error('am_limit') is-invalid @enderror" name="am_limit" value="{{ $availability->am_limit ?? old('am_limit') }}" required>

                                    @error('am_limit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pm_start_time" class="col-md-4 col-form-label text-md-right">{{ __('午後開始時間') }}</label>

                                <div class="col-md-6">
                                    <input id="pm_start_time" type="time" class="form-control @error('pm_start_time') is-invalid @enderror" name="pm_start_time" value="{{ $availability->pm_start_time ?? old('pm_start_time') }}" required>

                                    @error('pm_start_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pm_end_time" class="col-md-4 col-form-label text-md-right">{{ __('午後終了時間') }}</label>

                                <div class="col-md-6">
                                    <input id="pm_end_time" type="time" class="form-control @error('pm_end_time') is-invalid @enderror" name="pm_end_time" value="{{ old('pm_end_time') ?? $availability->pm_end_time }}" required autocomplete="pm_end_time" autofocus>

                                    @error('pm_end_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pm_limit" class="col-md-4 col-form-label text-md-right">{{ __('午後予約可能数') }}</label>

                                <div class="col-md-6">
                                    <input id="pm_limit" type="number" class="form-control @error('pm_limit') is-invalid @enderror" name="pm_limit" value="{{ old('pm_limit') ?? $availability->pm_limit }}" required autocomplete="pm_limit" autofocus>

                                    @error('pm_limit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('編集完了') }}
                                    </button>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('更新') }}
                                    </button>
                                    <a href="{{ route('home') }}" class="btn btn-secondary">
                                        {{ __('キャンセル') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection