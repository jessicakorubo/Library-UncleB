<?php 

include('server/get-books.php');

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DASHBOARD</title>
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
          <!-- <div class="form-header" >
            <h2>Hi Admin, Welcome Back</h2>
          </div> -->
          <div
            class="form-container dashDetails" style="height: 450px; display: flex; justify-content: center; align-items: center"
            data-aos="slide-right"
            data-aos-duration="4000"
          >
            <div class="card-container">
              <div class="cardy cardOne">
                <h6 class="bookText">Total number Of Books</h6>
                <p class="cardNumber"> <?php echo $total_books ?> </p>
              </div>

              <div class="cardy cardTwo">
                <h6 class="bookText">Borrowed Books</h6>
                <p class="cardNumber"><?php echo $total_borrowed_books ?></p>
              </div>

              <div class="cardy cardThree">
                <h6 class="bookText">Available Books</h6>
                <p class="cardNumber"><?php echo $total_available_books ?></p>
              </div>

              <div class="cardy cardFour">
                <h6 class="bookText">Total number Of Users</h6>
                <p class="cardNumber">  <?php echo $totalUsers ?></p>
              </div>

              <!-- <div class="cardy cardFive">
                <h6 class="bookText">Owing Users</h6>
                <p class="cardNumber">10</p>
              </div> -->

             
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
