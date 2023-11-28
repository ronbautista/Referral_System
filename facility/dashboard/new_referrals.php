<?php
include_once 'header.php';
include_once 'includes/referral_functions.inc.php';

// Call the function and fetch all the referrals
$ProvHos = ProvHosPendingReferrals();
$Hospital = HospitalPendingReferrals();
$getreferral = getAllReferrals();
?>

<div class="container-fuild">
  <div class="row gx-4">
    <div class="col-lg-6 col-md-12 mb-4">
    <div class="feed">
    <div class="head" id="reload">
        <h3 class="left-heading mb-4">New Referrals</h3>
    </div>
    <div class="newReferrals">
        <?php
        $count = 0;

        if ($_SESSION["fclttype"] == 'Hospital') {
            $dataArray = $Hospital;
        } elseif ($_SESSION["fclttype"] == 'Provincial Hospital') {
            $dataArray = $ProvHos;
        } else {
            $dataArray = array(); // Handle other cases or provide a default value
        }

        // Loop through the referrals and display each patient in a table row
        foreach ($dataArray as $data) {
            $rffrl_id = $data['rfrrl_id'];
            $fclt_name = $data['fclt_name'];
            $Name = $data['name'];
            $time = $data['time'];
            $date = $data['date'];
            $count++;
            ?>
            
            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-5" style="padding: 15px;">
                  <img src="../../assets/facility.jpg" class="img-fluid rounded" alt="...">
                </div>
                <div class="col-md-7">
                  <div class="card-body">
                    <h5 class="card-title">From: <?php echo $fclt_name ?></h5>
                    <p class="card-text mb-1"> <span class="fw-bold">Name: </span><?php echo $Name ?></p>
                    <p class="card-text mb-1"> <span class="fw-bold">Date: </span><?php echo $date ?></p>
                    <p class="card-text mb-2"> <span class="fw-bold">Time: </span><?php echo $time ?></p>
                    <p class="card-text mb-1"><button type="button" value="<?php echo $rffrl_id ?>" class="viewRecord btn btn-primary">View Referral</button></p>
                  </div>
                </div>
              </div>
            </div>
            <?php
        }

        if ($count == 0) {
            echo "no records found";
        }
        ?>
        </div>
    </div>
    </div>
<div class="col-lg-6 col-md-12 mb-4">
    <div class="feed">
        <div class="head" id="reload">
            <h3 class="left-heading mb-4">New Arrival</h3>
        </div>
        <div id="yourDivId" class="yourDivClass">
        <?php
        $count = 0;

        if ($_SESSION["fclttype"] == 'Hospital') {
            $dataArray = $Hospital;
        } elseif ($_SESSION["fclttype"] == 'Provincial Hospital') {
            $dataArray = $ProvHos;
        } else {
            $dataArray = array(); // Handle other cases or provide a default value
        }

        // Loop through the referrals and display each patient in a table row
        foreach ($dataArray as $data) {
            $rffrl_id = $data['rfrrl_id'];
            $fclt_name = $data['fclt_name'];
            $Name = $data['name'];
            $time = $data['time'];
            $date = $data['date'];
            $count++;
            ?>
            
            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-5" style="padding: 15px;">
                  <img src="../../assets/facility.jpg" class="img-fluid rounded" alt="...">
                </div>
                <div class="col-md-7">
                  <div class="card-body">
                    <h5 class="card-title">From: <?php echo $fclt_name ?></h5>
                    <p class="card-text mb-1"> <span class="fw-bold">Name: </span><?php echo $Name ?></p>
                    <p class="card-text mb-1"> <span class="fw-bold">Date: </span><?php echo $date ?></p>
                    <p class="card-text mb-2"> <span class="fw-bold">Time: </span><?php echo $time ?></p>
                    <p class="card-text mb-1"><a href="#" class="btn btn-primary">View Referral</a></p>
                  </div>
                </div>
              </div>
            </div>
            <?php
        }

        if ($count == 0) {
            echo "no records found";
        }
        ?>
        </div>
      </div>
    </div>
  </div>
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
              <input type="hidden" name="rffrl_id" id="rffrl_id" class="form-control">
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Name</label>
              <input type="text" name="name" id="name" class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Age</label>
              <input type="text" name="age" id="age" class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Sex</label>
              <input type="text" name="sex" id="sex" class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Birth Date</label>
              <input type="date" name="bdate" id="bdate" class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Address</label>
              <input type="text" name="address" id="address " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Admitting Dx</label>
              <input type="text" name="admittingDx" id="admittingDx " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Rtpcr</label>
              <input type="text" name="rtpcr" id="rtpcr " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Antigen</label>
              <input type="text" name="antigen" id="antigen " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Clinical ssx of covid</label>
              <input type="text" name="clinicalssx" id="clinicalssx " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Exposure to covid</label>
              <input type="text" name="exposure" id="exposure " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Temp</label>
              <input type="text" name="temp" id="temp " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>HR</label>
              <input type="text" name="hr" id="hr " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Resp</label>
              <input type="text" name="resp" id="resp " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Bp</label>
              <input type="text" name="bp" id="bp " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>O2sat</label>
              <input type="text" name="02sat" id="02sat " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>O2aided</label>
              <input type="text" name="02aided" id="02aided " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Procedures needed</label>
              <input type="text" name="procedure" id="procedure " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>FH</label>
              <input type="text" name="fh" id="fh " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>IE</label>
              <input type="text" name="ie" id="ie " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>FHT</label>
              <input type="text" name="fht" id="fht " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>LMP</label>
              <input type="text" name="lmp" id="lmp " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>EDC</label>
              <input type="text" name="edc" id="edc " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>AOG</label>
              <input type="text" name="aog" id="aog " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>UTZ</label>
              <input type="text" name="utz" id="utz " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>UTZ AOG</label>
              <input type="text" name="utzAog" id="utzAog " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>EDD</label>
              <input type="text" name="edd" id="edd " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Enterpretation</label>
              <input type="text" name="enterpretation" id="enterpretation " class="form-control" readonly>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
              <label>Diagnostic test</label>
              <input type="text" name="diagnostic" id="diagnostic " class="form-control" readonly>
              </div>
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
          <button type="button" class="btn btn-primary" id="decline_button">
          <span class="decline-loading d-none"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Declining Referral...</span>
          <span class="decline-span">Decline Referral</span>
        </button>
          <button type="button" class="btn btn-primary" id="accept_button">
          <span class="accept-loading d-none"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Accepting Referral...</span>
          <span class="accept-span">Accept Referral</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    var fclt_id = "<?php echo $fclt_id ?>";
</script>

<script src="js/ajaxNewReferrals.js"></script>

<?php
include_once 'footer.php'
?>