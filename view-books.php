<?php include('server/connection.php') ?>

<?php

// The search functionality
if(isset($_GET['search'])) {
  $filter_value = '%' . $_GET['search-book'] . '%';
  $books = $conn->prepare("SELECT * FROM books WHERE title LIKE ? OR author LIKE ? OR genre LIKE ?");
  $books->bind_param('sss', $filter_value, $filter_value, $filter_value);
  $books->execute();
  $all_books = $books->get_result();

  // if($books->affected_rows < 0) {
  //   echo '<td> No record found </td>';
  // }
} 
else {
  $books = $conn->prepare("SELECT * FROM books");
  $books->execute();
  $all_books = $books->get_result();
}

$totalBooks = $books->affected_rows;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>View books</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="header">
    <div class="logo">
      <img src="images/L-removebg-preview.png" alt="" />
      <h4>MABB'S <span>LIBRARY</span></h4>
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

    <div class="right-section">
      <div class="view-books-section">
        <div class="view-books-table">
          <div class="table-top">
            <div class="table-content">BOOK'S TABLE</div>
            <div class="book-new">
              <form class="search-form" action="view-books.php" post="get">
                <div class="search-books">
                  <i class="fa-solid fa-magnifying-glass"></i>
                  <hr />
                  <input type="text" name="search-book" placeholder="Search book..." />
                </div>
                <div class="add-book">
                  <input class="add-link" type="submit"  name="search">
                </div>
              </form>
            </div>
          </div>

          <div class="table-body">
            <table>
              <thead>
                <tr>
                  <td>TITLE</td>
                  <td>AUTHOR</td>
                  <td>GENRE</td>
                  <td>COPIES</td>
                  <td>...</td>
                  <td>...</td>
                </tr>
              </thead>
              <tbody>
                <?php while ($res = $all_books->fetch_assoc()) { ?>
                  <tr>
                    <td>
                      <?php echo $res['title'] ?>
                    </td>
                    <td>
                      <?php echo $res['author'] ?>
                    </td>
                    <td>
                      <?php echo $res['genre'] ?>
                    </td>
                    <td>
                      <?php echo $res['copies'] ?>
                    </td>
                    <td>
                      <a class="details" href="<?php echo "single_book.php?book_id=" . $res['book_id']; ?>">DETAILS</a>
                    </td>


                    <td>
                      <a class="edit" href="<?php echo "edit_book.php?book_id=" . $res['book_id']; ?>">EDIT</a>
                    </td>

                  

                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>

</html>

<!-- This is a messge -->