            @if ($message = Session::get('success'))
                <div class="alert alert-success"><strong>Success:</strong> {{ $message }} </div>
            @endif

            <?php
                if (Session::has('error') && count(Session::get('error'))) {
                    $error = Session::get('error');
                    //echo \Debug::dump($error, '');
                    if (is_array($error)) {
                        // foreach( $error as $field => $e ){
                        //     echo '<div class="alert alert-danger"><strong>Warning:</strong> '.( is_array($e) ? implode('<br /><strong>Warning:</strong> ', $e) : $e ).'</div>';
                        // }
                    } else {
                        echo '<div class="alert alert-danger"><strong>Warning:</strong> '. Session::get('error') .'</div>';
                    }
                }
            ?>


            @if ($message = Session::get('warning'))
                <div class="alert alert-warning"><strong>Warning:</strong> {{ $message }} </div>
            @endif


            @if ($message = Session::get('info'))
                <div class="alert alert-info"><strong>Info:</strong> {{ $message }} </div>
            @endif
