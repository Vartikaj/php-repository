<?php 
    include "header.php"; 
    if(isset($_POST['save']))
    {
        include "config.php";
        /** MYSQLI_REAL_ESCAPE_STRING(DATABASE_CONNECT_NAME , DATA_VALUE) : this function is used to prevent with sql injection. */
        $fname = mysqli_real_escape_string($con, $_POST['fname']);
        $lname = mysqli_real_escape_string($con, $_POST['lname']);
        $user = mysqli_real_escape_string($con, $_POST['user']);
        $password = mysqli_real_escape_string($con, sha1($_POST['password']));
        $role = mysqli_real_escape_string($con, $_POST['role']);

        $sql = "SELECT username FROM user WHERE username = '{$user}'";
        $result = mysqli_query($con,$sql)
        or die("select query field");

        if(mysqli_num_rows($result) > 0)
        {
            echo "<p>user name already exist.</p>";
        }else{
            $sql1 = "INSERT INTO user (first_name, last_name, username,password,role) VALUES('{$fname}', '{$lname}', '{$user}', '{$password}', '{$role}')";
            if(mysqli_query($con, $sql1)){
                header("location:users.php");
            }
        }
    }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF'];?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
