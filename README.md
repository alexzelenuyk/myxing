# Installation
To install you'll need to use [Composer](http://getcomposer.org/):
```
git clone https://github.com/xing/test_php_alexzelenuyk
cd test_php_alexzelenuyk
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```
After you can visit [127.0.0.1:8888](http://127.0.0.1:8888).
You will see login page.
To make application running you need to specify:
 - Consumer key 
 - Consumer secret

Edit `PROJECT_ROOT/config/hybridauth.php` and fill fields `key` and `secret` with proper values.

