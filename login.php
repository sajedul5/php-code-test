<?php include('header.php'); ?>

    <?php

    if(isset($_POST['login'])){
      $username = mysqli_real_escape_string($con, $_POST['username']);
      $password = mysqli_real_escape_string($con, $_POST['password']);
      $pwd =md5($password);

      $check_username_query = "SELECT * FROM users WHERE username= '$username' AND password='$pwd'";
      $chech_username_run = mysqli_query($con , $check_username_query);

    if(mysqli_num_rows($chech_username_run) > 0){
      $row =mysqli_fetch_array($chech_username_run);

      $_SESSION['username'] = $row['username'];
      $_SESSION['usertype'] = $row['usertype'];

      if($_SESSION['usertype'] === 'customer'){
        header('location:index.php');
      }else{
        $error ="Username Password Worng!";
      }
      
    }
    else{
        $error ="Username Password Worng!";
      }
    }

     ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 card p-5">
        <?php
          if(isset(($error)))  {
            echo "<span class='palert alert-danger lead'>$error</span>";
          }
         ?>
            <h3>Login Form</h3>
            <hr>
            <form action="#" method="post">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username"  data-validation="required ">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password"  data-validation="required ">
                </div>
                <button type="submit" class="btn btn-primary" name="login">Login</button>
                <a href="signup.php">Not yet sign up? please sign up</a>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<?php include('footer.php'); ?>