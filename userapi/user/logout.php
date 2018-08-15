<?php
session_start();
unset($_SESSION['admin_id']);
unset($_SESSION['fname']);
unset($_SESSION['lname']);
unset($_SESSION['email']);
session_destroy();

$output='{"status":"success", "remark":"Successfully Logout"}';
echo $output;
?>