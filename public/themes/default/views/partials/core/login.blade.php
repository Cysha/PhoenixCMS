<div class="form">
{{ Former::horizontal_open()->action( URL::route('user.login') ) }}   
    <div class="form-group">
        <label class="control-label col-md-3" for="username">Username</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="username" name="username">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3" for="email">Password</label>
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