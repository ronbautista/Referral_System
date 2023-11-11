<?php
include_once 'header.php';

include_once 'includes/referral_functions.inc.php';
include_once 'includes/prenatal_functions.inc.php';

// Call the function and fetch all the referrals
$referral_format = referral_format();
$referrals = referrals();
$prenatal_format = prenatal_format();
?>

<!-- Modal for Referral Fields -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Referral Field</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addField">
        <div class="modal-body">
          <div class="alert alert-warning d-none" id="errorMessage"></div>
          <div class="mb-3">
            <label for="field_name">Field Name</label>
            <input class="form-control" type="text" name="field_name" id="field_name" placeholder="Enter name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<h2 class="left-heading mb-4">Settings</h2>

<!-- Referral Forms -->
<div class="feed">
  <h4 class="left-heading mb-4">Referral Forms</h4>
  <div class="card">
    <h6 class="card-header">Referrals</h6>
    <div class="card-body">
      <table id="referralsTable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Patient's Name</th>
            <th scope="col">Facility</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($referrals as $referral) {
            ?>
            <tr>
              <td><?= $referral['id'] ?></td>
              <td><?= $referral['Name'] ?></td>
              <td><?= $referral['fclt_name'] ?></td>
              <td>
                <button type="button" value="<?= $referral['id']; ?>" class="deleteReferral btn btn-outline-danger">Delete</button>
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<?php
require 'footer.php';
?>
