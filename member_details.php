<?php

include 'server/connection.php';

$date_difference = array();
$sum = 0;
$date_issued = "";
$differ = '';

if (isset($_POST['member_details'])) {

  $member_id = $_POST['member_id'];
  $gender = $_POST['gender'];

  $stmt_det = $conn->prepare("SELECT * FROM members WHERE member_id = ?");
  $stmt_det->bind_param('i', $member_id);
  if ($stmt_det->execute()) {
    // print_r($member_id);
    $stmt_result = $stmt_det->get_result();
  } else {
    header('location:member_details.php?error = Something went wrong');
  }
  $stmt_det->close();


  // $newstmt = $conn->prepare("SELECT * FROM returned_books WHERE member_id = ?");
  // $newstmt = $conn->prepare("SELECT ISBN, member_id, date_issued, date_returned FROM returned_books r WHERE r.member_id = ? UNION SELECT book_name, due_date, status FROM issued_books i WHERE i.member_id = ?");
  // $newstmt->bind_param('i', $member_id);

  $newstmt = $conn->prepare("SELECT * FROM returned_books r WHERE member_id = ?");
  $newstmt->bind_param('i', $member_id);

  // $stmt->bind_param('ii', $member_id, $member_id);
  if ($newstmt->execute()) {
    $stmt_res = $newstmt->get_result();


  } else {
    header('location:member_details.php?error = Cannot get member from returned books table');
  }


  $newstmt2 = $conn->prepare("SELECT ISBN, book_name, date_issued, date_returned, due_date,  'Returned' as status FROM returned_books r WHERE r.member_id = ? 
  UNION SELECT ISBN, book_name, date_issued,  '0000-00-00' as date_returned, due_date,status FROM issued_books i WHERE i.member_id = ?");
  $newstmt2->bind_param('ii', $member_id, $member_id);

  // $stmt->bind_param('ii', $member_id, $member_id);
  if ($newstmt2->execute()) {
    $stmt_res2 = $newstmt2->get_result();


  } else {
    header('location:member_details.php?error = Cannot get member from returned books table');
  }

  // $newstmt->close();

  while ($row = $stmt_res->fetch_assoc()) {
    $date_issued = new DateTime($row['date_issued']);
    $date_returned = new DateTime($row['date_returned']);
    $interval = $date_issued->diff($date_returned);
    $differ = $interval->format('%a');

    array_push($date_difference, $differ); // Add each difference to the array


    // collect other things from the table.
    // $ISBN = $row['ISBN'];
    // $date_returned = $row['date_returned'];
    // $date_issued = $row['date_issued'];
    // // $book_name = $row['book_name'];
    // $due_date = $row['due_date'];
    // $status = $row['status'];

  }
  // $average = "";

  $average = count($date_difference) > 0 ? array_sum($date_difference) / count($date_difference) : 0;



} else {
  header('location: member_details.php?error = Bad request!');

}

// TO GET THE RETURNED BOOKS
$returned = $conn->prepare("SELECT * from returned_books  where member_id = ? ORDER BY date_issued DESC LIMIT 1");
$returned->bind_param('i', $member_id);
$returned->execute();
$returned_books = $returned->get_result();


// TO GET THE RECENTLY ISSUED BOOKS
$issued = $conn->prepare("SELECT * from issued_books  where member_id = ? ORDER BY date_issued DESC LIMIT 3");
$issued->bind_param('i', $member_id);
$issued->execute();
$issued_books = $issued->get_result();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Member Details</title>
  <link rel="stylesheet" href="member_details.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head <body>
<div class="container-body">
  <?php while ($result = $stmt_result->fetch_assoc()) { ?>

    <aside class="left-pane">
      <div class="logo">
        <img src="images/L-removebg-preview.png" alt="" />
        <h5>MABB'S <span>LIBRARY</span></h5>
      </div>
      <div class="user-profile">
        <div class="user_avatar">
          <img src=<?php if ($gender == 'm' || $gender == "M") {
            echo "images/male_avatar.png";
          } elseif ($gender == 'f' || $gender == 'F') {
            echo "images/female_avatar.png";
          } ?> alt="" />
        </div>
        <div class="user-dets">
          <p>
            <?php echo $result['name'] ?>
          </p>
          <p>
            <?php echo $result['email'] ?>
          </p>
        </div>
      </div>
      <div class="delete-user">
        <a href="mailto: <?php echo $result['email'] ?>">Contact Member</a>

      </div>
    </aside>
    <section class="right-pane">
      <div class="card-component details">
        <h3>Member Details</h3>
        <p>
          <b>Member name:</b>
          <?php echo $result['name'] ?>
        </p>
        <p>
          <b>Email Address: </b>
          <?php echo $result['email'] ?>
        </p>
        <p>
          <b> Phone Number: </b>
          <?php echo $result['phone_number'] ?>
        </p>
        <p>
          <b> Member ID: </b>
          <?php echo $result['member_id'] ?>
        </p>
      </div>

      <div class="card-component borrowed-details" title="Last returned book">
        <?php $returned_row = $returned_books->fetch_assoc() ?>
        <div class="borrowed one">
          <h3>
            <?php if (isset($returned_row['book_name'])) {
              echo $returned_row['book_name'];
            } else {
              echo '';
            } ?>
          </h3>
          <p class="period">
            <?php if (isset($returned_row['date_issued'])) {
              echo $returned_row['date_issued'] ?> -
              <?php echo $returned_row['date_returned'];
            } else {
              echo "No books yet";
            } ?>

          </p>
        </div>
      </div>

      <div class="card-component returns">

        <h3>Recent Returns</h3>
        <div>
            <?php while ($issued_row = $issued_books->fetch_assoc()) { ?>
          <i class="fa-solid fa-book-open" style="color: #91b5f2;"></i>
        
            <p>
              <?php if (isset($issued_row['book_name'])) {
                echo $issued_row['book_name'];
              } else {
                echo "<p>None</p>";
              }
              ?>
            </p>
          <?php } ?>
        <?php } ?>
      </div>
    </div>




    <div class="card-component habit">
      <h3>Average Book Return Punctuality</h3>
      <input type="hidden" id="average" value="<?php echo $average ?>">
      <div id="chartdiv"></div>
    </div>

  </section>
</div>

<div class="table">
  <table>
    <h3 id="b-book">Books Borrowed By this Member </h3>
    <thead>
      <tr>
        <th>ISBN</th>
        <th>Book Title</th>
        <th>Issued Date</th>
        <th>Due Date</th>
        <th>Return Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <?php while ($row2 = $stmt_res2->fetch_assoc()) { ?>
      <tbody>

        <tr>
          <td>
            <?php if (isset($row2['ISBN'])) {
              echo $row2['ISBN'];
            } else {
              echo "";
            } ?>
          </td>
          <td>
            <?php if (isset($row2['book_name'])) {
              echo $row2['book_name'];
            } else {
              echo "none";
            } ?>
          </td>
          <td>
            <?php if (isset($row2['date_issued'])) {
              echo $row2['date_issued'];
            } else {
              echo "";
            } ?>
          </td>
          <td>
            <?php if (isset($row2['due_date'])) {
              echo $row2['due_date'];
            } else {
              echo "";
            } ?>
          </td>
          <td>
            <?php if (isset($row2['date_returned'])) {
              echo $row2['date_returned'];
            } else {
              echo "";
            } ?>
          </td>
          <td>
            <?php if (isset($row2['status'])) {
              echo $row2['status'];
            } else {
              echo "";
            } ?>
          </td>
        </tr>
      </tbody>
    <?php } ?>
  </table>

<?php // $files = glob('./*.php')?>

</div>

<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="member_details.js"></script>
</body>

</html>