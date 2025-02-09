<?php

  require('config/config.php');
  require('config/db.php');

  // Check for submit
  if(isset($_POST['submit'])){
    // Get form data
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    // Query to check if user exists
    $query = "SELECT * FROM account WHERE username = '$username'";

    $result = mysqli_query($conn, $query);

    if($result){
      $user = mysqli_fetch_assoc($result);

      if($password === $user['password']){
        // User authenticated, redirect to logs page
        header('Location: '.ROOT_URL.'guestbook-list.php');
      } else {
        // Incorrect password, display error message
        echo  '<div class="alert alert-danger">Incorrect username or password.</div>';
      }
    } else {
      // User not found, display error message
      echo '<div class="alert alert-danger">Incorrect username or password.</div>';
    }
  }




?>
<?php include('inc/header.php'); ?>
  <br/>
  <div style="width:30%; margin: auto; text-align: center;">
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" class="form-signin">
      <img class="mb-4" src="img/bootstrap.svg" alt="" width="100" height="100">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="" autofocus="">
      <br/><label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button type="submit" name="submit" value="Submit" class="btn btn-lg btn-primary btn-block">Sign in</button>

    </form>
  </div>
<?php include('inc/footer.php'); ?>