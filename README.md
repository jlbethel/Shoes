#To Do Exercise
#####Shoes App

####By Jason Bethel

##Description

An app that allows users to add stylists to a database via a webpage. There are options to add clients to individual stylists, as well as delete the stylists and the clients.

##Setup

1. Clone repository from GitHub.

2. Run $ composer install in top level of project folder.

3. in a new terminal tab. enter ```mysql.server start```.

4. Then enter ```mysql -uroot -proot``` (you now have MySql running)

5. Start an apache server (another new tab in terminal) with ```apachectl start```

6. Open your browser to ```localhost:8888/phpmyadmin```

7. Import the the database files to the top level of your project folder using phpMyadmin. Do this by clicking the import tab in phpMyadmin and choosing one of the files and clicking "GO". Repeat this step for the other file

8. Start another terminal tab. Open a php server ```php -S localhost:8000```. This is so you can view your twig sites.

9. Enjoy

10. If interested here are the commands I used in the MySql terminal:
    "MySQL
    CREATE DATABASE shoes;
    USE shoes;
    CREATE TABLE stores (id serial PRIMARY KEY, store_name varchar (255));

    phpMyAdmin
    I used phpmyadmin to create the test database instead of the terminal:
    select shoes
    click opperations on the right section of the browser
    under "Copy database to:" type "shoes_test"
    click Structure only
    click go

    Back to MySQL
    CREATE TABLE brands (id serial PRIMARY KEY, brand_name varchar (255));
    DROP DATABASE shoes_test;

    phpMyAdmin
    re-create the test database using phyadmin by following the steps above

    MySQL
    Time to make the join table. Type CREATE TABLE brands_stores (id serial PRIMARY KEY, store_id int, brand_id int);
    DROP DATABASE shoes_test;

    phpMyAdmin
    re-create the test database using phyadmin by following the steps above


##Technologies Used

PHP, html, css, silex, MySQL, phpMyadmin

###Legal

Copyright (c) 2015 {Jason Bethel}

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
