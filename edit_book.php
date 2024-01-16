<?php
include 'server/connection.php';

if (isset($_GET['book_id'])) {

  $book_id = $_GET['book_id'];

  $stmt = $conn->prepare("SELECT * FROM books where book_id = ?");

  $stmt->bind_param('i', $book_id);

  $stmt->execute();

  $book_edit = $stmt->get_result();


  // UPDATE BOOK INFORMATION
 

}
// else {
//   header('location:edit_book.php?Did not get the book id');

// }
else if (isset($_POST['edit_book'])) {

  $book_id = $_POST['book_id'];
  $title = $_POST['title'];
  $author = $_POST['author'];
  $genre = $_POST['genre'];
  $edition = $_POST['edition'];
  $date_published = $_POST['date_published'];
  $copies = $_POST['copies'];
  $image = $_POST['image'];

  print_r($title);


  $stmt_update = $conn->prepare('UPDATE books SET title = ?, author = ?, genre =?, edition =?,  date_published =?, copies=?, status=?, image=? where book_id = ?');

  $stmt_update->bind_param('sssssissi', $title, $author, $genre, $edition, $date_published, $copies, $status, $image, $book_id);

  if ($stmt_update->execute()) {
    header('location:view-books.php?message=Successfully edited a book');
  } else {
    header('location:edit_book.php?error=Could not successfully edit book!');
  }
}

// else {
//   header('location:edit_book.php?Did not get the edit book button');
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Book</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <link rel="stylesheet" href="addBook.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>


  <div class="header">
    <div class="logo">
      <img data-aos="fade-in" data-aos-duration="4000" src="images/L-removebg-preview.png" alt="" />
      <h4 data-aos="fade-in" data-aos-duration="4000">
        MABB'S <span>LIBRARY</span>
      </h4>
    </div>
    <div class="header-content">
      <div class="events">
        <a href="#">Upcoming Events</a>
      </div>
      <div class="admin">
        <div class="admin-pic">
          <a href="">
            <i class="fa-solid fa-user"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="main-section">
    <?php include 'left-dashboard.php'; ?>
    <?php include 'create_book.php'; ?>
    <div class="right-section">
      <div class="add-user">
        <div class="form-container" data-aos="slide-right" data-aos-duration="4000">
          <div class="left-text">
            <h2>New Books</h2>
            <p>Fill in the inputs for new books</p>
          </div>
          <div class="right-form">
            <div class="form-header">
              <h2>GENERAL Details</h2>
              <p>General details for new books</p>
            </div>
            <div class="entry">
              <?php $row = $book_edit->fetch_assoc() ?>
              <form action="edit_book.php" method="POST">

                <div class="form">

                  <div id="booktitle" class="input-label">
                    <label for="title">Book Title</label>
                    <div class="input-container">
                      <i></i>
                      <input required name="title" type="text" placeholder="Ex: Commando"
                        value="<?php echo $row['title'] ?>" />
                    </div>
                  </div>

                  <div id="author" class="input-label">
                    <label for="author">Author</label>
                    <div class="input-container">
                      <i></i>
                      <input required name="author" type="text" placeholder="Ex: John Doe"
                        value="<?php echo $row['author'] ?>" />
                    </div>
                  </div>

                  <div id="edition" class="input-label">
                    <label for="author">Edition</label>
                    <div class="input-container">
                      <i></i>
                      <input required name="edition" type="text" placeholder="Ex: 1st Edition"
                        value="<?php echo $row['edition'] ?>" />
                    </div>
                  </div>

                  <div id="genre" class="input-label">
                    <label for="address">Genre</label>
                    <div class="input-container">
                      <i></i>
                      <input required name="genre" type="text" placeholder="Ex: Drama, Young adult..."
                        value="<?php echo $row['genre'] ?>" />
                    </div>
                    <span>
                      <?php echo $genreErr; ?>
                    </span>
                  </div>

                  <div id="date_published" class="input-label">
                    <label for="date_published">Date Published</label>
                    <div class="input-container">
                      <i></i>
                      <input required name="date_published" type="date" placeholder="Ex: Drama, Young adult..."
                        value="<?php echo $row['date_published'] ?>" />
                    </div>
                  </div>

                  <div id="image" class="input-label">
                    <label for="image">Book Image</label>
                    <div class="input-container">
                      <i></i>
                      <input required name="image" type="file" placeholder="Book image"
                        value="<?php echo $row['date_published'] ?>" />
                    </div>
                  </div>

                  <div id="copies" class="input-label">
                    <label for="copies">Number Of Copies</label>
                    <div class="input-container noc">
                      <i></i>
                      <input required name="copies" type="number" placeholder="1"
                        value="<?php echo $row['copies'] ?>" />
                    </div>
                  </div>

                </div>
                <div class="message" style="margin-top: 2rem">
                  <p>
                    <?php if (isset($message)) {
                      echo $message;
                    } else {
                      echo "";
                    } ?>
                  </p>
                </div>
                <div class="submit-container">

                <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                  <input required type="submit" class="submit" name="edit_book" value="Submit" />

                  <input required class="reset" name="reset" type="reset" value="Cancel" />


                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>