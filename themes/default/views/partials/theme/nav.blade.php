    <li><a href="{{ URL::route('pxcms.pages.home') }}"><i class="fa fa-home"></i></a></li>

    @if(Auth::guest())
    <li><a href="{{ URL::route('pxcms.user.login') }}">Login</a></li>
    <li><a href="{{ URL::route('pxcms.user.register') }}">Register</a></li>
    @else
    <li><a href="{{ URL::route('pxcms.user.logout') }}">{{ 'Logout ['.Auth::user()->username.']' }}</a></li>
    @endif
