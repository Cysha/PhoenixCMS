<!doctype html>
<!--[if lt IE 9]><html class="ie"><![endif]-->
<!--[if gte IE 9]><html class=""><![endif]-->
<head>
<title>{{{ Theme::place('title') }}}</title>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1, userscalable=no" />
<meta name="keywords" content="{{ Theme::place('keywords') }}" />
<meta name="description" content="{{ Theme::place('description') }}" />

@if( Request::has('page') )
<link rel="prefetch" href="{{ $_SERVER['REDIRECT_URL'].'?page='.(Request::get('page')+1) }}" />
@endif

{{ Assets::css() }}
{{ Theme::asset()->styles() }}

{{ Assets::js() }}
{{ Theme::asset()->scripts() }}

<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body class="{{ $currentRoute }}">

<div id="wrapper">

	{{ Theme::partial('theme.header') }}

	<div id="page-wrapper">
		<div class="page-header">
			<h1>{{ Theme::place('title') }}</h1>
		</div>
		{{ Theme::breadcrumb()->render() }}
		{{ Theme::partial('theme.msgs') }}
		{{ Theme::content() }}
	</div>

</div>

{{ Theme::partial('theme.modal') }}
{{ Theme::asset()->container('footer')->scripts() }}

</body>
</html>