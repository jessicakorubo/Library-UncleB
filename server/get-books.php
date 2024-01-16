<?php 

    include('connection.php');

    // GET TOTAL NUMEBER OF BOOKS IN LIBRARY, BOTH AVAILABLE AND UNAVAILABLE

    $a_books = $conn ->prepare("SELECT * FROM books");
    $a_books->execute();
    $all_books = $a_books->get_result();
    $total_books = $a_books->affected_rows;  // GET TOTAL NUMEBER OF 'AVAILABLE' BOOKS IN LIBRARY


    $members = $conn->prepare("SELECT * FROM members");
    $members->execute();
    $all_members = $members->get_result();
    $totalUsers = $members->affected_rows;    // GET TOTAL MEMBERS/ LIBRARY USERS
 

    // GET BORROWED BOOKS
    $borrowed = $conn->prepare("SELECT * FROM issued_books");
    $borrowed->execute();
    $borrowed_books = $borrowed->get_result();
    $total_borrowed_books = $borrowed->affected_rows;


    // SELECT ALL BOOKS MARKED AS AVAILABLE
    $available_books = $conn->prepare("SELECT * FROM books where status = 'Available'");
    $available_books->execute();
    $all_available_books = $available_books->get_result();
    $total_available_books = $available_books->affected_rows; // GET TOTAL NUMEBER OF 'AVAILABLE' BOOKS IN LIBRARY
    
    // SELECT ALL BOOKS MARKED AS AVAILABLE
    $available_books = $conn->prepare("SELECT * FROM books where status = 'Available'");
    $available_books->execute();
    $all_available_books = $available_books->get_result();
    $total_available_books = $available_books->affected_rows; // GET TOTAL NUMEBER OF 'AVAILABLE' BOOKS IN LIBRARY


// GET RETURNED BOOKS
  
    
?>

<!-- if($stmt->num_rows() == 0) -->