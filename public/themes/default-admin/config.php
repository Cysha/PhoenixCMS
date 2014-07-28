<?php

return array(
    // theme info
    'name'    => 'default-admin',
    'author'  => 'Dan Aldridge',
    'site'    => 'http://cysha.co.uk',
    'type'    => 'backend',
    'version' => '1.0',

    // theme options
    'inherit' => 'default', //default

    'events' => array(
        'before' => function ($theme) {
            $theme->setTitle( Config::get('app.site-name').' Admin Panel');

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

        'asset' => function ($asset) {
            $asset->cook('datagrid', function ($asset) {
                $asset->add('tempojs', '/packages/cartalyst/data-grid/js/tempo.js', array('app.js'));
                $asset->add('datagridjs', '/packages/cartalyst/data-grid/js/data-grid.js', array('app.js', 'tempojs'));
            });
        },

        'beforeRenderTheme' => function ($theme) {
            $theme->asset()->usePath()->add('base', 'css/sb-admin.css', array('bs3.css', 'jasny-bs3.css'));

            // add dropdown-menu classes and such for the bootstrap toggle
            Menu::handler('acp')->addClass('nav')->id('side-menu');

            Menu::handler('acp')
                ->getAllItemLists()
                ->map(function ($itemList) {
                    if( $itemList->getParent() !== null && $itemList->hasChildren() ) {
                        $itemList->addClass('nav nav-second-level');
                    }
                });

            // add dropdown class to the li if the set has children
            Menu::handler('acp')
                ->getItemsByContentType('Menu\Items\Contents\Link')
                ->map(function ($item) {
                    if( $item->hasChildren() ) {
                        $item->getValue()->addClass('text-center title');
                        //$item->getValue()->setValue($item->getValue()->getValue().' <span class="fa arrow"></span>');
                    }

                    // if( $item->getElement() == 'li' ){
                    //     if( $item->getValue()->getValue() === '__DIVIDER__' ){
                    //         $item->getValue()->setValue('<hr/>');
                    //         $item->addClass('divider');
                    //     }
                    // }
                });

            // set the nav up for the sidenav
            Menu::handler('acp.config_menu')->addClass('nav');
        },

        'beforeRenderLayout' => array(
            'default' => function ($theme) {
                Assets::add('admin');
                //$theme->asset()->usePath()->add('metisMenu.js', 'js/jquery.metisMenu.js');
                $theme->asset()->usePath()->add('sb-admin.js', 'js/sb-admin.js');
                $theme->asset()->usePath()->add('app.js', 'js/app/application.js', array('bs3.js', 'jasny-bs3.js'));
                $theme->asset()->usePath()->add('modernizr', 'js/modernizr.js');
            }
        )
    )
);
