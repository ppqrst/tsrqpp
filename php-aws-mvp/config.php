<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'mydbinstance1.cad1nrmabwki.ap-southeast-2.rds.amazonaws.com');
define('DB_USERNAME', 'thanhtrv');
define('DB_PASSWORD', 'tetmap301905');
define('DB_NAME', 'mvp');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
