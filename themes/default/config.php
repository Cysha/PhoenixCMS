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

            if (($analyticsCode = Config::get('core::app.google-analytics', null)) !== null) {
                $theme->asset()->container('footer')->writeScript('google-analytics', '
                    (function (i,s,o,g,r,a,m) {i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function () {
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                    })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

                    ga(\'create\', \''.$analyticsCode.'\', \'auto\');
                    ga(\'send\', \'pageview\');
                ', ['dependencies.js']);
            }
        },

        'asset' => function ($theme) {
        }
    )
);
