<?php

use BeatSwitch\Lock\Lock;
use BeatSwitch\Lock\Manager;

return [

    /*
    |--------------------------------------------------------------------------
    | Driver
    |--------------------------------------------------------------------------
    |
    | Choose your preferred driver. When choosing the static array driver,
    | you can set permissions for callers and roles in the configuration
    | callback below. The persistent database driver will store permissions to
    | a database table using the default database connection.
    |
    | Available drivers: array, database
    |
    */

    'driver' => \Cms\Modules\Auth\Models\CustomLockDriver::class,

    /*
    |--------------------------------------------------------------------------
    | User Caller Type
    |--------------------------------------------------------------------------
    |
    | This is the caller type for your user caller. We need to set this here
    | because if no user is authed, a SimpleCaller object will be created with
    | the "guest" role.
    |
    */

    'user_caller_type' => 'auth_user',

    /*
    |--------------------------------------------------------------------------
    | Array Driver Configuration
    |--------------------------------------------------------------------------
    |
    | If you've selected the array driver than you can add permission
    | configuration for your roles and authed user below. The first argument in
    | the callback is the lock manager instance, the second one is your authed
    | user. If no user is authed, we'll bootstrap a SimpleCaller object which
    | has the "guest" role.
    |
    | Note that these permissions are only configured for the array driver!
    |
    */

    'permissions' => function (Manager $manager) {

    },

    /*
    |--------------------------------------------------------------------------
    | Database Driver Table
    |--------------------------------------------------------------------------
    |
    | If you've chosen the persistent database driver, you can choose here to
    | which table the permissions should be stored to.
    |
    */

    'table' => 'auth_permissions',

];
