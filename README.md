# Sainsburys Web Page Consume Test

## Application Framework
This application has been built using the FuelPHP HMVC Framework.

## Composer Dependencies
This Project uses the following Composer Dependencies which are set inside the composer.json file

* "curl/curl": "^1.2",
* "asymptix/php-html-dom-parser": "1.5.*",
* "pimple/pimple": "~3.0",
* "phpunit/phpunit": "^5.1"

## Project Installation
1. Create a new virtual host and point the document root to sainsburys/src/public inside this project
2. Open Terminal and change directory to /workspace/sainsburys/src
3. run the following commands

* rm -rf composer.lock
* rm -rf fuel/vendor
* php composer.phar install

You can now view the newly installed application at your selected

virtual host address eg http://www.example.com via any browser

## Unit Testing
1. For Unit tests you must update the $hostname variable at the top of sainsburys/test/Base.php
to your virtual hostname. eg http://www.example.com/
2. Open terminal and change directory to the base folder /sainsburys and run the required command below:

### If you have phpunit installed globally you can run:

phpunit --colors

### otherwise you can use the composer installed phpunit by typing:

src/fuel/vendor/bin/phpunit --colors

## Project Custom Files
All of the project files are stored in these folders below:

* sainsburys/src/fuel/app/classes/controller/
* sainsburys/src/fuel/library/
* sainsburys/test/

