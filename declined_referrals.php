<?php
include_once 'header.php';
include_once 'includes/referral_functions.inc.php';

// Call the function and fetch all the referrals
$displayreferrals = displayAllReferralsAccepted();
$getreferral = getAllReferrals();
?>
<div class="feed">
<div class="head" id="reload">
<h2 class="left-heading mb-4">Declined Referrals</h2>
</div>


<div id="yourDivId" class="yourDivClass">
      <?php
      $count=0;
              // Loop through the referrals and display each patient in a table row
              foreach ($displayreferrals as  $displayreferrals) {
                  $rffrl_id = $displayreferrals['rfrrl_id'];
                  $fclt_name = $displayreferrals['fclt_name'];
                  $Name = $displayreferrals['Name'];
                  $Sex = $displayreferrals['Sex'];

        echo '<div class="card border-success mb-3">
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
      
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
    <div class="toast-header">
      <strong class="me-auto">Notification</strong>
      <small>Just Now</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
    <p class="toast-message">Hello, world! This is a toast message.</p> 
    <div class="mt-2 pt-2 border-top">
    <a class="btn btn-primary btn-sm" href="accepted_referrals.php" role="button">View</a>
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
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
              <button type="button" class="btn btn1" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn2" id="decline_button">Decline Referral</button>
              </div>
    </form>
        </div>
        </div>
        </div>

<?php
include_once 'footer.php'
?>