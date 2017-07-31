<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>RSS Feed | Actioned List</title>
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
            <a href="{{ url('/') }}" class="btn btn-primary">&raquo; Back</a>
        </div>
    </div>
    <br />
    @if(count($rss))
        <h5>Currently Actioned</h5>
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
                    <div class="text-right"><a href="{{ url('feed/delete/' . $feed->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to permanently remove this?')">Delete</a></div>
                </div>
            </div>
        @endforeach

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