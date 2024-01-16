<?php
include('server/connection.php');
if (isset($_GET['book_id'])) {

    $book_id = $_GET['book_id'];

    $stmt = $conn->prepare("SELECT * from books b INNER JOIN book_copies c on b.book_id = c.book_id where b.book_id = ?");


    $stmt->bind_param('i', $book_id);

    $stmt->execute();

    $book_details = $stmt->get_result();

    $affected = $stmt->affected_rows;

    $stmt1 = $conn->prepare("SELECT * from  book_copies where book_id = ? AND status = 'Available'");

    $stmt1->bind_param('i', $book_id);

    $stmt1->execute();

    $book_available = $stmt1->get_result();
    $available_affected = $stmt1->affected_rows;



    // ALL BOOK COPIES
    $stmt2 = $conn->prepare("SELECT * from  book_copies where book_id = ? ORDER BY copy_id ASC");

    $stmt2->bind_param('i', $book_id);

    $stmt2->execute();

    $copies = $stmt2->get_result();
    $all_copies = $stmt2->affected_rows;



    // SELECT bc.status AS book_copies_status, other_table.other_column
// FROM book_copies AS bc
// INNER JOIN other_table ON bc.some_id = other_table.some_id;



} else {
    header('location:view-books.php?Cannot check details.');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="css/single.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
</head>

<body>
    <section class="whole-section">
        <div class="upper-side">
            <section class="left-books-section">
                <div class="book-con">
                    <?php $row = $book_details->fetch_assoc() ?>
                    <?php $row1 = $book_available->fetch_assoc() ?>
                    <h2 id="book_name">
                        <?php echo $row['title'] ?>
                    </h2>
                    <div class="book-image">
                        <img src="images/<?php echo $row['image'] ?>" alt="">
                    </div>
                    <h3>Book ID :
                        <?php echo $row['book_id'] ?>
                    </h3>
                    <h3>Genre :
                        <?php echo $row['genre'] ?>
                    </h3>

                </div>
                <!-- <div> <hr class="divider"></div> -->

            </section>

            <section class="right-books-section">
                <div class="upper-right-section">
                    <div class="book-details">
                        <div class="details-column">
                            <h2>Book Details</h2>
                            <h3>Book Author :
                                <?php echo $row['author'] ?>
                            </h3>

                            <h3>Total Copies :
                                <?php echo $row['copies'] ?>
                            </h3>

                            <h3>Copies Borrowed</h3>
                            <h3>Total Available Copies :
                                <?php echo $affected ?>
                            </h3>
                            <div class="view">
                                <div id="date_published">
                                    <i class="fa-solid fa-book"></i>
                                    <p>
                                        <?php echo $row['date_published'] ?>
                                    </p>
                                </div>
                                <div class="delete_book">
                                    <div class="button-div">
                                        <button type="button" class="delete delete_single" >DELETE</button>
                                        <div class="popup popup_single">
                                            <div class="qtn">
                                                Are you sure you want to delete this book? It might delete data from other tables as well. Click cancel to abort.
                                            </div>
                                            <div class="delete-options">
                                                <form action="delete_book.php" method="POST">
                                                    <input type="hidden" name="book_id"
                                                        value="<?php echo $row['book_id'] ?>">
                                                    <input type="hidden" name="title"
                                                        value="<?php echo $row['title'] ?>">
                                                    <input id="delete-book" type="submit" value="Delete"
                                                        name="delete_book">
                                                    <input id="cancel-book" type="reset" value="Cancel" name="cancel">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="unavailable">
                        <p>Mark as unavailable</p>
                        <p>Click to mark this book as no longer available</p>
                        <a href="#">Unavailable</a>
                        <p></p>
                    </div> -->
                </div>

            </section>
        </div>
        <div class="lower-section">
            <div class="table">
                <h3 class="total_text">Total Copies</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Copy ID</th>
                            <th>ISBN</th>
                            <th>Status</th>
                            <th>...</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($row3 = $copies->fetch_assoc()) { ?>
                            <tr>
                                <td>
                                    <?php echo $row3['copy_id'] ?>
                                </td>
                                <td>
                                    <?php echo $row3['ISBN'] ?>
                                </td>
                                <td class="status">
                                    <?php echo $row3['status'] ?>
                                </td>
                                <td>
                                    <div id="issue_book">
                                        <form action="issue_book.php" method="POST">
                                            <input type="hidden" name="isbn" value="<?php echo $row3['ISBN'] ?>">
                                            <input type="submit" id="issue-btn" name="issue_book" value="Issue">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
        </div>
    </section>

    <script src="index.js"></script>
</body>

</html>