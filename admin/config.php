<?php
    $hostname = "http://localhost/PHP_IMPORTANT_PROJECTS/news-site";
    /**DATABASE DETAILES*/
    /**---------------- */
    $DB_HOST = "localhost";
    $DB_USERNAME = "root";
    $DB_PASSWORD = "";
    $DB_DATABASE = "news-site";

    // MYSQLI_CONNECT() : function is used to connect with the database...
    // die() : this function work when there is any issue while connecting with database
    // MYSQLI_CONNECT_ERROR() : show error if there is any issue while connecting with database..
    $con = mysqli_connect($DB_HOST,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE)
    or die("there is an issue while connecting with database".mysqli_connect_error());  
?>