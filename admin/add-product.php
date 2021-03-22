<?php

 include('header.php'); 
 if(!isset($_SESSION['username'])){
    header('Location:index.php');
  }
 ?>

<!-- navbar section -->
<?php include('nav.php'); ?>

        <?php
          if(isset($_POST['add-product'])){
            $name = mysqli_real_escape_string($con,trim($_POST['name']));
            $price = mysqli_real_escape_string($con,trim($_POST['price']));
            $location = mysqli_real_escape_string($con,trim($_POST['location']));

    
            $insert_query = "INSERT INTO product(name, price, location)
              VALUES('$name','$price','$location')";
              if(mysqli_query($con, $insert_query)){
                header('location:product.php');
                $msg = "Product added Successfully";

              }
              else {
                $error ="Product Has Not Been Added!";
              }

          }

         ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 card p-5">
            <h3>Add New Product</h3>
            <hr>
            <?php
            if(isset($error)){
              echo "<span class='pull-right text-danger'>$error</span>";
            }
            elseif(isset(($msg)))  {
              echo "<span class='pull-right text-success'>$msg</span>";
            }
           ?>
            <form action="#" method="post">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name"  data-validation="required">
                </div>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" class="form-control" name="price"  data-validation="required">
                </div>
                <div class="mb-3">
                <label class="form-label">Location</label>
                <select class="form-select form-control" name="location">
                    <option selected>Select The Location</option>
                    <option value="Dhaka">Dhaka</option>
                    <option value="Chittagong">Chittagong</option>
                    <option value="Rajshahi">Rajshahi</option>
                </select>
                </div>

                <button type="submit" class="btn btn-primary" name="add-product">Add Product</button>
                
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<?php include('footer.php'); ?>