<div class="card">
    <div class="card-header">
        <a class="nav-link" data-toggle="collapse" href="#collapseTags" role="button" aria-expanded="false" aria-controls="collapseTags">メニュー　　　▼</a>
    </div>
    <div class="collapse" id="collapseTags">
        <div class="card-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admins.home') }}">ホーム</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tags.create') }}">新規登録</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tags.index') }}">一覧</a>
                </li>
            </ul>
        </div>
    </div>
</div>