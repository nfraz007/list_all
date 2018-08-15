<?php
require_once '../../include/config.php';

$category_id=$_REQUEST["category_id"];

if(isset($category_id) && $category_id!=""){
	$output=breadList($category_id);
}else{
	$output='{"status":"failure", "remark":"Invalid or Incomplete data recieved"}';
}

echo $output;

mysqli_close($con);
?>