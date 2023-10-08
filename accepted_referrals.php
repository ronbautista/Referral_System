<?php
include_once 'header.php';
include_once 'includes/referral_functions.inc.php';

// Call the function and fetch all the referrals
$displayreferrals = displayAllReferralTransaction();
$getreferral = getAllReferrals();
?>
<div class="feed">
<div class="head" id="reload">
<h2 class="left-heading mb-4">Accepted Referrals</h2>
</div>


<div id="yourDivId" class="yourDivClass">
<div class="table-responsive">
    <table class="table equal-width-table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Facility</th>
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
        foreach ($displayreferrals as $displayreferral) {
          $count++;
          $rffrl_id = $displayreferral['rfrrl_id'];
          $fclt_name = $displayreferral['fclt_name'];
          $Name = $displayreferral['Name'];
          $date = $displayreferral['date'];
          $time = $displayreferral['time'];
          $status = $displayreferral['status'];

          echo '<tr>
            <th scope="row">' . $count . '</th>
            <td>' . $fclt_name . '</td>
            <td>' . $Name . '</td>
            <td class="action-column" id="'.$status.'-column"><p>' . $status . '</p></td>
            <td>' . $date . ' • ' . $time . '</td>
            <td class="action-column">
            <button id="icon-btn" type="button" value="'.$rffrl_id.'" class="viewRecord"><i class="fi fi-rr-eye"></i></button>
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
                        <input type="text" disabled readonly name="<?= $field ?>" id="<?= $field ?>" class="form-control" value="<?= $value ?>">
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
              <button type="button" class="btn btn1" id="restore_button">Restore Referral</button>
              </div>
    </form>
        </div>
        </div>
        </div>

<?php
include_once 'footer.php'
?>