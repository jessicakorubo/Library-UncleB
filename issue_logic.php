<?php

include 'server/connection.php';

if (isset($_POST['issue_logic'])) {

    $isbn = $_POST['isbn'];
    $member_id = $_POST['member_id'];
    $date_issued = $_POST['date_issued'];
    $due_date = $_POST['due_date'];


    // CODE TO GET BOOK INFO FROM BOOKS TABLE
    $stmt = $conn->prepare("SELECT * FROM books b INNER JOIN book_copies c ON b.book_id = c.book_id WHERE c.ISBN = ?");
    $stmt->bind_param('i', $isbn);
    $stmt->execute();
    $book_result = $stmt->get_result();

    $book_info = $book_result->fetch_assoc();

    $title = $book_info['title'];
    $author = $book_info['author'];
    $status = 'Issued';

    // CODE TO GET MEMBER ID AND MEMBER NAME
    $stmt1 = $conn->prepare("SELECT * from members where member_id = ?");
    $stmt1->bind_param('i', $member_id);
    $stmt1->execute();
    $id_res = $stmt1->get_result();

    $affected = $stmt1->affected_rows;

    $member_result = $id_res->fetch_assoc();
    // print_r($member_result);

    foreach($member_result as $membs) {
        $member_name = $member_result['name'];
        echo $member_name;
    }



    if ($affected > 0) {

        $stmt_change = $conn->prepare("UPDATE book_copies SET status='Issued' WHERE isbn=?" );
        $stmt_change->bind_param('i', $isbn);
       
        if( $stmt_change->execute()) {

            $stmt2 = $conn->prepare("INSERT INTO issued_books(member_id, member_name, ISBN, book_name, author, date_issued, due_date, status) VALUES(?,?,?,?,?,?,?,?)");
            $stmt2->bind_param('isisssss', $member_id, $member_name, $isbn, $title, $author, $date_issued, $due_date, $status);

            if ($stmt2->execute()) {
                session_start();
                $_SESSION['success_message'] = "Book issued to member successfully!";
                header('location: issue_logic.php?message=Successfuly issued book to member!');
            }
        } else {
            header('location:issue_book.php?message="No user with this ID found!"');
        }
    }
    else {
        header('location:issue_book?error=No rows found for this user');
    }

}
//TO VALIDATE MEMBER ID



?>