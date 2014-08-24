onlinestore
===========

Online store demo

LAMP hosted basic bones of an online store built using Code Igniter and Bootcamp.

Installation
===========

1. Copy all files to a folder, point apache at it and start it up
2. Create a database called onlinestore, import all data from the onlinestore.sql file
3. Edit your database connection settings in /application/config/database.php
4. Open the site in a web browser.

Admin access is by navigating to http://siteurl/admin or http://siteurl/index.php/admin/

username: administrator
password: @dm1n15tr@t0r

These details are editable by altering the config at /application/config/basic_auth.php

The additional files from a bare bones codeigniter and bootcamp install are as follows:

/application/config/basic_auth.php
/application/config/online_store.php
/application/controllers/admin.php
/application/product.php
/application/libraries/basic_auth.php
/application/libraries/data_import.php
/application/libraries/template.php
/application/models/product_m.php
/application/models/category_m.php
/application/views/*

