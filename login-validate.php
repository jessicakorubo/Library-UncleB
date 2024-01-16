<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('server/connection.php');

if(isset($_POST['login-btn'])) {

  printf('<pre>');
  print_r($_POST);
  printf('<pre>');

  $user_name = $_POST['uname'];
  $psw = $_POST['psw'];

  $stmt = $conn->prepare("SELECT * FROM admin where user_name =?" );
  $stmt->bind_param('s', $uname);
  // $stmt->bind_result();
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    $hashedPassword = $row['user_password'];
    
    print_r($row['user_password']);


    if(password_verify($psw, $hashedPassword)) {
 
      $_SESSION['user_name'] = $user_name;

      header('location:dashboard.php?message=YAYY WORKED');
      exit();
    }
    else 
    //Authentication failed
    {
      header('location:login-validate.php.php?error=Login unsuccessful');
    }

  }
  else {
     header('location:login-validate.php?error=NO rows returned');
  }


}
else {
  header('location:login-validate.php?message=You are not clicking on the login button');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
</body>
</html>