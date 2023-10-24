<?php
include_once 'header.php';
include_once 'includes/referral_functions.inc.php';

// Call the function and fetch all the referrals
$displayreferrals = myReferrals() ;
$getreferral = getAllReferrals();
?>
<div class="feed">
<div class="head" id="reload">
<h2 class="left-heading mb-4">Your Referrals</h2>
<?php 
if (isset($_SESSION["first_account"])) {
    if ($_SESSION["facility"] == 'Birthing Home' || $_SESSION["facility"] == 'Provincial Hospital') {
        echo '<button type="button" class="right-button btn " data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fi fi-br-plus"></i> Create Referral</button>';
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

    
    <!-- Form Content  -->
    <div class="modal fade" id="referralModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Referred Hospital: <span id="fclt_name"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-theme="custom"></button>
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
        <button type="button" data-bs-dismiss="modal" class="btn btn2">Close</button>
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
    <div class="alert alert-warning d-none" id="errorMessage"></div>
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
      <div class="col-sm-12 col-md-6 col-lg-3">
      <label>Select Refer Hospital</label>
      <select class="form-select" name="referred_hospital">
      <option value="NULL"></option>
      <?php 
        $query = "SELECT * FROM facilities";
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
    <div class="modal-footer">
    <button type="button" class="btn btn1" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn2">Create</button>
    </div>
    </div>
    </form>
    </div>
    </div>

<?php
include_once 'footer.php'
?>