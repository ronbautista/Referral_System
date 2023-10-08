<?php
include_once 'header.php';

include_once 'includes/prenatal_functions.inc.php';

// Call the function and fetch all the referrals
$patients = getAllPatients();
?>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="staticBackdropLabel">Patient's Information</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-theme="custom"></button>
      </div>
      <div class="modal-body">
<form id="addPatient">
<div class="alert alert-warning d-none" id="errorMessage"></div>
  <div class="mb-3">
    <input class="form-control" type="text" name="fname" placeholder="First Name">
  </div>
  <div class="mb-3">
    <input class="form-control" type="text" name="mname" placeholder="Middle Name">
  </div>
  <div class="mb-3">
    <input class="form-control" type="text" name="lname" placeholder="last Name">
  </div>
  <div class="mb-3">
    <input class="form-control" type="tex" name="contactNum" placeholder="Contact Number">
  </div>
  <div class="mb-3">
    <input class="form-control" type="tex" name="address" placeholder="Address">
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn1" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn2" name="submit">Add Prenatal</button>
      </div>
</form>
    </div>
  </div>
</div>


<div class="feed">
<div class="head">
<h2 class="left-heading mb-4">Prenatal List</h2>
<button type="button" class="right-button btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Prenatal</button>

</div>
         <!-- Card Content  -->

  <table class="table table-success table-striped" id="table" style="text-align: center">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Full Name</th>
      <th scope="col">Adress</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
        <?php
        // Loop through the referrals and display each patient in a table row
        foreach ($patients as $key => $patients) {
            $id = $patients['id'];
            $fname = $patients['fname'];
            $mname = $patients['mname'];
            $lname = $patients['lname'];
            $address = $patients['address'];

            echo "<tr>";
            echo "<th scope='row'>" . ($key + 1) . "</th>";
            echo "<td>$lname, $fname $mname</td>";
            echo "<td>$address</td>";
            echo '<td><a class="btn btn-primary" href="add_prenatal.php?id='.$id.'" role="button">View</a></td>';
            // Add more table cells for other patient details if needed
            echo "</tr>";
        }
        ?>
            </tbody>
</table>
      </div>


    <?php
include_once 'footer.php'
?>