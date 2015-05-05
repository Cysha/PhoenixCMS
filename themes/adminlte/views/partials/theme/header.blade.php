<header class="main-header">
    <a href="{{ URL::route('pxcms.admin.index') }}" class="logo">{{ Config::get('core::app.site-name') }}</a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            @if (!Auth::guest())

                {{ Theme::partial('theme.topbar-header') }}

            @endif
        </div>
    </nav>
</header>

@if(!Auth::guest() && Auth::user()->isAdmin())
<aside class="main-sidebar">
    <section class="sidebar">
        {{ Menu::handler('acp')->render() }}
    </section>
</aside>
@endif
