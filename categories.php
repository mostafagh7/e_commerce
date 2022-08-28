<?php include('partials-front/menu.php') ;?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Products</h2>
              
            <?php 
              //display all the category that are acitve
              //sql query 
              $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";

              //execute query 
              $res = mysqli_query($conn , $sql);
              //count row 
              $count = mysqli_num_rows($res);
              //check whether categories avaliable or not 
              if($count>0)
              {
                //categories avaliable
                while($row = mysqli_fetch_assoc($res))
                {
                    //get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
 
                     <a href="<?php echo SITEURL; ?>category-products.php?category_id=<?php echo $id; ?>">
                     <div class="box-3 float-container">
                         <?php 
                         if($image_name=="")
                         {
                            //image not avaliabe 
                            echo "<div class = 'error'>Image Not Found.</div>";
                         }
                         else
                         {
                            //image avaliable 
                            ?>
                             <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                            <?php
                         }
                         ?>
                   

                      <h3 class="float-text text-white"><?php echo $title; ?></h3>
                   </div>
                         </a>
                   <?php 
                    
                }
              }
              else
              {
                //categories not  avaliable
                echo "<div class = 'error'>Categories Not Found.</div>";
              }
            ?>

            



            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php') ;?>