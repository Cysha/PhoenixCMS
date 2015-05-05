@extends('theme.default::layouts.default')

@section('layout-content')
    <section class="one-column">
        <main class="content">
            {!! Theme::breadcrumb()->render() !!}
            {!! Theme::partial('theme.msgs') !!}
            {!! Theme::partial('theme.heading') !!}
            {!! Theme::partial('theme.content') !!}
        </main>
    </section>
@stop
