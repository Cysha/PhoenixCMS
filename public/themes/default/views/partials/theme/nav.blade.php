    <li><a href="{{ URL::route('pxcms.pages.home') }}"><i class="fa fa-home"></i></a></li>

    @if(Auth::guest())
    <?php $loginORRegister = in_array(Request::url(), [URL::route('pxcms.user.login'), URL::route('pxcms.user.register')]); ?>
    <li><a href="{{ $loginORRegister != false ? URL::route('pxcms.user.login') : '#login' }}"{{ ($loginORRegister==false ? ' role="button" data-toggle="modal"' : '') }}>Login</a></li>
    <li><a href="{{ $loginORRegister != false ? URL::route('pxcms.user.register') : '#register' }}"{{ ($loginORRegister==false ? ' role="button" data-toggle="modal"' : '') }}>Register</a></li>
    @else
    <li><a href="{{ URL::route('pxcms.user.logout') }}">{{{ 'Logout ['.Auth::user()->username.']' }}}</a></li>
    @endif
