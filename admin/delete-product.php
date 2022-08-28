<?php
include('../config/constants.php');

if(isset($_GET['id'])&&isset($_GET['image_name']))
{
    //echo "procesa to deleete";
    //1.get id and image name
    $id = $_GET['id'];
    $image_name=$_GET['image_name'];
    //2.remove the image if available 
    //check whether the image is available or not and delete inly if available
    if($image_name !="")
    {
        //it has image and need tp remove from folder
        //getthe image path '
        $path = "../images/product/".$image_name;
        //remove image file folder
        $remove = unlink($path);
        //check whether the image is ermoved or not 
        if($remove==false)
        {
            //failed to remove image 
            $_SESSION['upload'] = "<div class='error'>Failed Remove Image File.</div>";
             //redirect ro manage product page 
    echo '<script type="text/javascript">
    location.replace("'.SITEURL.'admin/manage-product.php"); </script>';
    die();
        }
    }
    //3.delete pr from database
    $sql= "DELETE FROM tbl_product WHERE id =$id";
    //execute query
     $res = mysqli_query($conn,$sql);
     //check whether the query executed or not and set the session message respectively
    //4.redirect to manage product with session message
    if($res==true)
    {
        //pr deleted
        $_SESSION['delete'] = "<div class='success'>Product Delete Successfully.</div>";
        //redirect to manage product page 
echo '<script type="text/javascript">
location.replace("'.SITEURL.'admin/manage-product.php"); </script>';
    }
    else
    {
        echo '<script type="text/javascript">
        location.replace("'.SITEURL.'admin/manage-product.php"); </script>';
    }
}
else
{
    //redirect to manage product page 
$_SESSION['unauthorize'] = "<div class = 'error'>unauthorized Access. </div>";
echo '<script type="text/javascript">
location.replace("'.SITEURL.'admin/manage-product.php"); </script>';
}
?>