<?php
include_once 'header.php';
include_once 'includes/referral_functions.inc.php';

// Call the function and fetch all the referrals
$displayreferrals = displayAllReferralsPending();
$getreferral = getAllReferrals();
?>
<div class="feed">
<div class="head" id="reload">
<h2 class="left-heading mb-4">New Referrals</h2>
<?php 
if (isset($_SESSION["first_account"])) {
    if ($_SESSION["facility"] == 'Birthing Home') {
        echo '<button type="button" class="right-button btn " data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bx bx-plus"></i>Create Referral</button>';
    }
}
?>
</div>

<div id="yourDivId" class="yourDivClass">
      <?php
      $count=0;
              // Loop through the referrals and display each patient in a table row
              foreach ($displayreferrals as  $displayreferrals) {
                  $rffrl_id = $displayreferrals['rfrrl_id'];
                  $fclt_name = $displayreferrals['fclt_name'];
                  $Name = $displayreferrals['Name'];

        echo '<div class="card border-success mb-3 shadow-sm mb-5 bg-white rounded">
        <div class="card-header bg-transparent border-success">From: ' .$fclt_name. ' </div>
        <div class="card-body text-success">
        <h5 class="card-title">Name: ' .$Name.'</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
        </div>
        <div class="card-footer bg-transparent border-success">
        <button type="button" value="'.$rffrl_id.'" class="viewRecord btn btn-outline-success">View</button></div>
      </div>';
      $count++;
        }
        if($count==0){
          echo"no records found";
        }
      
      ?>
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
        <input type="text" hidden name="rffrl_id" id="rffrl_id" class="form-control">
        <?php 
          $query = "SELECT * FROM referral_format";
          $query_run = mysqli_query($conn, $query);

          if (mysqli_num_rows($query_run) > 0) {
              foreach ($query_run as $field) {
                  $fieldNameLabel = str_replace('_', ' ', $field['field_name']);
          ?>
                  <div class="col-sm-12 col-md-6 col-lg-3">
                      <label for="<?= $field['field_name'] ?>"><?= $fieldNameLabel ?></label>
                      <input type="text" disabled readonly name="<?= $field['field_name'] ?>" id="<?= $field['field_name'] ?>" class="form-control">
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