<?php
include_once 'header.php';
include_once 'includes/referral_functions.inc.php';

// Call the function and fetch all the referrals
$ProvHos = ProvHosPendingReferrals();
$Hospital = HospitalPendingReferrals();
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
$count = 0;

if ($_SESSION["facility"] == 'Hospital') {
    $dataArray = $Hospital;
} elseif ($_SESSION["facility"] == 'Provincial Hospital') {
    $dataArray = $ProvHos;
} else {
    $dataArray = array(); // Handle other cases or provide a default value
}

// Loop through the referrals and display each patient in a table row
foreach ($dataArray as $data) {
    $rffrl_id = $data['rfrrl_id'];
    $fclt_name = $data['fclt_name'];
    $Name = $data['Name'];

    echo '<div class="card border-success mb-3 shadow-sm mb-5 bg-white rounded">
        <div class="card-header bg-transparent border-success">From: ' . $fclt_name . ' </div>
        <div class="card-body text-success">
            <h5 class="card-title">Name: ' . $Name . '</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the cards content.</p>
        </div>
        <div class="card-footer bg-transparent border-success">
            <button type="button" value="' . $rffrl_id . '" class="viewRecord btn btn-outline-success">View</button>
        </div>
    </div>';
    $count++;
}

if ($count == 0) {
    echo "no records found";
}
?>
</div>
  
<!-- Form Content -->
<div class="modal fade" id="referralModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content new_modal">
      <div class="modal-header">
        <h5 class="modal-title">From: <span id="fclt_name"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="upperBtn">
        <ul class="nav nav-tabs" id="myTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Referral Record</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Other Records</a>
          </li>
        </ul>
      </div>
      <div class="modal-body">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form id="referral_form">
              <div class="row">
                <input type="text" hidden name="rffrl_id" id="rffrl_id" class="form-control">
                <?php
                $query = "SELECT * FROM referral_forms";
                $query_run = mysqli_query($conn, $query);

                if (mysqli_num_rows($query_run) > 0) {
                  $row = mysqli_fetch_assoc($query_run);

                  foreach ($row as $field => $value) {
                    if ($field !== 'id') {
                      $fieldNameLabel = str_replace('_', ' ', $field);
                ?>
                      <div class="col-sm-12 col-md-6 col-lg-3">
                        <label for="<?= $field ?>"><?= $fieldNameLabel ?></label>
                        <input type="text" readonly name="<?= $field ?>" id="<?= $field ?>" class="form-control" value="<?= $value ?>">
                      </div>
                <?php
                    }
                  }
                }
                ?>
              </div>
      
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            Profile content
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="referral-reason">
          <div class="mb-3">
            <h5>Decline Reason</h5>
            <div class="alert alert-danger d-none" id="errorMessage"></div>
            <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
          </div>
        </div>
        </form>
        <div class="referral-buttons">
          <button type="button" class="btn close" id="decline_referral">Decline Referral</button>
          <button type="button" class="btn close" id="cancel_button">Cancel</button>
          <button type="button" class="btn btn-primary" id="decline_button">Submit Decline</button>
          <button type="button" class="btn btn-primary" id="accept_button">Accept Referral</button>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
include_once 'footer.php'
?>