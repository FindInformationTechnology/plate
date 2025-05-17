<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
    @foreach ($breadcrumbs as $breadcrumb)
        <li class="breadcrumb-item text-muted">
            @if($breadcrumb['url'])
                <a href="{{ $breadcrumb['url'] }}" class="text-muted text-hover-primary">{{ $breadcrumb['text'] }}</a>
            @else
                <span>{{ $breadcrumb['text'] }}</span>
            @endif
        </li>
        @if(!$loop->last)
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-500 w-5px h-2px"></span>
            </li>
        @endif
    @endforeach
</ul>
