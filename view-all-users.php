<?php 
include('server/connection.php');

if(isset($_GET['search-member'])) {

  $user_value = '%' . $_GET['user_search'] . '%';
  $members = $conn->prepare("SELECT * FROM members WHERE name LIKE ? or email LIKE ? ");
  $members->bind_param('ss',$user_value, $user_value);
  $members->execute();
  $all_members = $members->get_result();
}
else {
  $members = $conn->prepare("SELECT * FROM members");
  $members->execute();
  $all_members = $members->get_result();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
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

     <?php include 'left-dashboard.php' ;?>
     
      <div class="right-section">
         <div class="view-books-section">
          <div class="view-books-table">
            <div class="table-top">

              <div class="table-content">LIBRARY MEMBERS</div>
              <div class="book-new">
                  <form class="search-form" action="view-all-users.php" method="get">
                    <div class="search-books">
                      <i class="fa-solid fa-magnifying-glass"></i>
                      <hr />
                      <input type="text" name="user_search" placeholder="Search user..." />
                    </div>
                    <div class="add-book">
                     <input class="add-link" type="submit" name="search-member" value ="Search User">
                    </div>
                  </form>
                 
              </div>
            </div>

            <div class="table-body">
              <table>
                <thead>
                  <tr>
                    <td>Member ID</td>
                    <td>Member Name</td>
                    <td>Gender</td>
                    <td>Email</td>
                    <td>...</td>
                    <td>...</td>
                  </tr>
                </thead>
                <tbody>
                  <?php while($res = $all_members->fetch_assoc()) { ?>
                     <tr>
                        <td><?php echo $res['member_id'] ?></td>
                        <td><?php echo $res['name'] ?></td>
                        <td><?php echo $res['gender'] ?></td>
                        <td><?php echo $res['email'] ?></td>
                        <td>
                         
                          <form action="member_details.php" method="POST">
                            <input type="hidden" name="member_id" value="<?php echo $res['member_id'] ?>">
                              <input type="hidden" name="gender" value="<?php echo $res['gender'] ?>">
                              <input  class="details_link"  type="submit" name="member_details" value="DETAILS">

                              </form>
                            </td>
                            <td>
                             <div class="button-div">
                            <button type="button" class="delete delete_array">DELETE</button>
                            <div class="popup popup_array">
                              <div class="qtn">Are you sure you want to delete this user?</div>
                              <div class="delete-options">
                                <form action="delete_user.php" method="POST">

                                  <input type="hidden" name="member_id" value="<?php echo $res['member_id']?>">
                             
                              <input class="submit-delete" type="submit" value="Delete" name="delete_user">
                              <input class="submit-cancel" type="reset" value="Cancel" name="cancel">
                            </form>
                          </div>
                        </div>
                      </div>
                        </td>
                    </tr>
                     <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        <!-- </div> -->
      </div>

    </div>

    <script src="index.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
</body>
</html>