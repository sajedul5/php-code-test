<?php include('header.php'); ?>

        <?php
          if(isset($_POST['add-user'])){
            $name = mysqli_real_escape_string($con,trim($_POST['name']));
            $username = mysqli_real_escape_string($con,trim($_POST['username']));
            $password = mysqli_real_escape_string($con,trim($_POST['password']));
            $usertype = mysqli_real_escape_string($con,trim($_POST['usertype']));
            $pwd =md5($password);

            $check_query ="SELECT * FROM users WHERE username='$username'";
            $check_run = mysqli_query($con, $check_query);

            if(mysqli_num_rows($check_run) > 0){
              $error = " Username Aleady Exist!";
            }
            else {
              $insert_query = "INSERT INTO users(username, password, usertype)
              VALUES('$username','$pwd','$usertype')";
              if(mysqli_query($con, $insert_query)){
                header('location:login.php');
                $msg = "Add User Successfully";

              }
              else {
                $error ="User Has Not Been Added!";
              }
            }

          }

         ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 card p-5">
            <h3>Sign Up Form</h3>
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
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username"  data-validation="required">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password"  data-validation="required">
                </div>
                <div class="mb-3">
                    <input type="hidden" class="form-control" name="usertype"  value="customer">
                </div>

                <button type="submit" class="btn btn-primary" name="add-user">Sign Up</button>
                
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<?php include('footer.php'); ?>