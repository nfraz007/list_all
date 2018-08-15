<?php
require_once '../../include/config.php';

admincheck();

if(!PRODUCTION){
    if(isset($_REQUEST["category_id"]) && $_REQUEST["category_id"]!=""){
        if(isset($_REQUEST["parent_id"]) && $_REQUEST["parent_id"]!=""){
            if(isset($_REQUEST["category_name"]) && $_REQUEST["category_name"]!=""){
                $category_id=numOnly($_REQUEST["category_id"]);
                $parent_id=numOnly($_REQUEST["parent_id"]);
                $category_name=filter_var($_REQUEST["category_name"],FILTER_SANITIZE_STRING);

                $query="update `list_category` set `parent_id`='{$parent_id}', `category_name`='{$category_name}' where `category_id`='{$category_id}'";
                $result=mysqli_query($con,$query);
                if($result){
                    $output='{"status":"success", "remark":"Successfully updated"}';
                }else{
                    $output='{"status":"failure", "remark":"Something is wrong"}';
                }
            }else{
              $output='{"status":"failure", "remark":"Invalid or Incomplete category_name recieved"}';
            }
        }else{
          $output='{"status":"failure", "remark":"Invalid or Incomplete parent_id recieved"}';
        }
    }else{
        $output='{"status":"failure", "remark":"Invalid or Incomplete category_id recieved"}';
    }
}else{
    $output='{"status":"failure", "remark":"This feature is disabled."}';
}

echo $output;

mysqli_close($con);
?>