<?php include('partials/menu.php')?>
<div class='main-content'>
    <div class = 'wrapper'>
      <h1>Add Product</h1>

      <br><br>
      <?php
        if(isset($_SESSION['upload']))
           {
             echo $_SESSION['upload'];
             unset($_SESSION['upload']);
           } 
        ?>
      <form action="" method="POST" enctype="multipart/form-data">
        <table class = 'tbl-30'>
            <tr>
                <td>Title</td>
                <td>
                    <input type="text" name="title" placeholder="title of the product">
                </td>
            </tr>

            <tr>
                <td>Description</td>
                <td>
                    <textarea name="description" cols="30" rows = "5" placeholder="Description of the product"></textarea>
                </td>
            </tr>

            <tr>
                <td>Price</td>
                <td>
                    <input type="number" name="price" >
                </td>
            </tr>

            <tr>
                <td>Select Image</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category</td>
                <td>
                    <select name="category">

                    <?php
                    //create php code to display categories from database
                    //1.create sql to ger all active categories from database
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                    //execute query
                    $res = mysqli_query($conn , $sql);
                    //count rows to check wehther we have catagories or not 
                    $count = mysqli_num_rows($res);
                    //if count is greater than zero , we have categories else we dont have 
                    if($count>0)
                    {
                        //we have 
                        while($row = mysqli_fetch_assoc($res))
                        {
                            //get the details of categories
                            $id = $row['id'];
                            $title = $row['title'];

                            ?>
                            <option value="<?php echo $id; ?>"><?php echo $title ; ?></option>
                              
                            <?php
                        }
                    }
                    else
                    {
                        //we dont have 
                        ?>
                        <option value="0">No Catagory Found </option>
                        <?php
                    }

                    //display on drpopdown
                    ?>
 
                                

                        
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured</td>
                <td>
                    <input type="radio" name="Featured" value="Yes">Yes
                    <input type="radio" name="Featured" value="No">No
                </td>
            </tr>

            <tr>
                <td>Active</td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Product" class="btn-secondary">
                </td>
            </tr>
        </table>
      </form>

      <?php 
      //check whether the button is clicked or not
       if(isset($_POST['submit']))
       {
        //add the pro in database
        //echo "click"

        //1.get the data from form 
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        //check whether radion button for featuerd and active and ckecked or not 
        if(isset($_POST['featured']))
        {
            $featured = $_POST['featured'];
        }
        else
        {
            $featured = "no"; //setting the default value 

        }
        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else
        {
            $active = "no"; //setting the default value 

        }


          //2.upload the image if selected
           //check whether the select image is clicked or not and upload the image only if the imaage is selected
           if(isset($_FILES['image']['name']))
           {
            //get the details of the selected image 
            $image_name = $_FILES['image']['name'];
            //check whether the image is selcted or not and upload the image only if the imaage is selected
            if($image_name!="")

            {
                //image is selected
                //A.rename the image 
                //get the extenion of selected image 
                $ext = end(explode('.',$image_name));

                //create new name for image 
                $image_name="product-Name".rand(0000,9999).'.'.$ext;//new image name 

                //B.upload the image 
                //get the src path and distination path
                //source path is the current location of the image
                $src = $_FILES['image']['tmp_name'];

                //destination path for the image to be upload 
                $dst = "../images/product/".$image_name;

                //finally upload the pro image 
                $upload = move_uploaded_file($src,$dst);

                //check whether image uploded or not
                if($upload==false)
                {
                    //failed to upload the imaage 
                    //redirect to add pro page with error message
                    $_SESSION['upload'] = "<div class='error'> Failed to Upload Image. </div>";
                    //redirect to  add category page
                echo '<script type="text/javascript">
                location.replace("'.SITEURL.'admin/add-product.php"); </script>';
                //stop the process
                die();
                }
            }
           }
           else
           {
            $image_name = ""; //setting default value as blank
           }
          //3.insert into database 
            //vreate a sql to save or add product 
            //for nummerical we dont need to pass value inside quites '' but for string value it is compulsory to add quotes''
            $sql2 = "INSERT INTO tbl_product SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            catagory_id = $category,
            featured = '$featured',
            active = '$active'
            ";
            //execute the query
            $res2 = mysqli_query($conn , $sql2);
            //check whether data inserted or not


          //4.redirect with message to manage product page
          if($res2==true)
          {
            //data inserted successfully
            $_SESSION['add'] = "<div class='success'>Product Add Successfully.</div>";
            echo '<script type="text/javascript">
                location.replace("'.SITEURL.'admin/manage-product.php"); </script>';
          } 
          else
          {
            $_SESSION['add'] = "<div class='error'>Failed to Add Product.</div>";
            echo '<script type="text/javascript">
                location.replace("'.SITEURL.'admin/manage-product.php"); </script>';
          }


       }
      ?>
    </div>

</div>


<?php include('partials/footer.php')?>