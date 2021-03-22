<?php include('header.php'); ?>

<!-- navbar section -->
<section>
    <div class=''>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
   <div class="container">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Products</a>
        </li>
        <li class="nav-item">

          <?php
           if( isset($_SESSION['usertype']) && !empty($_SESSION['usertype']) )
                {
                ?>
                      <a class="nav-link" href="logout.php">Logout</a>
                <?php }else{ ?>
                    <a class="nav-link" href="login.php">Login</a>
             <?php } ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>
</section>
<?php
if(isset($_GET['buy'])){
    $buy_id = $_GET['buy'];
    $buy_query = "SELECT * FROM product WHERE id =$buy_id";
    $buy_query_run = mysqli_query($con, $buy_query);

    if(mysqli_num_rows($buy_query_run) > 0){
    $buy_row = mysqli_fetch_array($buy_query_run);
    $name = $buy_row['name'];
    $price = $buy_row['price'];
    $location = $buy_row['location'];

    }
}

?>
        <?php

            
          if(isset($_POST['buy-now'])){
            $location = mysqli_real_escape_string($con,trim($_POST['location']));
            $price = mysqli_real_escape_string($con,trim($_POST['price']));
            $buy_id = mysqli_real_escape_string($con,trim($_POST['buy_id']));

            if($location == "Rajshahi"){
                $discount = $price * 25 / 100;

               $insert_query = "INSERT INTO orders(buy_id, discount)
                VALUES('$buy_id','$discount')";
                if(mysqli_query($con, $insert_query)){
                header('location:index.php');
                $msg = "Buy added Successfully";

                }
                else {
                $error ="Buy Has Not Been Added!";
                }
                   
                
             }else{
                $insert_query = "INSERT INTO orders(buy_id, discount)
                VALUES('$buy_id','0')";
                if(mysqli_query($con, $insert_query)){
                header('location:index.php');
                $msg = "Buy added Successfully";

                }
                else {
                $error ="Buy Has Not Been Added!";
                }
             }

            }

         ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 card p-5">
            <h3>Order Form</h3>
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
                <input type="hidden" name="buy_id" value="<?php echo $buy_id; ?>">
                <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" class="form-control" name="location"  data-validation="required" value="<?php echo $location; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="name"  data-validation="required" value="<?php echo $name; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" class="form-control" name="price"  data-validation="required" value="<?php echo $price; ?>">
                </div>
                

                <button type="submit" class="btn btn-primary" name="buy-now">Buy Now</button>
                
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<?php include('footer.php'); ?>