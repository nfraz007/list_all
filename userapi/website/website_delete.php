<?php
require_once '../../include/config.php';

admincheck();

if(!PRODUCTION){
	if(isset($_REQUEST["website_id"]) && $_REQUEST["website_id"]!=""){
		$website_id=numOnly($_REQUEST["website_id"]);

	    $query="delete from `list_website` where `website_id`='{$website_id}'";
	    $result=mysqli_query($con,$query);
	    if($result){
	    	$output='{"status":"success", "remark":"Successfully deleted"}';
	    }else{
	    	$output='{"status":"failure", "remark":"Something is wrong"}';
	    }
	}else{
	    $output='{"status":"failure", "remark":"Invalid or Incomplete data recieved"}';
	}
}else{
    $output='{"status":"failure", "remark":"This feature is disabled."}';
}

echo $output;

mysqli_close($con);
?>