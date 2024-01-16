<?php

include 'server/connection.php';
        
if(isset($_POST['sumbit_return'])) {
    $isbn = $_POST['isbn'];
    $member_id = $_POST['member_id'];
    $date_issued  = $_POST['date_issued'];
    $return_date = $_POST['return_date'];
    $due_date = $_POST['due_date'];

    $stmt = $conn->prepare("INSERT INTO returned_books (ISBN, member_id, date_issued, date_returned, due_date) VALUES(?,?,?,?,?)");

    $stmt->bind_param('iisss', $isbn, $member_id, $date_issued, $return_date, $due_date);

    $stmt_update1 = $conn->prepare("UPDATE book_copies SET status ='Available' where ISBN = ? ");

    $stmt_update2 = $conn->prepare("DELETE FROM issued_books WHERE isbn = ?");

    if($stmt_update2->execute([$isbn])) {

        if ($stmt_update1->execute([$isbn])) {
            if ($stmt->execute()) {
                header('location: book_return.php?message=Book returned successfully');
            } else {
                header('location:book_return.php?message= Book return failed. Try again.');
            }
        }
        else {
            header('location:book_return.php?error=Could not update book copies table');
        }
    }
    else {
        header('location:book_return.php?error=Could not delete book isbn from issued_books table!');
    }
}

?>