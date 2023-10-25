<?php
include_once 'header.php';

include_once 'includes/referral_functions.inc.php';
include_once 'includes/prenatal_functions.inc.php';

// Call the function and fetch all the referrals
$referral_format = referral_format();
$referrals = referrals();
$prenatal_format = prenatal_format();
?>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="staticBackdropLabel">Add field</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-theme="custom"></button>
      </div>
<form id="addField">
      <div class="modal-body">
        <div class="alert alert-warning d-none" id="errorMessage"></div>
    <div class="mb-3">
        <input class="form-control" type="text" name="field_name" placeholder="Field Name">
    </div>
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn1" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn2">Add</button>
      </div>
    </div>
    </form>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="prenatalModalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="staticBackdropLabel">Add prenatal field</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-theme="custom"></button>
      </div>
<form id="addPrenatalField">
      <div class="modal-body">
        <div class="alert alert-warning d-none" id="errorMessage"></div>
    <div class="mb-3">
        <input class="form-control" type="text" name="field_name" placeholder="Field Name">
    </div>
 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn1" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn2">Add</button>
      </div>
    </div>
    </form>
  </div>
</div>

<h2 class="left-heading mb-4">Settings</h2>
<div class="feed">
<div class="head">
<h4 class="left-heading mb-4">Referral input fields</h4>
<button type="button" class="right-button btn " data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fi fi-br-plus"></i> Add</button>

</div>
         <!-- Card Content  -->
  <div class="card">
  <h6 class="card-header">Input Fields</h6>
  <div class="card-body">
  <table id="fieldTable" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th scope="col">Field Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($referral_format as $referral) {
      if ($referral['field_name'] !== 'id') {
          $fieldName = str_replace('_', ' ', $referral['field_name']); // Replace underscores with spaces
          ?>
          <tr>
              <td><?= $fieldName ?></td>
              <td>
                  <button type="button" value="<?= $referral['field_name']; ?>" class="deleteField btn btn-outline-danger">Delete</button>
              </td>
          </tr>
          <?php
      }
    }
    ?>
  </tbody>
</table>

  </div>
</div>
</div>

         <!-- Card Content  -->
  <div class="feed">
  <h4 class="left-heading mb-4">Referral forms</h4>
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
        // Loop through the referrals and display each patient in a table row
        foreach ($referrals as $referrals) {
            ?>
            <tr>
            <td><?=$referrals['id']?></td>
            <td><?=$referrals['Name']?></td>
            <td><?=$referrals['fclt_name']?></td>
            <td>
            <button type="button" value="<?=$referrals['id'];?>" class="deleteReferral btn btn-outline-danger">Delete</button>
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

<div class="feed">
<div class="head">
<h4 class="left-heading mb-4">Prenatal input fields</h4>
<button type="button" class="right-button btn " data-bs-toggle="modal" data-bs-target="#prenatalModalAdd"><i class="fi fi-br-plus"></i> Add</button>

</div>
         <!-- Card Content  -->
  <div class="card">
  <h6 class="card-header">Input Fields</h6>
  <div class="card-body">
  <table id="prenatalFieldTable" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th scope="col">Field Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    foreach ($prenatal_format as $referral) {
        if ($referral['Field'] !== 'patients_details_id' && $referral['Field'] !== 'patients_id') {
            $fieldName = str_replace('_', ' ', $referral['Field']); // Replace underscores with spaces
            $fieldName = ucfirst($fieldName); // Make the first letter uppercase
            ?>
            <tr>
                <td><?= $fieldName ?></td>
                <td>
                    <button type="button" value="<?= $referral['Field']; ?>" class="deletePrenatalField btn btn-outline-danger">Delete</button>
                </td>
            </tr>
            <?php
        }
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