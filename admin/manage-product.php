<?php include('partials/menu.php');?>

<div class = "main-content">
    <div class="wrapper">
         <h1>Manage Products</h1>
         <br /> <br />

<!-- button to add admin -->

      <a href="<?php echo SITEURL; ?>admin/add-product.php" class="btn-primary" >Add Product</a>

      <br /><br /> <br />

      <?php 
       if(isset($_SESSION['add']))
       {
         echo $_SESSION['add'];
         unset($_SESSION['add']);
       }
       if(isset($_SESSION['delete']))
       {
         echo $_SESSION['delete'];
         unset($_SESSION['delete']);
       }
       if(isset($_SESSION['upload']))
       {
         echo $_SESSION['upload'];
         unset($_SESSION['upload']);
       }
       if(isset($_SESSION['unauthorize']))
       {
         echo $_SESSION['unauthorize'];
         unset($_SESSION['unauthorize']);
       }
       if(isset($_SESSION['remove-failed']))
       {
         echo $_SESSION['remove-failed'];
         unset($_SESSION['remove-failed']);
       }
       if(isset($_SESSION['update']))
       {
         echo $_SESSION['update'];
         unset($_SESSION['update']);
       }
      ?>

<table class= "tblfull" >
    <tr>
        <th>S.N.</th>
        <th>title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Action</th>
    </tr>
      <?php 
      //create a sql query to get all the pro 
      $sql = "SELECT * FROM tbl_product";
      //execute the query 
      $res = mysqli_query($conn , $sql);
      // count rows to check whether we have pros or not
      $count = mysqli_num_rows($res);

      $sn=1;
      if($count>0)
      {
        //we have pro in database
        //get the pros from database and display
        while($row =mysqli_fetch_assoc($res))
        {
            //get the vaules from individual columns
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
            ?>

             
    <tr>
        <td><?php echo $sn++; ?></td>
        <td><?php echo $title; ?></td>
        <td>$<?php echo $price ;?></td>
        <td>
            <?php
             //check whether we have image or not 
             if($image_name=="")
             {
                //we dont have image , pisplay error message
                echo "<div class='error'> Image Not Added";
             }
             else
             {
                //we have image , display image 
                ?>
                <img src="<?php echo SITEURL; ?>images/product/<?php echo $image_name; ?>" width="100px">
                <?php
             }
             ?>
        </td>
        <td><?php echo $featured; ?></td>
        <td><?php echo $active; ?></td>
        <td>
            <a href="<?php echo SITEURL; ?>admin/update-product.php?id=<?php echo $id; ?>" class="btn-secondary">Update Product</a>
            <a href="<?php echo SITEURL; ?>admin/delete-product.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Product</a>
        </td>
    </tr>



            <?php
        }
      }
      else
      {
        //pr not added in database
        echo "<tr> <td colspan='7' class='error'>Product not Added Yet. </td> </tr>";
      }
      ?>

    
</table>
    </div>
</div>

<?php include('partials/footer.php');?>