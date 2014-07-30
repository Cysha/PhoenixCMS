<div id="site_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

@if( Auth::check() === false )
<div id="login" class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4>Existing Members Login</h4>
        </div>
        <div class="modal-body">
            @if (Session::has('login_errors'))
                <span class="error">Username or password incorrect.</span>
            @endif

            <div class="form">
                {{ Former::horizontal_open()->action('/login') }}   
                    <div class="form-group">
                        <label class="control-label col-md-3" for="username">Username</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="email">Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" id="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <div class="checkbox inline">
                                <label>
                                    <input type="checkbox" id="inlineCheckbox1" value="agree"> Remember Me
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
        </div>
        <div class="modal-footer">
            <p>Dont have account? {{ HTML::link('/register', 'Register', array('class' => '')) }} here.</p>
        </div>
    </div>
</div>
</div>
@endif
