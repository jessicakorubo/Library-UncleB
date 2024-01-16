<?php

include('server/connection.php');

function generateUniqueISBN()
{
  $randomNumber = random_int(2394, 90823) - 40 + 3;
  return $randomNumber;
}

if (isset($_POST['add'])) {

  // book_id will be automatically entered by auto increment
  $title = $_POST['title'];
  $author = $_POST['author'];
  $genre = $_POST['genre'];
  $edition = $_POST['edition'];
  $date_published = $_POST['date_published'];
  $copies = $_POST['copies'];
  $status = "Available";

  $book_image = $_FILES['image']['tmp_name'];
  $image_name = $_FILES['image']['name'];
  move_uploaded_file($book_image, "Images/".$image_name);


  $stmt = $conn->prepare("INSERT INTO books (title, author, genre, edition, date_published, copies, status, image) VALUES (?,?,?,?,?,?,?,?)");

  $stmt->bind_param('sssssiss', $title, $author, $genre, $edition, $date_published, $copies, $status, $image_name);

  if ($stmt->execute()) {

    //GET THE LAST INSERTED BOOK ID
    $bookId = $conn->insert_id;

    for ($i = 1; $i <= $copies; $i++) {
      $isbn = generateUniqueISBN();
      $stmt = $conn->prepare("INSERT INTO book_copies (book_id, isbn, status) VALUES(?,?,'Available')");
      $stmt->execute([$bookId, $isbn]); // Do this instead of using bind_param everytime
    }

    header('location:addBook.php?message=Book added successfully!');
  } else {
    header('location:create_book.php?error=Book insertion failed. Try again.');
  }
}





?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add a book</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  </head>
  <body>

  
    <div class="header">
      <div class="logo">
        <img
          data-aos="fade-in"
          data-aos-duration="4000"
          src="images/L-removebg-preview.png"
          alt=""
        />
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
      <?php include 'left-dashboard.php' ;?>
      <div class="right-section">
        <div class="add-user">
          <div
            class="form-container"
            data-aos="slide-right"
            data-aos-duration="4000"
          >
            <div class="left-text">
              <h2>New Books</h2>
              <p>Fill in the  inputs for new books</p>
            </div>
            <div class="right-form">
              <div class="form-header">
                <h2>GENERAL Details</h2>
                <p>General details for new books</p>
              </div>
              <div class="entry">
                <form action="addBook.php" method="POST" enctype="multipart/form-data">

                  <div class="form">

                    <div id="booktitle" class="input-label">
                      <label for="title">Book Title</label>
                      <div class="input-container">
                        <i></i>
                        <input required
                          name="title"
                          type="text"
                          placeholder="Ex: Commando"
                        />
                      </div>
                    </div>

                    <div id="author" class="input-label">
                      <label for="author">Author</label>
                      <div class="input-container">
                        <i></i>
                        <input required
                          name="author"
                          type="text"
                          placeholder="Ex: John Doe" 
                        />
                      </div>
                    </div>

                    <div id="edition" class="input-label">
                      <label for="author">Edition</label>
                      <div class="input-container">
                        <i></i>
                        <input required
                          name="edition"
                          type="text"
                          placeholder="Ex: 1st Edition" 
                        />
                      </div>
                    </div>

                    <div id="genre" class="input-label">
                      <label for="address">Genre</label>
                      <div class="input-container">
                        <i></i>
                        <input required
                          name="genre"
                          type="text"
                          placeholder="Ex: Drama, Young adult..."
                          
                        />
                      </div>
                    </div>

                    <div id="date_published" class="input-label">
                      <label for="date_published">Date Published</label>
                      <div class="input-container">
                        <i></i>
                        <input required
                          name="date_published"
                          type="date"
                          placeholder="Ex: Drama, Young adult..."                         
                        />
                      </div>
                    </div>

                    <div id="copies" class="input-label">
                      <label for="copies">Number Of Copies</label>
                      <div class="input-container noc">
                        <i></i>
                        <input required name="copies" type="number" placeholder="1" />
                      </div>
                    </div>
                    
                    <div id="image" class="input-label">
                      <label for="image">Book Image</label>
                      <div class="input-container">
                        <i></i>
                        <input required type="file" name="image" placeholder="Book image" value="" 
                        />
                      </div>
                    </div>

                  </div>
                  <div class="message" style="margin-top: 2rem">
                    <p><?php if(isset($message)){echo $message;} else {echo "";} ?></p>
                  </div>
                  <div class="submit-container">
                    
                    <input required type="submit"  class="submit" name="add" value="Submit" />

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
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>
