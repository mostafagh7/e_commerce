<?php include('partials/menu.php');?>


<?php 

//check whether id is set or not
if(isset($_GET['id']))
{
    //get all the details
    $id = $_GET['id'];
    //sq; query to get the selected pr
    $sql2="SELECT * FROM tbl_product WHERE id=$id";
    //execute query 
    $res2 = mysqli_query($conn,$sql2);
    //get the value based on query executed
    $row2=mysqli_fetch_assoc($res2);
    //get the individual values of selected pr
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['catagory_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
}
else
{
    //redirect to  manage product page
    echo '<script type="text/javascript">
    location.replace("'.SITEURL.'admin/manage-product.php"); </script>';
}

?>


<div class = "main-content">
    <div class = "wrapper">
        <h1>Update Product</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class = "tbl-30">
            <tr>
                <td>Title</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title ?>">
                </td>
            </tr>

            <tr>
                <td>Description</td>
                <td>
                    <textarea name="description"  cols="30" rows="5"><?php echo $description ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price</td>
                <td>
                    <input type="number" name="price" value="<?php echo $price ?>" >
                </td>
            </tr>

            <tr>
                <td>Current Image</td>
                <td>
                    <?php
                    if($current_image=="")
                    {
                        echo "<div class = 'error'>Image not Available . </div>";
                    }
                    else
                    {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/product/<?php echo $current_image; ?>" width="150px">
                        <?php
                    }
                    ?>
                </td>
            </tr>
               
              <tr>
                <td>Select New Image</td>
                <td>
                    <input type="file" name="image" >
                </td>
              </tr>

            <tr>
                <td>Category</td>
                <td>
                    <select name="category" >

                    <?php 
                    //query to get active categories 
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                    //execute the query 
                    $res = mysqli_query($conn , $sql);
                    //count rows
                    $count=mysqli_num_rows($res);
                    //check whether catefory available or not 
                    if($count>0)
                    {
                     while($row=mysqli_fetch_assoc($res))
                     {
                        $category_title=$row['title'];
                        $category_id=$row['id'];

                       // echo "<option value = '$category_id'>$category_title</option>";
                       ?>
                       <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id ?>"><?php echo $category_title; ?></option>
                       <?php
                     }
                    }
                    else
                    {
                        echo "<option value = '0'> Category not available . </option> ";
                    }
                    ?>
                        <option value="0">Text Category</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured</td>
                <td>
                    <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No">No
                </td>
            </tr>

            <tr>
                <td>Active</td>
                <td>
                    <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No">No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                    <input type="submit" name="submit" value="Update Product"class = "btn-secondary">
                </td>
            </tr>
        </table>
        </form>

        <?php 
        if(isset($_POST['submit']))
        {
            //1.get all the details from rhe form 
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2.upload the image if selected
            //check whether upload button is clicked or not 
            if(isset($_FILES['image']['name']))
            {
                //upload button clicked
                $image_name= $_FILES['image']['name'];//new image name

                //check whether the file is available or not 
                if($image_name!="")
                {
                    //image is avaliable
                    //A. uplodaing new image 
                    //rename the image 
                    $ext = end(explode('.',$image_name));//gets the exension of the img
                    $image_name= "Product-Name".rand(0000,9999).'.'.$ext; //this will be renamed image
                    //get the source path and distination path
                    $src_path = $_FILES['image']['tmp_name'];//source path
                    $dest_path = "../images/product/".$image_name;//des path

                    //upload the img
                    $upload = move_uploaded_file($src_path,$dest_path);
                    //check whether the image is uploaded or nor 
                    if($upload==false)
                    {
                        $_SESSION['upload'] = "<div class = 'error'> Failed to Upload New Image. </div>";
                    //redirect to  manage product page
                     echo '<script type="text/javascript">
                     location.replace("'.SITEURL.'admin/manage-product.php"); </script>';
                       //stop the process
                         die();
                    }
                    //3. remove the image if new image is uploaded and current image exists
                    //B. remove vurrent image if avaliable
                    if($current_image!="")
                    {
                        //current image is avalible
                        //remove the image 
                        $remove_path = "../images/product/".$current_image;

                        $remove = unlink($remove_path);

                        //check whether the image is removed or not 
                        if($remove==false)
                        {
                            //failed to remove currnet image 
                            $_SESSION['remove-failed'] = "<div class = 'error'> Failed to remove Current Image. </div>";
                    //redirect to  manage product page
                     echo '<script type="text/javascript">
                     location.replace("'.SITEURL.'admin/manage-product.php"); </script>';
                       //stop the process
                         die();
                        }
                    }
                }
                else 
                {
                    $image_name = $current_image;//default image when image is not selected
                }
            }
            else
            {
                $image_name = $current_image;// default image when button not clicked
            }
  

            //4.update the pr database
               $sql3 = "UPDATE tbl_product SET
               title = '$title',
               description = '$description',
               price = $price,
               image_name = '$image_name',
               catagory_id = '$category',
               featured = '$featured',
               active = '$active'
               WHERE id = $id
               ";
                 
                 //execute the query 
                 $res3=mysqli_query($conn , $sql3);

                 //check whether the query is executed or not 
                 if($res3==true)
                 {
                    $_SESSION['update'] = "<div class = 'success'> product Update Successfully. </div>";
                    //redirect to  manage product page
                     echo '<script type="text/javascript">
                     location.replace("'.SITEURL.'admin/manage-product.php"); </script>';
                 }
                 else
                 {
                    $_SESSION['update'] = "<div class = 'error'> Failed to Update product  . </div>";
                    //redirect to  manage product page
                     echo '<script type="text/javascript">
                     location.replace("'.SITEURL.'admin/manage-product.php"); </script>';
                 }

            //redirect to manage product with session message
            
        }
        ?>


    </div>
</div>

<?php include('partials/footer.php');?>