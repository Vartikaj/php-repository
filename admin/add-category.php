<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
              <?php 
                include "config.php";
                if(isset($_POST['save']))
                {
                    $cat_name = $_POST['cat'];
                    $sql = "SELECT * FROM category WHERE category_name = '{$cat_name}'";
                    $result = mysqli_query($con,$sql) or die('Query Failed');
                    if(mysqli_num_rows($result) > 0){
                        echo "This category already exist, please enter other";
                    }else{
                        $query = "INSERT INTO category(category_name) VALUES('{$cat_name}')";
                        if(mysqli_query($con,$query)){
                            header('location:category.php');
                        }else{
                            echo "<p>Please enter valid category</p>";
                        }
                    }  
                }
              ?>
                  <!-- Form Start -->
                  <form action="" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
