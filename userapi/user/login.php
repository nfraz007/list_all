<?php
require_once '../../include/config.php';

if(isset($_REQUEST["email"]) && $_REQUEST["email"]!=""){
  if(isset($_REQUEST["password"]) && $_REQUEST["password"]!="" && strlen($_REQUEST["password"])>=6){
    $email = filter_var($_REQUEST["email"], FILTER_SANITIZE_EMAIL);
    $password=md5($_REQUEST["password"]);

    $query="select * from `list_admin` where email='{$email}' and password='{$password}'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)==1){
      $row=mysqli_fetch_assoc($result);
      $_SESSION["admin_id"]=$row["admin_id"];
      $_SESSION["fname"]=$row["fname"];
      $_SESSION["lname"]=$row["lname"];
      $_SESSION["email"]=$row["email"];

      $output='{"status":"success", "remark":"Successfully login"}';
    }else{
      $output='{"status":"failure", "remark":"Email or password is wrong"}';
    }
  }else{
    $output='{"status":"failure", "remark":"Invalid or Incomplete password recieved"}';
  }
}else{
  $output='{"status":"failure", "remark":"Invalid or Incomplete email recieved"}';
}

echo $output;
mysqli_close($con);
?>