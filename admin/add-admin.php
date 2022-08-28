<?php include ('partials/menu.php')?>


<div class = "main-content">
     
     <div class ="wrapper">
            <h1>Add Admin</h1>

             <br />
             <?PHP
              if(isset($_SESSION['add']))  
              {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
              }           
             ?>
          <form action="" method="POST">
               
              <table class="tbl-30">
                <tr>
                  <td>Full Name: </td>
                  <td><input type="text"
                   name="full_name"
                    placeholder="enter your name "></td>
                </tr>
                    
                <tr>
                  <td> Username:</td>
                  <td>
                  <input type="text"
                   name="username"
                   placeholder="Your Username">
                  </td>
                </tr>

                <tr>
                  <td>Password</td>
                  <td>
                  <input type="password"
                   name="password"
                   placeholder="Your password">
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <input type="submit" 
                    name="submit"
                    value="Add Admin"
                    class="btn-secondary">
                  </td>
                </tr>
                
              </table>
          </form>
     </div>
</div>

<?php include ('partials/footer.php')?>

<?php 

// process the value from form and save it in database
// check whether the sumbit  button is clicked or not

if(isset($_POST['submit']))
{
  // button clicked 
  // echo "button clicked";

  //1.get data from form 
   $Full_Name = $_POST["full_name"];
   $Username = $_POST["username"];
   $Password = md5($_POST["password"]);

   //2.sql query to save the data into database 
   $sql="INSERT INTO tbl_admin SET
    full_name ='$Full_Name',
    username='$Username',
    Password = '$Password'
   ";
    //3. executing query and saveing the data into database
   $res = mysqli_query($conn , $sql) or die(mysqli_error($conn));

    if($res==TRUE)
    {
      //echo "data insert";
      //creat session  variable to display massage
      $_SESSION['add'] = "<div class ='success'>Admin Add Successfully.</div>";
      //Redirect page to Manage Admin
      echo '<script type="text/javascript">
      location.replace("'.SITEURL.'admin/manage-admin.php"); </script>';

    }

    else
    {
     // echo "faild to insert data";
      //creat session  variable to display massage
      $_SESSION['add'] = "Faild To Added Admin";
      //Redirect page to Add Admin
     
      echo '<script type="text/javascript">
      location.replace("'.SITEURL.'admin/add-admin.php"); </script>';
    }
   


}

?>