<div class="row">
    <div class="col-md-{{ $col_one or '2'}}"> @include('core::config.admin.nav') </div>
    <div class="col-md-{{ $col_two or '7'}}">
        <div class="box box-solid box-primary">
            <div class="box-body">
                <div class="clearfix">@yield('admin-config')</div>
            </div>
        </div>
    </div>
</div>
