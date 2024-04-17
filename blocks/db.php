<?php
R::setup('mysql:host=mysql;port=3306;dbname=teststogo-db', 'root', 'root');

if (!R::testConnection()) echo "Can't connect to DB...";
?>