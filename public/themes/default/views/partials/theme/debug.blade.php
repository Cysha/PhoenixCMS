@if( Session::has('_debug') && in_array(App::environment(), array('dev', 'local')) )
<hr />
<h4>Debug:</h4>
	@if( is_array(Session::get('_debug')) )
		@foreach( Session::get('_debug') as $debug )
			{{ $debug }}
		@endforeach
	@else
		{{ Session::get('_debug') }}
	@endif
@endif