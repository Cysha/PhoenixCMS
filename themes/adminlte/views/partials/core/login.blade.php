<div class="login-box">
    <div class="login-logo">
        <a href="{{ URL::route('pxcms.admin.index') }}">{{ Config::get('core::app.site-name') }}</a>
    </div>
    <div class="login-box-body">
        {{ Former::horizontal_open()->action(URL::route('pxcms.admin.login')) }}
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Email" name="email" />
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">&nbsp;</div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        {{ Form::token() , Former::close() }}
    </div>
</div>
