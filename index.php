<?php

 include('header.php'); 

 ?>

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


<div class="container">
  <div class="card mt-5">
  <h3 class="p-3">Product List </h3>
  <hr>
    <?php

        $query ="SELECT * FROM product ORDER BY id ASC";
        $run = mysqli_query($con, $query);
        if(mysqli_num_rows($run) > 0){

       ?>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Product Name</th>
      <th scope="col">Price</th>
      <th scope="col">Location</th>
      <th scope="col">Buy</th>
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
      <td><?php echo $name; ?></td>
      <td><?php echo $price; ?></td>
      <td><?php echo $location; ?></td>
      <td><a href="buy.php?buy=<?php echo $id; ?>">
      <?php
      if( isset($_SESSION['usertype']) && !empty($_SESSION['usertype']) )
          {
          ?>
                <a href="buy.php?buy=<?php echo $id; ?>">Buy</a>
          <?php }else{ ?>
              <a href="login.php">Buy</a>
        <?php } ?>
      
      </td>
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