<?php

include('../config/constants.php');
// 1. get the id of admin to be deleted 

$id=$_GET['id'];
//2. create sql query to delet admin 
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//execute the query 
$res = mysqli_query($conn,$sql);
  //check whether the query executed successfully or not
  if($res==TRUE)
  {
    //query executed successfullu and admin deleted
   // echo "admin deleted";
   //create session variable to desplay message 
   $_SESSION['delete'] = "<div class ='success'>Admin Deleted Successfully.</div>";
   //redirect ro manage admin page 
   echo '<script type="text/javascript">
      location.replace("'.SITEURL.'admin/manage-admin.php"); </script>';
  }
  else 
  {
    //failed to delet admin
    //echo "faile delete";
    $_SESSION['delete'] = "<div class='error' >Failed To Deleted Admin . Try Agian Later</div>";
    //redirect ro manage admin page 
    echo '<script type="text/javascript">
       location.replace("'.SITEURL.'admin/manage-admin.php"); </script>';
  }
//3. redirect to manage admin page with message (success/error)
?>