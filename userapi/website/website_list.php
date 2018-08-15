<?php
require_once '../../include/config.php';

$obj=(object)$_REQUEST;
$obj->limit=100;
$output=websiteList($obj);

echo $output;

mysqli_close($con);
?>