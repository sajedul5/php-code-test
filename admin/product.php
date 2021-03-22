<?php

 include('header.php'); 
 if(!isset($_SESSION['username'])){
    header('Location:index.php');
  }
 ?>

<!-- navbar section -->
<?php include('nav.php'); ?>


<div class="container">
  <div class="card mt-5">
  <h3 class="p-3">Product List</h3>
  <a href="add-product.php" class="btn btn-info">Add Product</a>
  <hr>
    <?php
        $query ="SELECT * FROM product ORDER BY id ASC";
        $run = mysqli_query($con, $query);
        if(mysqli_num_rows($run) > 0){

       ?>
  <table class="table table-striped">
  <thead>
    <tr>
     <th scope="col">#ID</th>
      <th scope="col">Product Name</th>
      <th scope="col">Price</th>
      <th scope="col">Location</th>
    </tr>
  </thead>
  <tbody>
        <?php
          while($row = mysqli_fetch_array($run)){
            $id = $row['id'];
            $name = $row['name'];
            $price = $row['price'];
            $location = $row['location'];

         ?>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td><?php echo $name; ?></td>
      <td><?php echo $price; ?></td>
      <td><?php echo $location; ?></td>
    </tr>
    <?php
             } 
        }
    ?>
  </tbody>
</table>
  </div>
</div>


<?php include('footer.php'); ?>