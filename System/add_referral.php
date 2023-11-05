<?php
include_once 'header.php';

include_once 'includes/referral_functions.inc.php';

?>



         <!-- Card Content  -->
<div class="firstSec" id="fieldForm">
    <div class="head">
    <h2 class="mb-4">Create Referral</h2>
    <a href="index.php"><button type="button" class="right-button btn">Back</button></a>
    </div>

    <div class="card text-dark bg-light mb-3">
  <div class="card-header">Fill the fields</div>
  <div class="card-body">
  <form action="process_form.php" method="post">
 <div class="row">
  <?php 
  $query = "SHOW COLUMNS FROM referral_forms";
  $query_run = mysqli_query($conn, $query);

  if(mysqli_num_rows($query_run) > 0){
    foreach($query_run as $field){
      if ($field['Field'] !== 'id') {
  ?>
  <div class="col-sm-12 col-md-6 col-lg-3">
    <label for="<?= $field['Field'] ?>"><?=  $field['Field'] ?></label>
    <input type="text" name="<?= $field['Field'] ?>" id="<?= $field['Field'] ?>" class="form-control">
  </div>
  <?php 
      }
    }
  }

  ?>
    </div>


  </div>
  <div class="card-footer">
  <button type="submit" name="submit_form" class="btn btn-primary">Submit</button>
    </div>
</div>
</form>


</div>

    </div>
</div>

    <?php
include_once 'footer.php'
?>