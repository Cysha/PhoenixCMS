# Phoenix CMS

[Phoenix CMS](http://phoenixcms.org/) (PXCMS) is a powerful open source, modular content management system.

## Requirements

* PHP 5.4+
* MySQL 4+ (no support for other DBMS at this time)
* Apache Rewrite Module *`Enabled`*

## Installation

*1.*
Clone this project into a directory
```bash
$ git clone https://github.com/Cysha/PhoenixCMS.git pxcms
```

*2.*
Run a composer install from the root of the project:
```bash
$ composer.phar install
```
Providing composer didn't throw any errors, that should be all the dependancies installed.

*3.*
(optional) Next thing to do is configure the environment,

* find your apache vhost that you wish to use,
* ensure the directory root is path/to/project/**public**
* and that ```SetEnv LARAVEL_ENV production``` is set in the vhost.

If you do not set that variable, it will default to local.

*4.*
Then duplicate the base config folder, and call it the same thing you set the LARAVEL_ENV to.
Run the following from the root of the project
```bash
$ cp -r app/config/base/ app/config/production
$ vim app/config/production/database.php
```
and populate the array with your database details

*5.*
Last thing to do then is run the installer from the root of the project, and follow the prompts
```bash
$ php artisan cms:install
```

## Dependencies (included in this project)

### CSS
### Javascript
### PHP


## Versioning

Releases will be numbered with the follow format:

`<major>.<minor>.<patch>`

And constructed with the following guidelines:

- Breaking backwards compatibility bumps the major
- New additions without breaking backwards compatibility bumps the minor
- Bug fixes and misc changes bump the patch

## Documentation

Documentation when available will show up on the website.

## Extensions, Themes, and Plugins

The CMS is fully customizable from themes and modules to language packs, documentation on how to create these will be posted on the website in due course.

## Support

The CMS has basic support for IE6 & 7, and should be *FULLY* supported from IE8+, Chrome, Firefox2+ and Opera.
There has been no tests done on smart phones yet, but if you have any issues please post specifics.

## Awesome People

Thanks to the people that have contributed and helped test/find bugs in the project:

- [Daniel Aldridge](https://github.com/xLink)
- [Daniel Noel-Davies](https://github.com/NoelDavies)
- [Richard Clifford](https://github.com/DarkMantisCS)
- [John Maguire](https://github.com/johnmaguire2013)
- [Infy](https://github.com/infyhr)

## License

Copyright (c) 2013 Cysha

PXCMS is licensed under the [<LICENCE>](#).
