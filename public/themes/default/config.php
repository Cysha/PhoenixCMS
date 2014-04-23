<?php

return array(
    // theme info
    'name'    => 'default',
    'author'  => 'Dan Aldridge',
    'site'    => 'http://cysha.co.uk',
    'type'    => 'frontend',
    'version' => '1.0',

    // theme options
    'inherit' => null, //default

    'events' => array(

        'before' => function ($theme) {
            // You can remove this line anytime.
            $theme->setTitle('Default Theme');

            // Breadcrumb template.
            $theme->breadcrumb()->setTemplate('
                <ol class="breadcrumb">
                @foreach ($crumbs as $i => $crumb)
                    @if ($i != (count($crumbs) - 1))
                    <li><a href="{{ $crumb["url"] }}">{{ $crumb["label"] }}</a></li>
                    @else
                    <li class="active">{{ $crumb["label"] }}</li>
                    @endif
                @endforeach
                </ol>
            ');

        },

        'beforeRenderTheme' => function ($theme) {
            // You may use this event to set up your assets.
            $theme->asset()->add('bootstrap',                   'assets/css/bootstrap.css');
            $theme->asset()->add('font-awesome',                'assets/css/font-awesome.css');
            $theme->asset()->usePath()->add('base',             'css/styles.css', array('bootstrap'));
        },

        'beforeRenderLayout' => array(
            'default' => function ($theme) {
                $theme->asset()->add('js',                      'assets/js.js');
                $theme->asset()->usePath()->add('app.js',       'js/app/application.js', array('js'));
                $theme->asset()->usePath()->add('modernizr',    'js/modernizr.js');
            }
        )
    )
);
