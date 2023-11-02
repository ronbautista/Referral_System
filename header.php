<?php
session_start();
$fclt_id = $_SESSION['id'];
require_once 'includes/referral_functions.inc.php';
require __DIR__ . '/vendor/autoload.php';

if (!isset($_SESSION["first_account"])) {
  header("Location: fclt_login.php"); // Redirect to the login page for the first account
  exit();
}
$secondAccountEmpty = !isset($_SESSION["second_account"]);

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Referral System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
		<link rel="stylesheet" href="css/style.css?v=<?php echo time();?>">
  </head>
  <style>

  </style>
  <body>
			<nav id="sidebar">
				<div class="p-4 pt-5">

        <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(images/logo.png);"></a>
        
        <?php
                  // First account is logged in
                  echo '<h3 class="facility">' . $_SESSION["names"] . '</h3>';
              ?>
	        <ul class="list-unstyled components mb-5">
          <li>
            <a href="index.php" class="sidebarbtn <?php echo basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : ''; ?>" id="home-link">
                <i class="fi fi-ss-home"></i><span class="sidebar-label">Home</span>
            </a>
        </li>

            <?php 
            if (isset($_SESSION["first_account"])) {
              if ($_SESSION["facility"] == 'Birthing Home') {
                echo '<li>
                <a href="referrals.php" class="sidebarbtn ' . (basename($_SERVER['PHP_SELF']) === 'referrals.php' ? 'active' : '') . '" id="referrals-link">
                    <i class="fi fi-sr-document"></i><span class="sidebar-label">Referrals</span>
                </a>
                </li>';
            }else if ($_SESSION["facility"] == 'Hospital' || $_SESSION["facility"] == 'Provincial Hospital') {
                  echo '
                  <li>
                  <a href="new_referrals.php" class="sidebarbtn ' . (basename($_SERVER['PHP_SELF']) === 'new_referrals.php' ? 'active' : '') . '" id="new-referrals-link">
                      <i class="fi fi-sr-document"></i><span class="sidebar-label">New Referrals</span>
                  </a>
                    </li>
                <li>
                  <a href="accepted_referrals.php"class="sidebarbtn ' . (basename($_SERVER['PHP_SELF']) === 'accepted_referrals.php' ? 'active' : '') . '" id="accepted-referrals-link">
                  <i class="fi fi-sr-vote-yea"></i><span class="sidebar-label">Referral Transactions</span>
                  </a
                  >
                </li>';
              }
                else{
                  echo '';
                }
            }
            ?>
            <li>
              <a href="messages.php" class="sidebarbtn <?php echo basename($_SERVER['PHP_SELF']) === 'messages.php' ? 'active' : ''; ?>" id="messages-link">
              <i class="fi fi-sr-envelope"></i><span class="sidebar-label">Messages</span>
              </a
              >
            </li>
              <li>
                <a href="prenatal.php" class="sidebarbtn <?php echo basename($_SERVER['PHP_SELF']) === 'prenatal.php' ? 'active' : ''; ?>" id="prenatal-link">
                <i class="fi fi-ss-users"></i><span class="sidebar-label">Prenatal</span></a
                >
              </li>
              <?php 
              if (isset($_SESSION["second_account"])) {
                  if ($_SESSION["usersrole"] == 'Admin') {
                      echo '<li>
                      <a href="settings.php" class="sidebarbtn ' . (basename($_SERVER['PHP_SELF']) === 'settings.php' ? 'active' : '') . '" id="settings-link"
                        ><i class="fi fi-sr-settings"></i>Settings</a
                      >
                    </li>';
                  }
              }
              ?>
              <div class="footer">
              <li>
              <?php 
              echo' <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fi fi-rr-exit"></i><span class="sidebar-label">Logout</span></a>';
              ?>
              </li>
              </div>
            </ul>
          </div>
        </nav>


        <!-- Page Content  -->
      <div id="content">

      <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">

        <button type="button" id="toggleButton" class="btn"><i class="fi fi-br-menu-burger"></i></button>
        
        <!-- Remove 'navbar-collapse' class for horizontal stacking -->
        <div class="nav-items">
            <ul class="navbar-nav flex-row"> <!-- Use 'flex-row' class to stack items horizontally -->
            <li class="nav-item">
                    <a href="#" class="notification"><i class="fi fi-rr-interrogation"></i></a>
                </li>
                <li class="nav-item">
                    <a href="#" class="notification"><i class="fi fi-ss-bell"></i></a>
                </li>
                  <?php
                    if (isset($_SESSION["second_account"])) {
                      // Second account is logged in
                      echo '<li class="nav-item">
                      <div class="dropdown">
                      <div class="logo-container">
                          <img src="images/boy.png" alt="Logo" class="logo-icon">
                      </div>
                      <div class="button-container">
                      <a href="#" role="button" class="user-name">' . $_SESSION["usersname"] . '<i class="fi fi-sr-angle-small-down"></i></a>
                      <p class="user-description">'. $_SESSION["usersrole"].'</p>
                    </div>
                  
                    <div class="dropdown-content">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#staffEditModal">Profile</a>
                        <a href="includes/logout.inc.php">Logout</a>
                    </div>
                </div>
                </li>';
                  } else {
                      // No account is logged in, display login links
                      echo '<li class="nav-item">
                      <a href="#" data-bs-toggle="modal" class="user-login" data-bs-target="#loginModal">Login</a>
                        </li>';
                  }
                  ?>
                
              </ul>
      
          </div>
        </nav>

  <div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
    <div class="toast-header">
      <strong class="me-auto">Notification</strong>
      <small>Just Now</small>
      <button type="button" class="btn-close" id="toast-close" data-bs-dismiss="#liveToast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    <p class="toast-message">Hello, world! This is a toast message.</p> 
    <div class="mt-2 pt-2 border-top">
    </div>
  </div>
  </div>
</div>

        <!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <?php echo '<h1 class="modal-title" id="exampleModalLabel">' . $_SESSION["names"] . '</h1>';?>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-theme="custom"></button>
      </div>
      <div class="modal-body">
        <h5>Are you sure you want to logout?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn close" data-bs-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="includes/fclt_logout.inc.php" role="button">Logout</a>
      </div>
    </div>
  </div>
</div>


    <!-- EDIT STAFF PROFILE modal -->
    <div class="modal fade" id="staffEditModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" id="staffEdit">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Staff Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="status"></div>
                    <form id="user_profile" enctype="multipart/form-data">
                        <div class="image-profile">
                            <div class="image-content">
                                <img src="images/boy.png" alt="Logo" class="profile-icon" id="imagePreview">
                            </div>
                            <div class="edit-button">
                                <!-- Use a button to trigger the file input -->
                                <button type="button" class="btn btn-primary" id="uploadButton">Upload Image</button>

                                <!-- Hide the file input element -->
                                <input style="display: none;" type="file" id="formFile" name="profile_image" onchange="displaySelectedImage()">

                            </div>
                            <div id="image_name"></div>
                        </div>
                        <div class="profile-details">
                            <!-- Additional form fields for name and description -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                            </div>
                            <button type="button" class="btn btn-primary" id="saveButton">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>



