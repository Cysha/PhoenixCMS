<head>
    <title>{{ Theme::getTitle() }}</title>
    <meta http-equiv="Content-Type" charset="text/html;utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ $keywords or '' }}">
    <meta name="description" content="{{ $description or '' }}">

    @if(Request::has('page'))
    <link rel="prefetch" href="{{{ $_SERVER['REDIRECT_URL'].'?page='.(Request::get('page')+1) }}}" />
    @endif

    {!! Theme::asset()->styles() !!}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
