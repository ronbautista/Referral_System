<?php
include_once 'header.php';
include_once 'includes/referral_functions.inc.php';

// Call the function and fetch all the referrals
$displayreferrals = myReferrals() ;
$getreferral = getAllReferrals();
$referrals_audit = referrals_audit();
$referral_transactions = referral_transactions();
?>
<div class="feed">
<div class="head" id="reload">
<h2 class="mb-4">Your Referrals</h2>
<?php 
if (isset($_SESSION["first_account"])) {
    if ($_SESSION["facility"] == 'Birthing Home' || $_SESSION["facility"] == 'Provincial Hospital') {
        echo '
        <div class = "buttons">
        <button type="button" class="right-button btn btn-primary " data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fi fi-br-plus"></i> Create Referral</button>
        </div>';
    }
}
?>
</div>


<div id="yourDivId" class="yourDivClass">
<div class="table-responsive">
    <table class="table equal-width-table">
      <thead>
        <tr>
          <th scope="col">Count</th>
          <th scope="col">Referred Hospital</th>
          <th scope="col">Name</th>
          <th scope="col" class="action-column">Status</th>
          <th scope="col">Date • Time</th>
          <th scope="col" class="action-column">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $count = 0;
        // Loop through the referrals and display each patient in a table row
        foreach ($displayreferrals as $displayreferrals) {
          $count++;
          $rffrl_id = $displayreferrals['rfrrl_id'];
          $rfrrd_hospital = $displayreferrals['fclt_name'];
          $Name = $displayreferrals['Name'];
          $status = $displayreferrals['status'];
          $date = $displayreferrals['date'];
          $time = $displayreferrals['time'];

          echo '<tr>
          <th scope="row">' . $count . '</th>
          <td>' . $rfrrd_hospital . '</td>
          <td>' . $Name . '</td>
          <td class="action-column" id="'.$status.'-column"><p>' . $status . '</p></td>
          <td>' . $date . ' • ' . $time . '</td>
          <td class="action-column">
          <button id="icon-btn" type="button" value="'.$rffrl_id.'" class="viewMyRecord"><i class="fi fi-rr-eye"></i></button>
          </td>
        </tr>';

        }
        if ($count == 0) {
          echo "no records found";
        }
        ?>
      </tbody>
    </table>
  </div>

  </div>
  </div>

    
    <!-- VIEW REFERRAL  -->
    <div class="modal fade" id="referralModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content new_modal">
      <div class="modal-header">
        <h5 class="modal-title">To: <span id="fclt_name"></span></h5>
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
                <input type="hidden" name="rffrl_id" id="rffrl_id" class="form-control">
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
                          <input type="text" readonly name="<?= $field ?>" id="<?= $field ?>" value="<?= $field ?>" class="form-control">
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
            <div class="referral-audit d-none">
          <div class="mb-3">
            <h5>Referral Audit</h5>
            <div id="referral_transactions"></div>
          </div>
        </div>
        <button type="button" data-bs-dismiss="modal" class="btn close">Close</button>
    </div>
    </form>
        </div>
        </div>
        </div>

   
<!-- CREATE REFERRAL -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content new_modal">
      <div class="modal-header">
      <h2 class="modal-title" id="staticBackdropLabel">Create Referral</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="upperBtn">
        <ul class="nav nav-tabs" id="myTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="referral-tab" data-bs-toggle="tab" href="#referral" role="tab" aria-controls="referral" aria-selected="true">Referral Record</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="records-tab" data-bs-toggle="tab" href="#records" role="tab" aria-controls="records" aria-selected="false">Other Records</a>
          </li>
        </ul>
      </div>
      <div class="modal-body">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="referral" role="tabpanel" aria-labelledby="referral-tab">
            <div class="alert alert-danger d-none" id="referralError"></div>
          <form id="createReferral">
            <div class="row">

              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Name</label>
              <input type="text" name="name" id="name" class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Age</label>
              <input type="text" name="age" id="age" class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Sex</label>
              <input type="text" name="sex" id="sex" class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Birth Date</label>
              <input type="date" name="bdate" id="bdate" class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Sex</label>
              <input type="text" name="sex" id="sex" class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Address</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Admitting Dx</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Rtpcr</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Antigen</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Clinical ssx of covid</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Exposure to covid</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Temp</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>HR</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Resp</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Bp</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>O2sat</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>O2aided</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Procedures needed</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>FH</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>IE</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>FHT</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>LMP</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>EDC</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>AOG</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>UTZ</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>UTZ AOG</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>EDD</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Enterpretation</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Diagnostic test</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>

              <div class="col-sm-12 col-md-6 col-lg-3">
                <label>Select Refer Hospital</label>
                <select class="form-select" name="referred_hospital">
                <option value="NULL"></option>
                <?php 
                $query = "SELECT * FROM facilities WHERE fclt_id != '" . $_SESSION["id"] . "'";
                  $query_run = mysqli_query($conn, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                    while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                    <option value="<?= $row['fclt_id'] ?>"><?= $row['fclt_name'] ?></option>
                <?php
                    }
                  }
                ?>
              </select>
              </div>
      </div>
          </div>
          <div class="tab-pane fade" id="records" role="tabpanel" aria-labelledby="records-tab">
          <div id="draggableDiv" class="draggable" draggable="true">Drag records here!</div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn close" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php
include_once 'footer.php'
?>