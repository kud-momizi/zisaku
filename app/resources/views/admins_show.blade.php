
@section('content')

<div class="container">
    <h1 class="text-center">医療機関詳細画面</h1>

    <div class="row justify-content-center">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-0">{{ $hospital->name }}</h2>
                        <h4>{{ $hospital->title }}</h4>
                    </div>
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
                        <!-- マップ -->
                        <div class="col-md-12 my-4">
                            <div id="map" style="height: 400px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('受診時間') }}</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('曜日') }}</th>
                                    <th>{{ __('午前') }}</th>
                                    <th>{{ __('午前予約可能数') }}</th>
                                    <th>{{ __('午後') }}</th>
                                    <th>{{ __('午後予約可能数') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(['日', '月', '火', '水', '木', '金', '土'] as $idx => $dayOfWeek)
                                    <tr>
                                        @if ($dayOfWeek === '日' || $dayOfWeek === '土')
                                            <td class="text-danger">{{ $dayOfWeek }}</td>
                                        @else
                                            <td>{{ $dayOfWeek }}</td>
                                        @endif
                                        <td>{{ $hospital->availabilities[$idx]['am_start_time'] ?? '' }}~{{ $hospital->availabilities[$idx]['am_end_time'] ?? '' }}</td>
                                        <td>{{ $hospital->availabilities[$idx]['am_limit'] ?? '' }}</td>
                                        <td>{{ $hospital->availabilities[$idx]['pm_start_time'] ?? '' }}~{{ $hospital->availabilities[$idx]['pm_end_time'] ?? '' }}</td>
                                        <td>{{ $hospital->availabilities[$idx]['pm_limit'] ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function initMap() {
        var map, map_center;
        var opts = {
            zoom: 16, // 初期のズームレベル
            mapTypeId: "roadmap" // 初期マップタイプ
        };

        map = new google.maps.Map(document.getElementById("map"), opts);

        var geocoder = new google.maps.Geocoder();
        var address = "{{ $hospital->address->post_code }} {{ $hospital->address->ken_name }}{{ $hospital->address->city_name }}{{ $hospital->address->town_name }}{{ $hospital->address->block_name }}";

        geocoder.geocode({ 'address': address }, function(results, status) {
            if (status === 'OK' && results[0]) {
                map_center = results[0].geometry.location;
                map.setCenter(map_center);

                var marker = new google.maps.Marker({
                    map: map,
                    position: map_center,
                    animation: google.maps.Animation.DROP,
                    title: "{{ $hospital->name }}"
                });

                var infowindow = new google.maps.InfoWindow({
                    content: '<div id="map_content"><p>{{ $hospital->name }}<br />{{ $hospital->address->post_code }} {{ $hospital->address->ken_name }}{{ $hospital->address->city_name }}{{ $hospital->address->town_name }}{{ $hospital->address->block_name }}</p></div>'
                });

google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map, marker);
});
} else {
alert("住所から位置の取得ができませんでした。: " + status);
}
});
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRa-cremQslgLCSgbEImhI5WZADCBZZEM&callback=initMap" async defer></script>