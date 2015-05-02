<?php

return array(
    // theme info
    'name'    => 'adminlte',
    'author'  => 'Almsaeed Studio',
    'site'    => 'http://almsaeedstudio.com/AdminLTE/',
    'type'    => 'backend',
    'version' => '2.0',

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

        'asset' => function ($theme) {
            $theme->cook('datagrid', function ($theme) {
                $theme->add('tempojs', '/packages/cartalyst/data-grid/js/tempo.js', array('app.js'));
                $theme->add('datagridjs', '/packages/cartalyst/data-grid/js/data-grid.js', array('app.js', 'tempojs'));
            });

            Assets::add('admin');

            $theme->usePath()->add('base', 'css/style.min.css');
            $theme->usePath()->add('admin_lte.js', 'js/admin_lte.js');
            $theme->usePath()->add('application.js', 'js/app/application.js');
        },

        // add dropdown-menu classes and such for the bootstrap toggle
        'beforeRenderTheme' => function ($theme) {
            Menu::handler('acp')->addClass('sidebar-menu');

            Menu::handler('acp')
                ->getAllItemLists()
                ->map(function ($itemList) {
                    if ($itemList->getParent() !== null && $itemList->hasChildren()) {
                        $itemList->getParent()->addClass('treeview');
                        $itemList->addClass('treeview-menu');
                    }
                });

            // add dropdown class to the li if the set has children
            Menu::handler('acp')
                ->getItemsByContentType('Menu\Items\Contents\Link')
                ->map(function ($item) {
                    if ($item->hasChildren()) {
                        $item->getValue()->addClass('header');
                        $item->getValue()->setValue('<span>'.$item->getValue()->getValue().'</span> <i class="fa fa-angle-left pull-right"></i>');
                    }

                    if (strpos(Request::url(), $item->getValue()->getUrl()) !== false) {
                        $item->getParent()->addClass('active');
                    }
                });

            // set the nav up for the sidenav
            Menu::handler('acp.config_menu')->addClass('nav');
        }
    )
);
