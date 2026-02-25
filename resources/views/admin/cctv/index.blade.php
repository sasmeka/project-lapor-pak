{{-- @extends('layouts.adminside')

@section('title', 'CCTV Live Monitor')

@section('content')
<div class="py-3">
    <div class="card shadow-sm">
        <div class="card-body">
            <video id="video" controls autoplay width="100%"></video>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script>
    var video = document.getElementById('video');
    var videoSrc = "{{ $streamUrl }}";

    if (Hls.isSupported()) {
        var hls = new Hls();
        hls.loadSource(videoSrc);
        hls.attachMedia(video);
    } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
        video.src = videoSrc;
    }
</script>
@endsection --}}

{{-- pake API --}}
@extends('layouts.adminside')

@section('title', 'CCTV Live Monitor')


@section('content')
<div class="container">
    <video id="video" controls autoplay width="100%"></video>
</div>

<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script>
    var video = document.getElementById('video');
    var videoSrc = "{{ $streamUrl }}";

    if (Hls.isSupported()) {
        var hls = new Hls();
        hls.loadSource(videoSrc);
        hls.attachMedia(video);
    }
</script>
@endsection