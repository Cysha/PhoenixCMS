<div class="form">
{{ Former::horizontal_open()->action( URL::route('pxcms.user.login') ) }}
    <div class="form-group">
        <?php $login_field = \Config::get('sentry::users.login_attribute', 'email'); ?>
        <label class="control-label col-md-3" for="{{ $login_field }}">{{ $login_field }}</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="{{ $login_field }}" name="{{ $login_field }}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3" for="password">Password</label>
        <div class="col-md-9">
            <input type="password" class="form-control" id="password" name="password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
            <div class="checkbox inline">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
            <button type="submit" class="btn btn-success">Login</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
    </div>
{{ Form::token() , Former::close() }}
</div>
