<?php
include_once 'header.php';
include_once 'includes/referral_functions.inc.php';
include_once 'includes/messages_functions.inc.php';
$fclt_id = $_SESSION['id'];
$contacts = contacts();
$messages = messages();
$prenatals = prenatals();

// Call the function and fetch all the referrals
$displayreferrals = displayAllReferralsPending();
$getreferral = getAllReferrals();
$getminireferral = minireferrals();

$sql1 = "SELECT COUNT(*) as row_count FROM patients WHERE fclt_id = '$fclt_id'"; // Replace with your first table name
$sql2 = "SELECT COUNT(*) as row_count FROM referral_records WHERE fclt_id = '$fclt_id'"; // Replace with your second table name

$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);

if ($result1 && $result2) {
    // Step 3: Fetch the results and display the counts
    $patients = mysqli_fetch_assoc($result1);
    $referral = mysqli_fetch_assoc($result2);

    $patients = $patients['row_count'];
    $referral = $referral['row_count'];
}
?>

<div class="main-cards">

<div class="mini-cards" id="card1">
  <div class="mini-logo">
    <img src="images/person.png" class="mini-logo-image" alt="Logo">
  </div>
  <div class="mini-card-content">
    <h2 class="mini-name"><?php echo $patients;?></h2>
    <p class="mini-description">Total Prenatal</p>
  </div>
  <div class="mini-menu">
    <button class="mini-menu-button">...</button>
  </div>
</div>

<div class="mini-cards" id="card2">
  <div class="mini-logo">
    <img src="images/referral.png" class="mini-logo-image" alt="Logo">
  </div>
  <div class="mini-card-content">
    <h2 class="mini-name"><?php echo $referral;?></h2>
    <p class="mini-description">Total Referral</p>
  </div>
  <div class="mini-menu">
    <button class="mini-menu-button">...</button>
  </div>
</div>


</div>



<div class="main-feed">
  <div class="row">

  <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
        <div class="head">
              <h3 class="left-heading mb-4">New Referrals</h3>
              <a class="see_all" href="#" role="button">View All</a>
            </div>
          <div class="home-feed">
          <div class="yourDivClass">

  <?php
      $count=0;
              // Loop through the referrals and display each patient in a table row
              foreach ($getminireferral as  $referrals) {
                  $fclt_name = $referrals['fclt_name'];
                  $time = $referrals['time'];
                  $name = $referrals['Name'];
                  $status = $referrals['status'];
                  ?>
      <div class="referral-card">
              <div class="mini-referral-logo" id="referral-logo">
                <img src="images/referral.png" alt="Logo" class="logo">
              </div>
                <div class="info">
                    <div class="name"><?= $fclt_name ?></div>
                  <?php
                    if($time == NULL){
                      ?>
                      <div class="description"><?= $name ?> • <?= $time?></div>
                      <?php
                    }else{
                      ?>
                  <div class="description"><?= $name ?> • <?= $time?></div>
                      <?php
                    }
                  ?>
                </div>
                <?php 
                if($status == NULL){
                  ?>
                  <button class="confirm-button" id="Pendingbtn">Pending</button>
                  <?php
                }else{
                  ?>
                  <button class="confirm-button" id="<?= $status ?>btn"><?= $status ?></button>
                  <?php
                }
                ?>
                
            </div>
            <?php
      $count++;
        }
        if($count==0){
          echo"no records found";
        }
      ?>
        </div>
        </div>
        </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
    <div class="head">
          <h3 class="left-heading mb-4">Prenatal</h3>
          <a class="see_all" href="#" role="button">View All</a>
        </div>
      <div class="home-feed">
        <div class="yourDivClass">

        <?php
            foreach ($prenatals as $prenatals) {
                $total = $prenatals['row_count'];
                $fclt_name = $prenatals['fclt_name'];

            ?>
        <div class="referral-card">
          <div class="mini-referral-logo" id="prenatal-logo">
            <img src="images/person.png" alt="Logo" class="logo">
          </div>
            <div class="info">
                <div class="name"><?= $fclt_name ?></div>
                <div class="description"><?= $total ?> Total Prenatal</div>
            </div>
            <button class="confirm-button" id="viewbtn">View</button>
        </div>
            <?php
            }
            ?>
            

        </div>
      </div>
    </div>
 <!-- Additional form fields for name and description -->
    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
    <div class="head">
          <h3 class="left-heading mb-4">Messages</h3>
          <a class="see_all" href="#" role="button">View All</a>
        </div>
      <div class="home-feed">
        <div class="yourDivClass">
        <div class="contacts">
            <?php
            foreach ($contacts as $contact) {
                $contact_name = $contact['fclt_name'];
                $contact_id = $contact['fclt_id'];

                // Add your condition here, for example, to skip a specific row:
                if ($contact_id != $fclt_id) {
            ?>
                <div class="referral-card" id="message-contact" data-contact-name="<?php echo $contact_name; ?>" data-contact-id="<?php echo $contact_id; ?>">
            <div class="mini-referral-logo" id="message-logo">
                <img src="images/person.png" alt="Logo" class="logo">
            </div>
            <div class="info">
                <div class="name"><?php echo $contact_name; ?></div>
                <div class="wews" id="wews-<?php echo $contact_id; ?>"></div>
            </div>
            <button class="confirm-button" id="viewbtn">View</button>
        </div>
            <?php
                }
            }
            ?>
      </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
    <div class="head">
          <h3 class="left-heading mb-4">Online Doctors</h3>
        </div>
      <div class="home-feed">
        <div class="yourDivClass">
          asdaadads
        </div>
      </div>
    </div>

  </div>
</div>



    
    <!-- Form Content  -->
    <div class="modal fade" id="referralModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">From: <span id="fclt_name"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-theme="custom"></button>
        </div>
    <div class="modal-body">
    <form id="referral_form">
    <div class="row">
    <div class="col-sm-12 col-md-6 col-lg-3">
        <label for="rffrl_id">Patient's ID</label>
        <input type="text" readonly name="rffrl_id" id="rffrl_id" class="form-control">
        </div>
        <?php 
          $query = "SELECT * FROM referral_format";
          $query_run = mysqli_query($conn, $query);

          if (mysqli_num_rows($query_run) > 0) {
              foreach ($query_run as $field) {
                  $fieldNameLabel = str_replace('_', ' ', $field['field_name']);
          ?>
                  <div class="col-sm-12 col-md-6 col-lg-3">
                      <label for="<?= $field['field_name'] ?>"><?= $fieldNameLabel ?></label>
                      <input type="text" readonly name="<?= $field['field_name'] ?>" id="<?= $field['field_name'] ?>" class="form-control">
                  </div>
          <?php
              }
          }

        ?>
        </div>
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn1" id="decline_button">Decline Referral</button>
        <button type="button" class="btn btn2" id="accept_button">Accept Referral</button>
    </div>
    </form>
        </div>
        </div>
        </div>

  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="staticBackdropLabel">Create Referral</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-theme="custom"></button>
      </div>
    <div class="modal-body">
    <form id="createReferral">
    <div class="row">
      <?php 
      $query = "SHOW COLUMNS FROM referral_forms";
      $query_run = mysqli_query($conn, $query);

      if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $field) {
            if ($field['Field'] !== 'id') {
                $fieldLabel = str_replace('_', ' ', $field['Field']);
    ?>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <label for="<?= $field['Field'] ?>"><?= $fieldLabel ?></label>
                    <input type="text" name="<?= $field['Field'] ?>" id="<?= $field['Field'] ?>" class="form-control">
                </div>
    <?php
            }
        }
    }

      ?>
        </div>


    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn1" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn2">Create</button>
    </div>
    </div>
    </form>
    </div>
    </div>



    <!-- STAFF LOGIN FORM -->
  <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" id="staffModalLogin">
    <div class="modal-content">
      <div class="modal-body">
      <div class="body-title">
      <h1>Log in</h1>
      <h5>staff log in</h5>
      </div>
        <form id="loginStaff">
        <div class="mb-3">
            <label for="uid" id = "asd">Username</label>
            <input type="text" class="form-control" name="uid" id="uid" placeholder="Enter username">
        </div>
        <div class="mb-3">
            <label for="uid">Password</label>
            <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter password">
        </div>
        <div class="mb-3 button-container">
        <div class="alert alert-danger d-none" id="errorMessage"></div>
        <button type="submit" class="btn btn-primary">Log in</button>
        <a class="btn btn-primary" href="includes/fclt_logout.inc.php" role="button" style="margin-right:auto">Logout Facility</a>
        <p class="button-text">Dont have an account? <a href="signup.php">Sign up now!</a></p>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>






<?php
include_once 'footer.php'
?>