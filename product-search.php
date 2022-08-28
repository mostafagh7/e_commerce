<?php include('partials-front/menu.php') ;?>

    <!-- PRODUCTS sEARCH Section Starts Here -->
    <section class="product-search text-center">
        <div class="container">
            <?php 
            //get the search keyword
            $search=$_POST['search'];
            ?>
            
            <h2>Products on Your Search <a href="#" class="text-white">"<?php echo $search ;?>"</a></h2>

        </div>
    </section>
    <!-- PRODUCTS sEARCH Section Ends Here -->



    <!-- PRODUCTS MEnu Section Starts Here -->
    <section class="product-menu">
        <div class="container">
            <h2 class="text-center">Product Menu</h2>

            <?php 

            //sql query to get products based on search keyword
            $sql = "SELECT * FROM tbl_product WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //execute query
            $res = mysqli_query($conn , $sql);

            //count rows 
            $count = mysqli_num_rows($res);
            //check whether product avaliable or not 
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the value
                    $id = $row ['id'];
                    $title = $row ['title'];
                    $price = $row ['price'];
                    $description = $row ['description'];
                    $image_name = $row ['image_name'];
                    ?>
                        <div class="product-menu-box">
                <div class="product-menu-img">
                    <?php 
                    //check whether image name is avaliable or not 
                    if($image_name=="")
                    {
                        //image not avaliable
                        echo "<div class='error'>image not Found.</div>";

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

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

                    <?php
                }
            }
            else
            {
                echo "<div class='error'>Image not Found.</div>";
            }

            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- PRODUCTS Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ;?>