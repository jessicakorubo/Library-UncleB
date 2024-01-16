<?php
include('server/connection.php');

if(isset($_POST['delete_user'])) {
    $member_id = $_POST['member_id'];
    $gender = $_POST['gender'];

    $stmt = $conn->prepare("DELETE FROM members WHERE member_id = ?");

    $stmt->bind_param("i", $member_id);

    if($stmt->execute()){
        echo "<p> Successfully deleted a user</p>";
    }
    else {
        echo "<p> Deletion of user is unsuccessful!</p>";
    }
}

?>