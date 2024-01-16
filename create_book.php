<?php

include('server/connection.php');

$genreErr = "";
// $copies = "";
if (isset($_POST['add'])) {

    // book_id will be automatically entered by auto increment
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $edition = $_POST['edition'];
    $date_published = $_POST['date_published'];
    $copies = $_POST['copies'];
    $status = "Available";

    // $book_image = $_FILES['image']['tmp_name'];
    // $image = $_FILES['image']['name'];
    // move_uploaded_file($book_image, 'images/' . $image);

    define('SITE_ROOT', realpath(dirname(__FILE__)));

    $image_name = $book_image_tmp . "1.jpg";

    $destination = 'Images/slides/1/1.jpg';

    $book_image_tmp = $_FILES['file']['tmp_name'];
    $file_destination = 'Images/' . $destination;

    if (move_uploaded_file($book_image_tmp, $file_destination)) {

        $stmt = $conn->prepare("INSERT INTO books ( title, author, genre, edition, date_published, copies, status, image) VALUES (?,?,?,?,?,?,?,?)");

        $stmt->bind_param('sssssiss', $title, $author, $genre, $edition, $date_published, $copies, $status, $image);

        if ($stmt->execute()) {

            //GET THE LAST INSERTED BOOK ID
            $bookId = $conn->insert_id;

            for ($i = 1; $i <= $copies; $i++) {
                $isbn = generateUniqueISBN();
                $stmt = $conn->prepare("INSERT INTO book_copies (book_id, isbn, status, image) VALUES(?,?,'Available', ?)");
                $stmt->execute([$bookId, $isbn, $image]); // Do this instead of using bind_param everytime
            }

            header('location:addBook.php?message=Book added successfully!');
        } else {
            header('location:create_book.php?error=Book insertion failed. Try again.');
        }
    } else {
        // Handle the case when the file upload fails
        echo "File upload failed.";
    }



}



function generateUniqueISBN()
{
    $randomNumber = random_int(2394, 90823) - 40 + 3;
    return $randomNumber;
}


//   if(empty($_POST['genre'])){
//     $genreErr = "GENRE IS REQUIRED!";
// }
// else {
//     $genre = $_POST['genre'];
// }
?>