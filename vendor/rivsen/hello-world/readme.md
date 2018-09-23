# Hello World Package for PHP Composer #

This is a hello world package for php composer beginners tutorial.

## Usage ##

```bash
$ composer require rivsen/hello-world dev-master
$ touch test.php
```

```php
<?php
require_once "vendor/autoload.php";

$hello = new Rivsen\Demo\Hello();
echo $hello->hello();
```

```bash
$ php test.php
```

It will print "Hello World!" then exit.
