<?php
    session_start();
    require_once __DIR__."/../my_config.php";

    $server   = HOSTNAME;
    $username = USERNAME;
    $password = PASSWORD;
    $database = DATABASE;
       
    date_default_timezone_set('Asia/Kolkata');
    $con=mysqli_connect($server,$username,$password,$database) or die ("could not connect to mysql");

    $DATETIME_FORMAT="j M Y";

    $HOSTNAME = BASE_URL;
    $NAME="ListAll";

    $IMAGE="assets/image/";
    $ICON="assets/image/icon/";

    require_once 'function.php';
?>