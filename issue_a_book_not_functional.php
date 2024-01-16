<?php

    include('server/connection.php');

    if(isset($_POST['issue-book'])) {
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $member_name = $_POST['member_name'];
        $member_id = $_POST['member_id'];
        $date_issued = $_POST['date_issued'];
        $due_date = $_POST['due_date'];
        $status = 'ACTIVE';
        $copies = $_POST['copies'];

        // validating the member id

        $stmt_members = $conn->prepare("SELECT * from members where member_id = ?");
        $stmt_members->bind_param('i', $member_id);
        $stmt_members->execute();
        $result = $stmt_members->get_result();

        if($result->num_rows < 1) {
            header('location:issue_book.php?message=This ID does not exist in the database!');
        }


        $stmt=$conn->prepare("INSERT INTO issued-books (member_id, member_name, isbn, book_name, date_issued, due_date, status, copies) VALUES (?,?,?,?,?,?,?,?)");

        $stmt->bind_param('isisiisi', $member_id, $member_name, $isbn, $date_issued, $due_date, $status, $copies);

        if($stmt->execute()){
            header('location:issue_book.php?message=Book issued to user successfuly!');
        }
        else {
            header('location: issue_book.php?error=Book issuance failed woefully!');
        }
    }

?>