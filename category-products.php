<?php include('partials-front/menu.php') ;?>

<?php 
  //check whether id is passed or not 
  if(isset($_GET['category_id']))
  {
    //category id is set and get the id 
    $category_id=$_GET['category_id'];
    //get the category title based on vategory id 
    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
    //execute query
    $res = mysqli_query($conn , $sql);
    //get the value from database
    $row = mysqli_fetch_assoc($res);
    //get the title
    $category_title = $row['title'];

  }
  else
  {
    //category not passed
    //redirect to home page 
    echo '<script type="text/javascript">
                     location.replace("'.SITEURL.'"); </script>';
  }
?>

    <!-- PRODUCTS sEARCH Section Starts Here -->
    <section class="product-search text-center">
        <div class="container">
            
            <h2>Products on <a href="#" class="text-white">"<?php echo $category_title ?>"</a></h2>

        </div>
    </section>
    <!-- PRODUCTS sEARCH Section Ends Here -->



    <!-- PRODUCTS MEnu Section Starts Here -->
    <section class="product-menu">
        <div class="container">
            <h2 class="text-center">Product Menu</h2>

            <?php 
              //create sql query to get product based on selected category
              $sql2 = "SELECT * FROM tbl_product WHERE catagory_id=$category_id";
                
              //execute query 
              $res2= mysqli_query($conn , $sql2);

              //count the rows
              $count2 = mysqli_num_rows($res2);

              //check whether product is avaliable or not 
              if ($count2>0)
              {
               //product is avaliable
               while($row2=mysqli_fetch_assoc($res2))
               {
                $id = $row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
                ?>
 
                 <div class="product-menu-box">
                <div class="product-menu-img">
                    <?php 
                      if($image_name=="")
                      {
                        echo "<div class ='error'>Image Not avaliable.</div>";
                      }
                      else
                      {
                        ?>
                       <img src="<?php echo SITEURL; ?>images/product/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                        <?php
                      }
                    ?>
                   
                </div>

                <div class="product-menu-desc">
                    <h4><?php echo $title ?></h4>
                    <p class="product-price">$<?php echo $price ?></p>
                    <p class="product-detail">
                    <?php echo $description ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL; ?>order.php?product_id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

                <?php
               }
              }

            ?>

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- PRODUCTS Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>