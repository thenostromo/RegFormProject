Project was created with:<br/>
PHP7.1, MySQL, Twig, Composer, Bulma, VueJS
<br/>
<br/>
Created by TheNostromo.
<br/>
<br/>
GitHub: <a href="https://github.com/thenostromo/RegFormProject">https://github.com/thenostromo/RegFormProject</a><br/>
Demo: <a href="http://136.243.142.144:8005/">http://136.243.142.144:8005/</a>

Steps for deploy:
1. composer install
2. npm install
3. make all requests to index.php
4. change credentials of connection to database in file config/.env
5. export database.sql from folder "db_dump" to your database

For test you can run command:
./vendor/bin/phpunit tests --bootstrap vendor/autoload.php