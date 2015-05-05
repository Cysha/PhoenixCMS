<div class="form">
{!! Former::horizontal_open()->action(route('pxcms.user.login')) !!}

    {!! Former::text('email', 'Username OR Email')->required() !!}
    {!! Former::password('password', 'Password')->required() !!}

    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
            <button type="submit" class="btn btn-success">Login</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
    </div>
{!! Form::token() , Former::close() !!}
</div>
