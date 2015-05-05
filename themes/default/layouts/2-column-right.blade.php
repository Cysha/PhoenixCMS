@extends('theme.default::layouts.default')

@section('layout-content')

<section class="two-column-right">
    <main class="content">
        {!! Theme::breadcrumb()->render() !!}
        {!! Theme::partial('theme.msgs') !!}
        {!! Theme::partial('theme.heading') !!}
        {!! Theme::partial('theme.content') !!}
    </main>

    <aside class="sidebar sidebar-right">
        {!! Theme::partial('theme.sidebar-right') !!}
    </aside>
</section>


@stop
