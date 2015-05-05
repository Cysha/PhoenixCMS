<div class="form">
{!! Former::horizontal_open()->action( URL::route('pxcms.user.register') ) !!}
    {!! Former::text('username')->required() !!}
    {!! Former::email('email')->required() !!}
    {!! Former::password('password')->required() !!}
    {!! Former::password('password_confirmation')->label('Confirm Password')->required() !!}

    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
        {!! Former::framework('Nude') !!}
        <label for="tnc">{!! Former::checkbox('tnc')->required()->label(false) !!} I agree to the terms and conditions</label>
        {!! Former::framework('TwitterBootstrap3') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
            <button type="submit" class="btn btn-default btn-primary">Register</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
    </div>

{!! Form::token() , Former::close() !!}
</div>
