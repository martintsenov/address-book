Address Book App Prototype
==========================

Installation
------------
1. Clone github repo `git clone https://github.com/martintsenov/address-book.git`.
2. Download composer from https://getcomposer.org/download/ (Manual Download, composer.phar) 
   and then run `php composer.phar install`
3. Set up DB `php bin/console doctrine:schema:update --force`
4. Set Http server DocumentRoot to "<htdocs-folder-path>/address-book/web"
5. Run tests `cd <htdocs-folder-path>/address-book` and then `./vendor/bin/simple-phpunit --debug`
