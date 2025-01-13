<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
$servername = 'localhost';
$username   = 'root';
$password   = '';
$dbname     = 'Db_Login';

/* Attempt to connect to MySQL database */
$link = mysqli_connect($servername, $username,$password,$dbname);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$gmailid = ''; // YOUR gmail email
$gmailpassword = ''; // YOUR gmail App password
$gmailusername = ''; // YOUR gmail Username

?>