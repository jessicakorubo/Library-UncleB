<?php

session_start();
include('server/connection.php');

if(isset($_SESSION['logged'])) {
  header('location: dashboard.php');
  exit;
}
if (isset($_POST['login-btn'])) {
  $admin_username = $_POST['uname'];
  $admin_password = $_POST['psw'];


  print_r ($_POST);

  $stmt = $conn-> prepare("SELECT admin_username, admin_password FROM admin where admin_username = ? and admin_password =?");

  $stmt-> bind_param('ss', $admin_username, $admin_password);

  if ($stmt->execute()) {
    $stmt-> bind_result($admin_username, $admin_password);
    $stmt-> store_result();

    echo $stmt->num_rows();

    if($stmt->num_rows() > 0) {
      $stmt->fetch();

      $_SESSION['admin_username'] = $admin_username;
      $_SESSION['admin_password'] = $admin_password;
      $_SESSION['logged'] = true;

      header('location: dashboard.php?Log in successful');
    }
    else {
      header('location:login.php?Wrong username or password!'.$user_name.$psw);
    }
  }
  else {
    header('location:login.php?Something went wrong');
  }
}




?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="index.css" />
    <script
      src="https://code.jquery.com/jquery-3.6.4.js"
      integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="overlay"></div>

    <div class="form-container">
      <h2>Welcome Librarian</h2>
      <form action="login.php" method="POST" class="loginPage">
        <div class="imgcontainer">
          <img src="resource/images/avatar.jpg" alt="Avatar" class="avatar" />
        </div>

        <div class="field-container">
          <label for="uname"><b>Username</b></label>
          <input
            type="text"
            placeholder="Enter Username"
            name="uname"
            required
          />

          <label for="psw"><b>Password</b></label>
          <input
            type="password"
            placeholder="Enter Password"
            name="psw"
            required
          />

          <input class="login-btn" type="submit" value="Login" name="login-btn">

          <label class="rememberMe">
            <input type="checkbox" checked="checked" name="remember" />
            Remember me
          </label>
        </div>

        <div class="forgotpw-container" style="background-color: #f1f1f1">
          <button type="button" class="cancelbtn">Cancel</button>
          <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
      </form>
    </div>

    <script src="js/index.js"></script>
  </body>
</html>

<?php

// trim();
// htmlentities();
// htmlspecialchars();
// md5(date('ymdis').rand(12345, 678910));
// // explain the password_hash function.

// ucfirst(strtolower(str_replace(" ", "", clean($_POST['username']))));

// if($stmt->num_rows > 0) {

// }
// mysqli_num_rows($stmt) > 0

?>


