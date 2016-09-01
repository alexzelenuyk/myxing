# About
 This is a small application to display details about all contact of the specific account.
 Application uses [Xing API](https://dev.xing.com) and [OAuth](https://dev.xing.com/docs/authentication)
# Installation
To install you'll need to use [Composer](http://getcomposer.org/):
```
git clone https://github.com/alexzelenuyk/myxing
cd myxing
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```
After you can visit [127.0.0.1:8888](http://127.0.0.1:8888).
You will see login page.
To make application running you need to specify:
 - Consumer key 
 - Consumer secret

Edit `PROJECT_ROOT/config/hybridauth.php` and fill fields `key` and `secret` with proper values.
