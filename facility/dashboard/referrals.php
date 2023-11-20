<?php
include_once 'header.php';
include_once 'includes/referral_functions.inc.php';

// Call the function and fetch all the referrals
$displayreferrals = myReferrals() ;
$getreferral = getAllReferrals();
$referrals_audit = referrals_audit();
$referral_transactions = referral_transactions();
?>

<script src="js/ajaxFunctions.js"></script>
<script src="js/filter.js"></script>
<script src="js/main.js"></script>

<div class="feed">
<div class="head" id="reload">
<h2>Your Referrals</h2>
<div class="head_buttons">
<?php 
if (isset($_SESSION["facilityaccount"])) {
    if ($_SESSION["fclttype"] == 'Birthing Home' || $_SESSION["fclttype"] == 'Provincial Hospital') {
        echo '
        <div class = "buttons">
        <button type="button" class="right-button btn btn-primary " data-bs-toggle="modal" data-bs-target="#createReferralModal"><i class="fi fi-br-plus"></i> Create Referral</button>
        </div>';
    }
}
?>
</div>
</div>


<div id="yourDivId" class="yourDivClass">
 <div class="table-header">
 <div class="col-2">
  <input type="text" id="patients_name" class="form-control" placeholder="Search Name">
  </div>
  <div class="col-2">
  <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fi fi-rr-settings-sliders"></i> Filter</button>
  </div>
  <button type="button" class="btn btn-primary" id="report"><i class="fi fi-rr-upload"></i> Export</button>
 </div>
<div class="table-responsive">
    <table id="referralsTable" class="table">
      <thead class="table-light">
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
          $Name = $displayreferrals['name'];
          $status = $displayreferrals['status'];
          $date = $displayreferrals['date'];
          $time = $displayreferrals['time'];

          ?>
          <tr>
          <th scope="row"><?php echo $count  ?></th>
          <td><?php echo $rfrrd_hospital ?></td>
          <td><?php echo $Name ?></td>
          <td class="action-column" id="<?php echo $status ?>-column"><p><?php echo $status ?></p></td>
          <td><?php echo $date ?> • <?php echo $time ?></td>
          <td class="action-column">
          <button id="icon-btn" type="button" value="<?php echo $rffrl_id ?>" class="viewMyRecord"><i class="fi fi-rr-eye"></i></button>
          </td>
        </tr>
        <?php

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

  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel">Filter</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="accordion" id="accordionPanelsStayOpenExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
          Facilities
        </button>
      </h2>
      <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
        <div class="accordion-body">
          <div class="d-grid gap-2 d-md-block">
            <div class="facility">
              <input type="checkbox" class="btn-check" id="gigaquit" autocomplete="off">
              <label class="btn btn-outline-secondary btn-sm" for="gigaquit">Gigaquit</label>

              <input type="checkbox" class="btn-check" id="provencial_hospital" autocomplete="off">
              <label class="btn btn-outline-secondary btn-sm" for="provencial_hospital">Provincial Hospital</label>

              <input type="checkbox" class="btn-check" id="caraga_hospital" autocomplete="off">
              <label class="btn btn-outline-secondary btn-sm" for="caraga_hospital">Caraga Hospital</label>

              <input type="checkbox" class="btn-check" id="claver_rhu" autocomplete="off">
              <label class="btn btn-outline-secondary btn-sm" for="claver_rhu">Claver RHU</label>

              <input type="checkbox" class="btn-check" id="surigao_provencial_hospital" autocomplete="off">
              <label class="btn btn-outline-secondary btn-sm" for="surigao_provencial_hospital">Surigao Del Norte Provincial Hospital</label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
          Status
        </button>
      </h2>
      <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
        <div class="accordion-body">
          <div class="d-grid gap-2 d-md-block">
            <div class="status">
              <input type="checkbox" class="btn-check" id="Accepted" autocomplete="off">
              <label class="btn btn-outline-secondary btn-sm" for="Accepted">Accepted</label>

              <input type="checkbox" class="btn-check" id="Declined" autocomplete="off">
              <label class="btn btn-outline-secondary btn-sm" for="Declined">Declined</label>

              <input type="checkbox" class="btn-check" id="Pending" autocomplete="off">
              <label class="btn btn-outline-secondary btn-sm" for="Pending">Pending</label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true" aria-controls="panelsStayOpen-collapseThree">
          Date and Time
        </button>
      </h2>
      <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingThree">
          <div class="accordion-body">
            <div class="row">
              <div class="d-grid gap-2 d-md-block">
                <div class="date-time">
                  <input type="checkbox" class="btn-check" id="date" autocomplete="off">
                  <label class="btn btn-outline-secondary btn-sm" for="date" data-bs-toggle="collapse" data-bs-target="#date" aria-expanded="false" aria-controls="date">Date</label>

                  <input type="checkbox" class="btn-check" id="time" autocomplete="off">
                  <label class="btn btn-outline-secondary btn-sm" for="time" data-bs-toggle="collapse" data-bs-target="#time" aria-expanded="false" aria-controls="time">Time</label>
                </div>
              </div>
              <div class="collapse" id="date">
                <div class="col-9 mb-3">
                <input type="date" class="form-control form-control-sm">
                </div>
              </div>
              <div class="collapse" id="time">
                <div class="col-9 mb-3">
                <input type="time" class="form-control form-control-sm">
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
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
                <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
                <label>Name</label>
                <input type="text" id="view_name" class="form-control">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
                <label>Age</label>
                <input type="text" id="view_age" class="form-control">
                </div>
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
<div class="modal fade" id="createReferralModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="createReferralModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content new_modal">
      <div class="modal-header">
      <h2 class="modal-title" id="createReferralModalLabel">Create Referral</h2>
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

              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Name</label>
              <input type="text" name="name" id="name" class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Age</label>
              <input type="text" name="age" id="age" class="form-control">
              </div>
              <!-- 
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Sex</label>
              <input type="text" name="sex" id="sex" class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Birth Date</label>
              <input type="date" name="bdate" id="bdate" class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Sex</label>
              <input type="text" name="sex" id="sex" class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Address</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Admitting Dx</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Rtpcr</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Antigen</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Clinical ssx of covid</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Exposure to covid</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Temp</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>HR</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Resp</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Bp</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>O2sat</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>O2aided</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Procedures needed</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>FH</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>IE</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>FHT</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>LMP</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>EDC</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>AOG</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>UTZ</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>UTZ AOG</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>EDD</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Enterpretation</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
              <label>Diagnostic test</label>
              <input type="text" name="address" id="address " class="form-control">
              </div>
 -->
              <div class="col-sm-12 col-md-6 col-lg-2 mb-2">
                <label>Select Refer Hospital</label>
                <select class="form-select" name="referred_hospital" required>
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
      <button type="submit" class="btn btn-primary" id="submitButton">Create</button>
      <button class="btn btn-primary d-none" type="button" disabled id="loadingButton">
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...
      </button>

        </form>
      </div>
    </div>
  </div>
</div>

<?php
include_once 'footer.php'
?>