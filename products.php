<?php include('partials-front/menu.php') ;?>

    <!-- PRODUCTS sEARCH Section Starts Here -->
    <section class="product-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>Product-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Product.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- PRODUCTS sEARCH Section Ends Here -->



    <!-- PRODUCTS MEnu Section Starts Here -->
    <section class="product-menu">
        <div class="container">
            <h2 class="text-center">Product Menu</h2>

                <?php 
                //display product that are active 
                $Sql = "SELECT * FROM tbl_product WHERE active = 'Yes'";

                //execute query 
                $res = mysqli_query($conn , $Sql);
                //count rows 
                $count = mysqli_num_rows($res);

                //check whether the product are avaliable or not 
                if($count>0)
                {
                    //product avaliable
                    while($row=mysqli_fetch_assoc($res))
                    {
                       // get all values
                       $id = $row['id'];
                       $title = $row['title'];
                       $description = $row['description'];
                       $price = $row['price'];
                       $image_name = $row['image_name'];
                          
                       ?>
                          
                          <div class="product-menu-box">
                <div class="product-menu-img">
                    <?php 
                    //check whether image available or not 
                    if($image_name=="")
                    {
                        //image not available 
                        echo "<div class = 'error'>image Not Found.</div>";
                    }
                    else
                    {
                        //image avaliable 
                        ?>
                     <img src="<?php echo SITEURL; ?>images/product/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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
                   // product not avaliable
                   echo "<div class = 'error'>Product Not Found.</div>";
                }
                
                ?> 


           

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- PRODUCTS Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ;?>