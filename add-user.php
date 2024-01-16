<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add a User</title>

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
              <h2>New Member</h2>
              <p>Fill in the required inputs for a new member</p>
            </div>
            <div class="right-form">
              <div class="form-header">
                <h2>GENERAL INFORMATION</h2>
                <p>General information for new members</p>
              </div>
              <div class="entry">
                <form action="add-a-user.php" method="post">
                  <div class="form">
                    <div id="member_id" class="input-label">
                      <label for="member_id">Member ID</label>
                      <div class="input-container">
                        <i></i>
                        <input
                          required
                          name="member_id"
                          type="text"
                          placeholder="Ex: 686567"
                        />
                      </div>
                    </div>
                    <div id="member_name" class="input-label">
                      <label for="member_name">Member Name</label>
                      <div class="input-container">
                        <i></i>
                        <input
                          required
                          name="member_name"
                          type="text"
                          placeholder="Ex: John Doe"
                        />
                      </div>
                    </div>
                    <div id="email" class="input-label">
                      <label for="email">Email Address</label>
                      <div class="input-container">
                        <i></i>
                        <input name="email" type="text" placeholder="Ex: JohnDoe@gmail.com" />
                      </div>
                    </div>
                    <div id="registration_date" class="input-label">
                      <label for="registration_date">Registration Date</label>
                      <div class="input-container">
                        <i></i>
                        <?php $today = strtotime("today") ?>
                        <input
                        id="register-date"
                        readonly
                          required
                          name="registration_date"
                          type="date"
                          value ="<?php echo date('Y-m-d', $today) ?>"
                        />
                      </div>
                    </div>
                    <div id="gender" class="input-label">
                      <label for="gender">Gender</label>
                      <div class="input-container">
                        <i></i>
                        <input
                          required
                          name="gender"
                          type="text"
                          placeholder="Ex: f..."
                        />
                      </div>
                    </div>
                    <div id="phone_number" class="input-label">
                      <label for="phone_number">Phone Number</label>
                      <div class="input-container">
                        <i></i>
                        <input
                          name="phone_number"
                          type="tel"
                          placeholder="Ex: 09032 ..."
                        />
                      </div>
                    </div>
                    <!-- <div id="borrowed_copies" class="input-label">
                      <label for="borrowed_copies">Borrowed Copies</label>
                      <div class="input-container">
                        <i></i>
                        <input
                          required
                          name="borrowed_copies"
                          type="number"
                          placeholder="1"
                        />
                      </div>
                    </div> -->
                  </div>
                  <div class="submit-container">
                    
                    <input
                      class="submit"
                      type="submit"
                      value="Submit"
                      name="add-member"
                    />
                    <input class="reset" type="reset" value="Cancel" />
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
