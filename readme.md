# Phoenix CMS
[![](http://slack.phoenixcms.org/badge.svg)](http://slack.phoenixcms.org)

[Phoenix CMS](http://phoenixcms.org/) (PXCMS) is a powerful open source, modular content management system.

## Requirements
* Laravel 5.3 (For L4.2 checkout the [v0.1](https://github.com/Cysha/PhoenixCMS/releases/tag/v0.1) tag)
* PHP 5.6.4+
* MySQL 4+ (no official support for other DBMS at this time)
* Apache Rewrite Module *`Enabled`*
* Mcrypt PHP Extension
* OpenSSL PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension

## Installation

*1.*
Clone this project into a directory
```bash
git clone https://github.com/Cysha/PhoenixCMS.git pxcms
```

*2.*
Run a composer install from the root of the project:
```bash
composer.phar install
```

*3.*
Assuming you have NPM installed, run the installer from the root of the project:
```bash
npm install
```

*4.*
Run the bower installer from the root of the project:
```bash
npm install -g bower # run this if you dont have bower installed
bower install
```

Providing none of the above threw any errors, that should be all the dependancies installed.

*5.*
(optional) Next thing to do is configure the environment,

* find your apache vhost that you wish to use,
* ensure the directory root is path/to/project/**public**
* and that your parameters in your path/to/project/*.env* file are set are set.


*6.*
Last thing to do then is run the installer from the root of the project, and follow the prompts
```bash
php artisan cms:install
```

*Note:* If XDebug is enabled you must increase the max_nesting_level in your php.ini like so:
```
xdebug.max_nesting_level = 200
```

## Versioning
Releases will be numbered with the follow format: `<major>.<minor>.<patch>` And constructed with the following guidelines:
- Breaking backwards compatibility bumps the major
- New additions without breaking backwards compatibility bumps the minor
- Bug fixes and misc changes bump the patch

## Documentation
.. coming soon ..

## Modules, Themes, and Plugins
The CMS is fully customizable from themes and modules to language packs, documentation on how to create these will be posted on the website in due course.

## Support
If you encounter problems with using the CMS, keeping in mind that it isn't a full release yet, please post on an issue on the repository.
Module specific issues would be better posted to the correct module to keep tracking easier. Pull requests are welcome.

## Awesome People
Thanks to the people that have contributed and helped test/find bugs in the project:
- [Daniel Aldridge](https://github.com/xLink)
- [Daniel Noel-Davies](https://github.com/NoelDavies)
- [Richard Clifford](https://github.com/richard-clifford)
- [John Maguire](https://github.com/johnmaguire2013)
- [Infy](https://github.com/infyhr)
- [Daniel Selley](https://github.com/danselley)

## License Copyright (c) 2013 Cysha
PXCMS is licensed under the [MIT LICENSE](http://opensource.org/licenses/MIT).

