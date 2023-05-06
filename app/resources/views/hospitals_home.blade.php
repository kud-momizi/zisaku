@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">医療機関ホーム画面</h1>

    <div class="row justify-content-center mb-4">
        <div class="col-md-4">
            <a href="{{ route('hospitals.create') }}" class="btn btn-outline-secondary btn-sm btn-block">{{ __('医療機関情報を登録する') }}</a>
        </div>
    </div>

    <div class="row justify-content-center">
        @if ($hospitals->count() > 0)
            @foreach ($hospitals as $hospital)
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h2 class="mb-0">{{ $hospital->name }}</h2>
                            <h4>{{ $hospital->title }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset('storage/'.$hospital->image) }}" alt="{{ $hospital->name }}" class="img-fluid mb-4">
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $hospital->intro }}</p>
                                    <ul class="list-group">
                                        <li class="list-group-item">{{ __('電話番号') }}：{{ $hospital->tel }}</li>
                                        <li class="list-group-item">{{ __('Webサイト') }}：<a href="{{ $hospital->web_url }}">{{ $hospital->web_url }}</a></li>
                                        @if ($hospital->address)
                                        <li class="list-group-item">{{ __('住所') }}：{{ $hospital->address->post_code }} {{ $hospital->address->ken_name }}{{ $hospital->address->city_name }}{{ $hospital->address->town_name }}{{ $hospital->address->block_name }}</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">{{ __('情報がありません') }}</p>
        @endif
    </div>

    <!-- <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('曜日') }}</th>
                    <th>{{ __('午前') }}</th>
                    <th>{{ __('午前予約可能数') }}</th>
                    <th>{{ __('午後') }}</th>
                    <th>{{ __('午後予約可能数') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach(['日', '月', '火', '水', '木', '金', '土'] as $idx => $dayOfWeek)
                <tr>
                    <td>{{ $dayOfWeek }}</td>
                    <td>{{ $availabilities[$idx]['am_start_time'] ?? '' }}~{{ $availabilities[$idx]['am_end_time'] ?? '' }}</td>
                    <td>{{ $availabilities[$idx]['am_limit'] ?? '' }}</td>
                    <td>{{ $availabilities[$idx]['pm_start_time'] ?? '' }}~{{ $availabilities[$idx]['pm_end_time'] ?? '' }}</td>
                    <td>{{ $availabilities[$idx]['pm_limit'] ?? '' }}</td>
                    <td>
                        @if (isset($availabilities[$idx]))
                            <a href="{{ route('availabilities.edit', $availabilities[$idx]['id']) }}" class="btn btn-primary btn-sm">{{ __('編集') }}</a>
                        @else
                            <a href="{{ route('availabilities.create') }}" class="btn btn-outline-secondary btn-sm">{{ __('新規登録') }}</a>
                        @endif
                    </td>
                </tr>
                @endforeach
                @if(empty($availabilities))
                <tr>
                    <td colspan="6" class="text-center">{{ __('データなし') }}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div> -->

</div>
@endsection