<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>update a Book</title>
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
              <h2>Update Books</h2>
              <p>Fill in the required inputs to update book</p>
            </div>
            <div class="right-form">
              <div class="form-header">
                <h2>GENERAL Details</h2>
                <p>General details to update books</p>
              </div>
              <div class="entry">
                <div class="form">
                  <div id="isbn" class="input-label">
                    <label for="isbn">ISBN</label>
                    <div class="input-container">
                      <i></i>
                      <input name="isbn" type="text" placeholder="Ex: 12bn" />
                    </div>
                  </div>
                  <div id="booktitle" class="input-label">
                    <label for="lastname">Book Title</label>
                    <div class="input-container">
                      <i></i>
                      <input
                        name="booktitle"
                        type="text"
                        placeholder="Ex: devils fire"
                      />
                    </div>
                  </div>
                  <div id="email" class="input-label">
                    <label for="email">Author</label>
                    <div class="input-container">
                      <i></i>
                      <input
                        name="auhtor"
                        type="text"
                        placeholder="Ex: John Doe"
                      />
                    </div>
                  </div>
                  <div id="House Address" class="input-label">
                    <label for="address">Genre</label>
                    <div class="input-container">
                      <i></i>
                      <input
                        name="address"
                        type="text"
                        placeholder="Ex: Romance, novel..."
                      />
                    </div>
                  </div>
                  <div id="city" class="input-label">
                    <label for="city">Number Of Copies</label>
                    <div class="input-container noc">
                      <i></i>
                      <input name="copies" type="number" placeholder="1" />
                    </div>
                  </div>
                </div>
                <div class="submit-container">
                  <input class="reset" type="reset" value="Cancel" />
                  <input class="submit" type="submit" value="Submit" />
                </div>
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
