<?php

include('server/connection.php');
// function resetInputFields()
// {
//   $isbn = "";
//   $title = "";
//   $name = "";
//   $member_id = "";
//   $date_issued = "";
//   $due_date = "";
//   $status = "";
// }

if (isset($_POST['issue_book'])) {

  $isbn = $_POST['isbn'];
}

// if($result->num_rows < 1) {
//     $wrong_ID = "This ID does not exist in the database!";
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Issue a book</title>
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

    <div class="right-section">
      <div class="add-user">
        <div class="form-container" data-aos="slide-right" data-aos-duration="4000">
          <div class="left-text">
            <h2>Issue Book</h2>
            <p>Fill in the required inputs to issue a book</p>
          </div>
          <div class="right-form">
            <div class="form-header">
              <h2>GENERAL Details</h2>
              <p>General details for book issuance</p>
            </div>

            <div class="entry">
              <form action="issue_logic.php" method="POST">
                <div class="form">
                  <div id="isbn" class="input-label">
                    <label for="ISBN">ISBN</label>
                    <div class="input-container">
                      <i></i>
                      <input name="isbn" type="text" placeholder="Ex: 129750" required readonly
                        value="<?php echo $isbn ?>" />
                    </div>


                  </div>

                  <div id="member_id" class="input-label">
                    <label for="member_id">Member ID</label>
                    <div class="input-container">
                      <i></i>
                      <input name="member_id" type="text" placeholder="Ex: 32352..." required />
                    </div>
                    <p>

                    </p>
                  </div>

                  <div id="date_issued" class="input-label">
                    <label for="date_issued">Date Issued</label>
                    <div class="input-container">
                      <i></i>
                      <?php $today = strtotime("today") ?>
                      <input name="date_issued" readonly type="date" placeholder="Ex: Drama, Young adult..." required
                        value="<?php echo date('Y-m-d', $today) ?>" />
                    </div>
                  </div>
                  <div id="due_date" class="input-label">
                    <label for="due_date">Due Date</label>
                    <div class="input-container">
                      <i></i>
                      <?php $due = strtotime("+ 7days") ?>
                      <input name="due_date" type="date" value="<?php echo (date('Y-m-d', $due)) ?>"
                        placeholder="Ex: Drama, Young adult..." />

                    </div>
                    <span style='color: black; font-weight:700;'>Due date set to a week by default.
                      Can be altered.</span>
                  </div>


                </div>
                <div class="submit-container">

                  <input type="submit" class="submit" name="issue_logic" value="Submit" />

                  <input class="reset" name="reset" type="reset" value="Reset" />

                  <?php
                  if (isset($_SESSION['success_message'])) {
                    echo '<p>' . $_SESSION['success_message'] . '</p>';
                    // Remove the success message from the session
                    unset($_SESSION['success_message']);
                  }
                  ?>

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