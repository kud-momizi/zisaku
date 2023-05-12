@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('医療機関情報編集画面') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('hospitals.edit',  ['hospital_id' => $hospital->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('医療機関名') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $hospital->name) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('見出し') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $hospital->title) }}" required autocomplete="title">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('画像') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tel"　class="col-md-4 col-form-label text-md-right">電話番号</label>
                            <!-- <input type="text" class="form-control" id="tel" name="tel"> -->
                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel', $hospital->tel) }}" required autocomplete="tel">

                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="url"　class="col-md-4 col-form-label text-md-right">WebサイトのURL</label>
                            <!-- <input type="text" class="form-control" id="web_url" name="url"> -->
                            <div class="col-md-6">
                                <input id="web_url" type="text" class="form-control @error('web_url') is-invalid @enderror" name="web_url" value="{{ old('web_url', $hospital->web_url) }}" required autocomplete="web_url">

                                @error('web_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="intro" class="col-md-4 col-form-label text-md-right">{{ __('病院紹介文') }}</label>

                            <div class="col-md-6">
                                <textarea id="intro" class="form-control @error('intro') is-invalid @enderror" name="intro" rows="6" required autocomplete="intro">{{ old('intro', $hospital->intro) }}</textarea>

                                @error('intro')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <!-- 住所登録欄 -->
                        <div class="form-group row">
                            <label for="post_code" class="col-md-4 col-form-label text-md-right">{{ __('郵便番号') }}</label>
                            <div class="col-md-6">
                                <input id="post_code" type="text" class="form-control @error('post_code') is-invalid @enderror" name="post_code" value="{{ old('post_code', $hospital->address->post_code) }}" required autocomplete="post_code">
                                @error('post_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ken_name" class="col-md-4 col-form-label text-md-right">{{ __('都道府県名') }}</label>
                            <div class="col-md-6">
                                <input id="ken_name" type="text" class="form-control @error('ken_name') is-invalid @enderror" name="ken_name" value="{{ old('ken_name', $hospital->address->ken_name) }}" required autocomplete="ken_name">

                                @error('ken_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city_name" class="col-md-4 col-form-label text-md-right">{{ __('市区町村名') }}</label>
                            <div class="col-md-6">
                                <input id="city_name" type="text" class="form-control @error('city_name') is-invalid @enderror" name="city_name" value="{{ old('city_name', $hospital->address->city_name) }}" required autocomplete="city_name">

                                @error('city_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="town_name" class="col-md-4 col-form-label text-md-right">{{ __('町名・番地') }}</label>
                            <div class="col-md-6">
                                <input id="town_name" type="text" class="form-control @error('town_name') is-invalid @enderror" name="town_name" value="{{ old('town_name', $hospital->address->town_name) }}" required autocomplete="town_name">

                                @error('town_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="block_name" class="col-md-4 col-form-label text-md-right">{{ __('ビル名・部屋番号（任意）') }}</label>
                            <div class="col-md-6">
                                <input id="block_name" type="text" class="form-control @error('block_name') is-invalid @enderror" name="block_name" value="{{ old('block_name', $hospital->address->block_name) }}" autocomplete="block_name">

                                @error('block_name')
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

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection