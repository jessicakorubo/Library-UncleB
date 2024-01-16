<?php

include('server/connection.php');
if (isset($_POST['add-member'])) {
    $member_id = $_POST['member_id'];
    $member_name = $_POST['member_name'];
    $gender = $_POST['gender'];
    $registration_date = $_POST['registration_date'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    // $borrowed_copies = $_POST['borrowed_copies'];borrowed // Not going to use the borrowed copies.

    $mysql_date = date("Y-m-d", strtotime($registration_date));

    $stmt=$conn->prepare("INSERT INTO members (member_id, name, gender, registration_date, email, phone_number) VALUES (?,?,?,?,?,?)");

    $stmt->bind_param('issssi', $member_id, $member_name, $gender, $mysql_date, $email, $phone_number);

    printf('<pre>');

    print_r($_POST);

    printf ('</pre>');

    if($stmt->execute()){
        header('location:add-user.php?message=User successfully added on '.$registration_date  );
        exit;
    }
    else {
        header('location:add-user.php?error=User could not be added!');
        exit;
    }
}
?>
