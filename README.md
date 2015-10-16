#CakePHP Application

Simple blog with [CakePHP](http://cakephp.org) 3.x and  [bootstrap](http://getbootstrap.com/) 3

##Usage

###First of All

Clone this repo and run `composer update` to install dependencies of this project.

###Set up the Database

First, you should create database.
SQL script `config/schema/schema.sql` is prepared, so you can execute this by using the `source` command after running mysql.

After that, you should copy `app_local.default.php` to `app_local.php` and modify it like the following.

```bash
$ cp config/app_local.default.php config/app_local.php
```

```php
    'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            /**
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
             * the following line and set the port accordingly
             */
            //'port' => 'nonstandard_port_number',
            'username' => 'user',         // << your username!
            'password' => 'password',     // << your password!
            'database' => 'app_database', // << your database name!
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'log' => false,
```

###Checking your Installation

Start the development server by running the following command.

```
$ bin/cake server
```

After that, open up **http://localhost:8765/posts/** in your web browser, you'll see the posts screen.
If not, you may need to install additional PHP extensions, or set directory permissions.

##Trouble Shooting

###PHP extention intl is missing

If you get the following error, you should install `intl`.

```
Your requirements could not be resolved to an installable set of packages.

Problem 1
 - cakephp/cakephp 3.0.x-dev reqyures ext-intl * -> the requested PHP extention intl is missing from your system.
 ...

```

* Mac users
	* `$ sudo pecl install intl`

* Win users
	* uncomment the line `;extention=php_intl.dll` in `php.ini`

Check that your installation is complete by running the following command.

```bash
$ php -m | grep intl
intl
```

###Unable to detect ICU

```
checking for location of ICU headers and libraries... not found
configure: error: Unable to detect ICU prefix or ./bin/icu-config failed. Please verify ICU install prefix and make sure icu-config works.
```

Install ICU by [homebrew](http://brew.sh/)

```bash
$ brew install icu4c
$ brew link icu4c
```
