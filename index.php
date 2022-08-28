<?php include('partials-front/menu.php') ;?>

    <!-- PRODUCTS sEARCH Section Starts Here -->
    <section class="product-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>product-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Products.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- PRODUCTS sEARCH Section Ends Here -->
           <?php 
             if(isset($_SESSION['order']))
             {
               echo $_SESSION['order'];
               unset($_SESSION['order']);
             }
           ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Products</h2>


            <?php 
              //create sql query to display catefories from database
              $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' AND featured = 'YES' LIMIT 3";
              //execute the query 
              $res = mysqli_query($conn , $sql);
              //count rows to check whether the category is avaliable or not 
              $count = mysqli_num_rows($res);
              if($count>0)
              {
                //categories available 
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the value 
                    $id = $row['id'];
                    $title= $row['title'];
                    $image_name = $row['image_name'];
                    ?>

            <a href="<?php echo SITEURL; ?>category-products.php?category_id=<?php echo $id; ?>">
            <div class="box-3 float-container">
               
               
               <?php
                if($image_name=="")
                {
                    //display message
                    echo "<div class = 'error'>Image not Available . </div>";
                }
                else
                {
                    //image available
                    ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" class="img-responsive img-curve">
                    <?php
                }
                

                ?>

                <h3 class="float-text text-white"><?php echo $title ?></h3>
            </div>
            </a>

                    <?php
                }
              }
              else
              {
                //category not available 
                echo "<div class = 'error'>Category not Added . </div>";
              }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- PRODUCTS MEnu Section Starts Here -->
    <section class="product-menu">
        <div class="container">
            <h2 class="text-center">Product Menu</h2>
              
                 <?php
                 //getting product from database that  are active an featured
                 //sql query
                 $sql2="SELECT * FROM tbl_product WHERE active = 'Yes' AND featured ='Yes' LIMIT 6";

                 //execute query 
                 $res2=mysqli_query($conn, $sql2);

                 //count rows 
                 $count2 = mysqli_num_rows($res);
                 //check whether product available or not 
                 if($count2>0)
                 {
                   //product available   
                   while($row=mysqli_fetch_assoc($res2))  
                   {
                    //get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                       
                       <div class="product-menu-box">
                       <div class="product-menu-img">
                        <?php 
                        //check whether image avaliable or not 
                        if($image_name=="")
                        {
                            //image avaliable
                            echo "<div class = 'error'>Image not Available . </div>";
                        }
                        else
                        {
                            //image avaliable
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
                 else
                 {
                   // product not available
                   echo "<div class = 'error'>Product not Available . </div>";
                 }
                 ?>


            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="#">See All Products</a>
        </p>
    </section>
    <!-- PRODUCTS Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>