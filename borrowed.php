<?php

include 'server/get-books.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Borrowed Books</title>
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
      <img data-aos="fade-in" data-aos-duration="4000" src="images/L-removebg-preview.png" alt="" />
      <h4 data-aos="fade-in" data-aos-duration="4000">MABB'S <span>LIBRARY</span></h4>
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
      <div class="borrowed-section">
        <div class="view-books-table">

          <div class="table-top">

            <div class="table-content">
              BORROWED BOOKS
            </div>
          </div>
          <div class="table-body">
            <table>
              <thead>
                <tr>
                  <td>ISBN</td>
                  <td>MEMBER ID</td>
                  <td>TITLE</td>
                  <td>AUTHOR</td>
                  <!-- <td>...</td> -->
                  <td>...</td>
                </tr>
              </thead>
              <tbody>
                <?php while ($res = $borrowed_books->fetch_assoc()) { ?>
                  <tr>
                    <td>
                      <?php echo $res['ISBN'] ?>
                    </td>
                    <td>
                      <?php echo $res['member_id'] ?>
                    </td>
                    <td>
                      <?php echo $res['book_name'] ?>
                    </td>
                    <td>
                      <?php echo $res['author'] ?>
                    </td>
                    <!-- <td>
                      <button type="button" class="details">DETAILS</button>
                    </td> -->
                    <td>
                      <button type="button" class="issued return-button">RETURN</button>
                      <div class="popup-return">
                        <div class="popup-header">
                          <h4>Book Return Confirmation</h4>
                         <img class="close" src="images/close-30.png" alt="">
                        </div>
                        <form action="book_return.php" id="form" method="POST">
                          <div class="input-popup">
                            <label for="isbn">Book ISBN</label> <br>
                            <input readonly type="text" name="isbn" value="<?php echo $res['ISBN'] ?>">
                          </div>
                          <div class="input-popup">
                            <label for="member_id">User ID</label><br>
                            <input readonly type="text" name="member_id" value="<?php echo $res['member_id'] ?>">
                          </div>
                          <div class="input-popup">
                            <label for="date_issued">Issued Date</label><br>
                            <input readonly type="date" name="date_issued" value="<?php echo $res['date_issued'] ?>">
                          </div>
                          <div class="input-popup">
                            <?php $today = strtotime("today") ?>
                            <label for="return_date">Return Date</label><br>

                            <input readonly type="date" name="return_date" value="<?php echo date('Y-m-d', $today) ?>">

                             <input type="hidden" name="due_date" value="<?php echo $res['due_date'] ?>">
                          
                            </div>
                            <div class="options">
                              <input class="submit-popup" name="sumbit_return" type="submit" value="SUBMIT">
                              <input class="reset-popup" type="reset" value="RESET">
                            </div>
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
    </div>
  </div>

  <script src="return.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>
