<?php


// Check if DB_SERVER is already defined before defining it
if (!defined('DB_SERVER')) {
    define('DB_SERVER', 'localhost');
}

$servername = 'localhost';  // You can keep this variable as needed
$username   = 'root';
$password   = '';
$dbname     = 'Db_Login';

/* Attempt to connect to MySQL database */
$link = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$gmailid = ''; // YOUR gmail email
$gmailpassword = ''; // YOUR gmail App password
$gmailusername = ''; // YOUR gmail Username
