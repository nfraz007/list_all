<?php
require_once '../../include/config.php';

admincheck();

if(!PRODUCTION){
    if(isset($_REQUEST["website_id"]) && $_REQUEST["website_id"]!=""){
        if(isset($_REQUEST["category_id"]) && $_REQUEST["category_id"]!=""){
            if(isset($_REQUEST["website_name"]) && $_REQUEST["website_name"]!=""){
                if(isset($_REQUEST["website_url"]) && $_REQUEST["website_url"]!=""){
                    $website_id=numOnly($_REQUEST["website_id"]);
                    $category_id=numOnly($_REQUEST["category_id"]);
                    $website_name=filter_var($_REQUEST["website_name"],FILTER_SANITIZE_STRING);
                    $url=$_REQUEST["website_url"];

                    $query="update `list_website` set `category_id`='{$category_id}', `website_name`='{$website_name}', `url`='{$url}' where `website_id`='{$website_id}'";
                    $result=mysqli_query($con,$query);
                    if($result){
                        $output='{"status":"success", "remark":"Successfully updated"}';
                    }else{
                        $output='{"status":"failure", "remark":"Something is wrong"}';
                    }
                }else{
                    $output='{"status":"failure", "remark":"Invalid or Incomplete website_url recieved"}';
                }
            }else{
              $output='{"status":"failure", "remark":"Invalid or Incomplete website_name recieved"}';
            }
        }else{
          $output='{"status":"failure", "remark":"Invalid or Incomplete category_id recieved"}';
        }
    }else{
        $output='{"status":"failure", "remark":"Invalid or Incomplete website_id recieved"}';
    }
}else{
    $output='{"status":"failure", "remark":"This feature is disabled."}';
}

echo $output;

mysqli_close($con);
?>