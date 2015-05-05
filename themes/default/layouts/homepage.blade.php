@extends('layouts.default')

@section('layout-content')
    {!! Theme::partial('theme.msgs') !!}
    {!! Theme::partial('theme.heading') !!}
    <section class="homepage">
        <main class="content">
            {!! Theme::partial('theme.content') !!}
        </main>
    </section>
@stop
