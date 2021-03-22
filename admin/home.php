<?php

 include('header.php'); 
 if(!isset($_SESSION['username'])){
    header('Location:index.php');
  }
 ?>

<!-- navbar section -->
<?php include('nav.php'); ?>

<?php
  if(isset($_GET['complete'])){
    $order_id = $_GET['complete'];
    $query= "UPDATE orders SET status ='1' WHERE id=$order_id";
    if(mysqli_query($con, $query)){
    }

  }


?>

<div class="container">
  <div class="card mt-5">
  <h3 class="p-3">Order List</h3>
  <hr>

    <?php
        //$query ="SELECT * FROM orders ORDER BY id DESC";
        $query = "SELECT orders.id, orders.discount, orders.status,product.name, product.price, product.location FROM orders LEFT JOIN product ON orders.buy_id = product.id ORDER BY orders.id DESC  ";
        $run = mysqli_query($con, $query);
        if(mysqli_num_rows($run) > 0){

       ?>
  <table class="table table-striped">
  <thead>
    <tr>
     <th scope="col">#ID</th>
      <th scope="col">Product Name</th>
      <th scope="col">Location</th>
      <th scope="col">Regular Price</th>
      <th scope="col">Discount Price</th>
      <th scope="col">Total Price</th>
      <th scope="col">Location</th>
    </tr>
  </thead>
  <tbody>
        <?php
          while($row = mysqli_fetch_array($run)){
            $id = $row['id'];
            $name = $row['name'];
            $location = $row['location'];
            $discount = $row['discount'];
            $status = $row['status'];
            $price = $row['price'];

         ?>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td><?php echo $name; ?></td>
      <td><?php echo $location; ?></td>
      <td><?php echo $price; ?></td>
      <td><?php echo $discount; ?></td>
      <td><?php echo $price - $discount ;  ?></td>
      <td><a href="home.php?complete=<?php echo $id; ?>"><?php 
          if($row['status'] == 0) {
            echo '<span class="text-danger">pending</span>';
          }else{
            echo '<span class="text-info">Complete</span>';
          }
      
      ?></a></td>
      
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