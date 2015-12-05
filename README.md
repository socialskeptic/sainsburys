# sainsburys

[Project Installation]
1) Create a new virtual host and point the document root to sainsburys/src/public inside this project
2) Open Terminal and change directory to /workspace/sainsburys/src
3) run the following commands

rm -rf composer.lock
rm -rf fuel/vendor
php composer.phar install

4) View the website at your selected virtual host eg http://www.example.com

[Unit Testing]
1) This uses phpunit for unit testing from a global scope. You will need phpunit installed to your machine globally for this to work.
2) For Unit tests you must update the $hostname variable at the top of sainsburys/test/Base.php to your virtual hostname. eg http://www.example.com/
3) Open terminal and change director to the base folder /sainsburys and run this command below

phpunit --colors


[Project Custom Files]
All of the project files are stored in these folders below:

sainsburys/src/fuel/app/classes/controller/
sainsburys/src/fuel/library/
sainsburys/test

