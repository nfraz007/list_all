<?php
require_once '../../include/config.php';

admincheck();

if(!PRODUCTION){
	if(isset($_REQUEST["category_id"]) && $_REQUEST["category_id"]!=""){
		$category_id=numOnly($_REQUEST["category_id"]);

	    categoryDelete($category_id);
	    $output='{"status":"success", "remark":"Successfully deleted"}';
	}else{
	    $output='{"status":"failure", "remark":"Invalid or Incomplete data recieved"}';
	}
}else{
    $output='{"status":"failure", "remark":"This feature is disabled."}';
}

echo $output;

mysqli_close($con);
?>