<?php
include_once 'header.php';
include_once 'includes/referral_functions.inc.php';

// Call the function and fetch all the referrals
$displayreferrals = displayAllReferralsPending();
$getreferral = getAllReferrals();
$getminireferral = minireferrals();

$sql1 = "SELECT COUNT(*) as row_count FROM patients"; // Replace with your first table name
$sql2 = "SELECT COUNT(*) as row_count FROM referral_forms"; // Replace with your second table name

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
                  $referral_records_time = $referrals['referral_records_time'];
                  $referral_transaction_time = $referrals['referral_transaction_time'];
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
                    if($referral_transaction_time == NULL){
                      ?>
                      <div class="description"><?= $name ?> • <?= $referral_records_time?></div>
                      <?php
                    }else{
                      ?>
                  <div class="description"><?= $name ?> • <?= $referral_transaction_time?></div>
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
        <div class="referral-card">
          <div class="mini-referral-logo" id="prenatal-logo">
            <img src="images/person.png" alt="Logo" class="logo">
          </div>
            <div class="info">
                <div class="name">Gigaquit RHU</div>
                <div class="description">700 Total Prenatal</div>
            </div>
            <button class="confirm-button" id="viewbtn">View</button>
        </div>
        <div class="referral-card">
          <div class="mini-referral-logo" id="prenatal-logo">
          <img src="images/person.png" alt="Logo" class="logo">
          </div>
            <div class="info">
                <div class="name">Claver RHU</div>
                <div class="description">700 Total Prenatal</div>
            </div>
            <button class="confirm-button" id="viewbtn">View</button>
        </div>
        <div class="referral-card">
          <div class="mini-referral-logo" id="prenatal-logo">
          <img src="images/person.png" alt="Logo" class="logo">
          </div>
            <div class="info">
                <div class="name">Miranda</div>
                <div class="description">700 Total Prenatal</div>
            </div>
            <button class="confirm-button" id="viewbtn">View</button>
        </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
    <div class="head">
          <h3 class="left-heading mb-4">Messages</h3>
          <a class="see_all" href="#" role="button">View All</a>
        </div>
      <div class="home-feed">
        <div class="yourDivClass">
        <div class="referral-card">
          <div class="mini-referral-logo" id="message-logo">
            <img src="images/person.png" alt="Logo" class="logo">
          </div>
            <div class="info">
                <div class="name">Jezmahboi</div>
                <div class="description">Ambobo mo tanga • 2:35 PM</div>
            </div>
            <button class="confirm-button" id="viewbtn">View</button>
        </div>
        <div class="referral-card">
          <div class="mini-referral-logo" id="message-logo">
          <img src="images/person.png" alt="Logo" class="logo">
          </div>
            <div class="info">
                <div class="name">Ronald Bautista</div>
                <div class="description">I am gay huhu • 5:15 AM</div>
            </div>
            <button class="confirm-button" id="viewbtn">View</button>
        </div>
        <div class="referral-card">
          <div class="mini-referral-logo" id="message-logo">
          <img src="images/person.png" alt="Logo" class="logo">
          </div>
            <div class="info">
                <div class="name">SJ</div>
                <div class="description">nah ambot • 3:40 AM</div>
            </div>
            <button class="confirm-button" id="viewbtn">View</button>
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

    <!-- Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h3>STAFF LOGIN</h3>
      </div>
      <div class="modal-body" id="modalContent">
      <div class="alert alert-warning d-none" id="errorMessage"></div>
      <form id="loginStaff">
    <div class="mb-3">
        <input type="text" class="form-control" name="uid" placeholder="Facility Name/ID">
    </div>
    <div class="mb-3">
        <input type="password" class="form-control" name="pwd" placeholder="Password">
    </div>
    <div class="modal-footer">
        <a class="btn btn2" href="includes/fclt_logout.inc.php" role="button" style="margin-right:auto">Logout Facility</a>
        <a class="btn btn1" href="signup.php" role="button">Sign Up</a>
        <button type="submit" class="btn btn2">Login</button>
    </div>
</form>

      </div>
    </div>
  </div>
</div>



<?php
include_once 'footer.php'
?>