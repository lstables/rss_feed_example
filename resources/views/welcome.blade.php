<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>RSS Feed</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/sweetalert.css">

</head>
<body>

<div class="container">

    <div class="panel panel-default">
        <div class="panel-body">
            <a href="{{ url('feed/actioned') }}" class="btn btn-primary">Actioned List</a>
        </div>
    </div>
    <br />
    @if(count($rss))
        @foreach ($rss as $feed)
        <div class="panel panel-default">
            <div class="panel-heading"><a href="{{ $feed->link }}">{{ $feed->title }}</a></div>
            <div class="panel-body">
                <p>
                    {!! $feed->description !!}
                </p>
            </div>

            <div class="panel-footer">
                <div class="text-left"> <small>Published: {{ \Carbon\Carbon::parse($feed->pubDate)->format('j F Y H:i:s') }}</small></div>
                <div class="text-right"><a href="{{ url('feed/action/' . $feed->id) }}" class="btn btn-sm btn-info">Action</a></div>
            </div>
        </div>
        @endforeach

        {{ $rss->links() }}
    @else
        <p>Nothing to show, perhaps the artisan command needs running?</p>
    @endif

</div>

<!-- javascript/jQuery -->
<script src="https://code.jquery.com/jquery-3.2.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="/js/sweetalert.js"></script>
@include('Alerts::show')
</body>
</html>