<?php
include('../config/constants.php');
//1. destory the session 
session_destroy();//unsets $_SESSION ['user']
//2.redirect to login page 
echo '<script type="text/javascript">
        location.replace("'.SITEURL.'admin/login.php"); </script>';

?>