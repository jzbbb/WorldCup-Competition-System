<?php
DEFINE ('DB_USER','worldcup');
DEFINE ('DB_PASSWORD','123456');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','worldcup');

$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(!$dbc){
    die('Could not to connect to Mysql:'.mysqli_connect_error());
}

mysqli_set_charset($dbc, 'utf8');
?>