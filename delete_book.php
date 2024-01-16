<?php
include('server/connection.php');


// $book_copies_isbn = $conn->prepare("SELECT isbn FROM book_copies WHERE book_id =?");
// $book_copies_isbn->bind_param('i', $book_id);
// $book_copies_isbn->execute();
// $book_copies_isbn_result = $book_copies_isbn->get_result();
// while($collected = $book_copies_isbn_result->fetch_assoc()){
//     print_r ($collected['isbn']);

// }

if (isset($_POST['delete_book'])) {

    $book_id = $_POST['book_id'];
    $title = $_POST['title'];

    // if ($stmt_copies->num_rows() > 0) {
    $stmt_copies_delete = $conn->prepare("DELETE FROM book_copies WHERE book_id = ?");
    $stmt_copies_delete->bind_param('i', $book_id);

    // $stmt_reurned_books = $conn->prepare("DELETE FROM returned_books WHERE book_id = ?");

    if ($stmt_copies_delete->execute()) {

        $stmt = $conn->prepare("DELETE FROM books WHERE book_id = ?");
        $stmt->bind_param('i', $book_id);

        if ($stmt->execute()) {
            header('Location: view-books.php?message=Delete is successful! at '. $book_id);
        } else {
            header('location: view-books.php?message=Delete is not successful oo Wetin dey happen?!');

        }
    } else {
        header('location: delete_book.php?error=Could not delete the book id from the book copies table.');
    }


    // }

}
?>