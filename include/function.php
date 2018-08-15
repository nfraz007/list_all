<?php

function  upload_file($myfile,$dir,$max_file_size=102400)
{
    $error=0;
    $obj=new stdClass();
    $file_name=rinse(time().$_FILES[$myfile]['name']);
    $file_name=str_replace(" ", "", $file_name);
    $file_add=$_FILES[$myfile]['tmp_name'];
    
    $file_size = $_FILES[$myfile]['size'];
    if ($_FILES[$myfile]['error'] !== UPLOAD_ERR_OK) 
    {
       $error=1;
       $message="File not uploaded properly.";
    }
    elseif (($file_size > $max_file_size))
    {      
        $message = 'File too large. File must be within '.($max_file_size/1024).' KB.'; 
        $error=1;
     }

     $info = getimagesize($_FILES[$myfile]['tmp_name']);
    if ($info === FALSE) 
    {
       $error=1;
       $message="Unable to determine image type of uploaded file";
    }

    if (($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) 
    {
       $error=1;
       $message="Only JPEG or PNG image allowed";
    }
    
    if($error==0)
    {
        if(move_uploaded_file($file_add,$dir."/".$file_name))
        {
            $message="file uploaded succesfuly";
        }
        else
        {
            $message = $_FILES[$myfile]['error'];
            $error=1;
                // $message=$dir;
        }
    }
    $obj->error=$error;
    $obj->message=$message;
    $obj->file_name=$file_name;

    return $obj;
  
}

function  upload_file_modified($myfile,$dir,$max_file_size=102400,$i)
{
    
    $error=0;
    $obj=new stdClass();
    $file_name=rinse(time().$_FILES[$myfile]['name'][$i]);
    $file_name=str_replace(" ", "", $file_name);
    $file_add=$_FILES[$myfile]['tmp_name'][$i];
    
    $file_size = $_FILES[$myfile]['size'][$i];
    if ($_FILES[$myfile]['error'][$i] !== UPLOAD_ERR_OK) 
    {
       $error=1;
       $message="File not uploaded properly.";
    }
    elseif (($file_size > $max_file_size))
    {      
        $message = 'File too large. File must be within '.($max_file_size/1024).' KB.'; 
        $error=1;
     }

    $info = getimagesize($_FILES[$myfile]['tmp_name'][$i]);
    $mime   = $info['mime'];
  
    if ($info === FALSE) 
    {
       $error=1;
       $message="Unable to determine image type of uploaded file";
    }
    
    if (($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) 
    {
       $error=1;
       $message="Only JPEG or PNG image allowed";
    }
    
    if($error==0)
    {
        if(move_uploaded_file($file_add,$dir."/".$file_name))
        {
            $message="file uploaded succesfuly";
        }
        else
        {
            $message = $_FILES[$myfile]['error'];
            $error=1;
                // $message=$dir;
        }
    }
    $obj->error=$error;
    $obj->message=$message;
    $obj->file_name=$file_name;

    return $obj;
  
}


function deleteImage($path)
{
    global $hostname;
    $new_path=str_replace($hostname, "", $path);
    if(strlen($new_path)!=0)
    {
        return unlink("../../".$new_path);
        // return "inside";
    }
    return "0";
}
        
function redirect_to( $location = NULL ) {
    if ($location != NULL) {
      header("Location: {$location}");
      exit;
    }
}

function clean($input)
 {
  return preg_replace('/[^A-Za-z0-9 ]/', '', $input); // Removes special chars.
 }
function rinse($input)
{
    return preg_replace('/[^A-Za-z0-9\-,@.\ ]/', '', $input); // Removes special chars.
}

 function numOnly($input)
 {
  return preg_replace('/[^0-9]/', '', $input); // Removes special chars.
 }

function securityToken(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring.=$characters[rand(0, strlen($characters))];
        }
        return $randstring;
}

function logincheck()
{
    global $con;

    if(isset($_SESSION["user_id"]))
    {
        $output='{"status":"success"}';
    }
    elseif(isset($_REQUEST["user_id"]) && isset($_REQUEST["security_token"]))
    {    
        $query="select `security_token` from `wryton_user` where `id`='".$_REQUEST["user_id"]."'";
        $result=mysqli_query($con,$query);
        $row=mysqli_fetch_array($result);
        if($row["security_token"]==$_REQUEST["security_token"]){
            $output='{"status":"success"}';
        }
        else
            $output='{"status":"failure","remark":"Incorrect Security token. User id entered is '.$_REQUEST["user_id"].' and security token entere is '.$_REQUEST["security_token"].'"}';
    }
    else
    {
        $output='{"status":"failure","remark":"You are not login, Please login"}';
    }

    $obj=json_decode($output,true);

    if($obj['status']!="success")
        die($output);
}

function admincheck()
{
    if(!isset($_SESSION["admin_id"])){
        die('{"status":"failure", "remark":"You are not authorized for this request"}');
    }
}

function userLoginCheck()
{
    $data=logincheck();
    $arr=json_decode($data);
    if($arr->status!="success"){
        header("Location: index.php");
        die();
    }
}

function getIPAddress()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }else{
        $ip = $remote;
    }
    return $ip;
}

function pagination($query,$limit){
    global $con;
    $limit=(int)$limit;
    $row_count=mysqli_num_rows(mysqli_query($con,$query));
    return ceil($row_count/$limit);
}

function categoryList($obj){
    global $con;
    $category=array();

    $query="select * from `list_category` where ";

    if(isset($obj->category_id) && $obj->category_id!=""){
        $query.= "`category_id` = ".$obj->category_id." and ";
    }

    if(isset($obj->parent_id) && $obj->parent_id!=""){
        $query.= "`parent_id` = ".$obj->parent_id." and ";
    }
     
    if(isset($obj->search)  && $obj->search!=""){
        $search = clean($obj->search);
        $query.="( `category_name` like '%".$search."%' ) and ";
    }

    $query.="1 order by `category_name` asc ";

    if(isset($obj->limit) && $obj->limit!=0){
        $limit=$obj->limit;
    }else{
        $limit=10;
    }

    if(isset($obj->page) && $obj->page!=0){
        $page=$obj->page;
    }else{
        $page=1;
    }

    $query.=" limit {$limit} offset ".(($page-1)*$limit);

    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
        $output='{"status":"success", "category":';
        while($row=mysqli_fetch_assoc($result)){
            $category[]=$row;
        }
        $output.=json_encode($category).'}';
    }else{
        $output='{"status":"failure", "remark":"No Category Return"}';
    }
    return $output;
}

function websiteList($obj){
    global $con;
    $website=array();

    $query="select * from `list_website` where ";

    if(isset($obj->category_id) && $obj->category_id!=""){
        $query.= "`category_id` = ".$obj->category_id." and ";
    }

    if(isset($obj->website_id) && $obj->website_id!=""){
        $query.= "`website_id` = ".$obj->website_id." and ";
    }
     
    if(isset($obj->search)  && $obj->search!=""){
        $search = clean($obj->search);
        $query.="( `website_name` like '%".$search."%' ) and ";
    }

    $query.="1 order by `website_name` asc ";

    if(isset($obj->limit) && $obj->limit!=0){
        $limit=$obj->limit;
    }else{
        $limit=10;
    }

    if(isset($obj->page) && $obj->page!=0){
        $page=$obj->page;
    }else{
        $page=1;
    }

    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
        $output='{"status":"success", "website":';
        while($row=mysqli_fetch_assoc($result)){
            $website[]=$row;
        }
        $output.=json_encode($website).'}';
    }else{
        $output='{"status":"failure", "remark":"No Website Return"}';
    }
    return $output;
}

function breadList($category_id=0){
    global $con;
    $bread=array();

    do{
        $query="select * from `list_category` where `category_id`='{$category_id}'";
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)==1){
            $row=mysqli_fetch_assoc($result);
            $bread[]=$row;
            $category_id=(int)$row["parent_id"];
        }else break;
    }while($category_id!=0);

    if(sizeof($bread)>0){
        $output='{"status":"success", "bread":'.json_encode($bread).'}';
    }else{
        //no category id available
        $output='{"status":"failure", "remark":"No Category Found"}';
    }
    return $output;
}

function categoryDelete($category_id){
    global $con;

    $query="delete from `list_website` where `category_id`='{$category_id}'";
    $result=mysqli_query($con,$query);
    
    $query="delete from `list_category` where `category_id`='{$category_id}'";
    $result=mysqli_query($con,$query);

    $query="select * from `list_category` where `parent_id`='{$category_id}'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $category_id=$row["category_id"];
            categoryDelete($category_id);
        }
    }
}

?>