<?php
require_once '../../include/config.php';

$obj=(object)$_REQUEST;
$obj->limit=100;
$output=categoryList($obj);

echo $output;

mysqli_close($con);
?>