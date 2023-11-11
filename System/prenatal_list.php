<?php
include_once 'header.php';

include_once 'includes/prenatal_functions.inc.php';

// Call the function and fetch all the referrals
$patients = getAllPatients();
?>

<div class="referred-prenatal d-flex">
    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">For Referral</div>
        <div class="card-body">
            <h5 class="card-title">Gigaquit RHU</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>
    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Header</div>
        <div class="card-body">
            <h5 class="card-title">Primary card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>
</div>

<div class="feed">
<div class="head">
<h2 class="left-heading mb-4">Prenatal List</h2>
<button type="button" class="right-button btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fi fi-br-plus"></i> Add Prenatal</button>

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
            echo '<td>
            <a class="btn btn-primary" href="add_prenatal.php?id='.$id.'" role="button">View</a>
            <button type="button" class="btn btn-primary" value="'.$id.'" id= "deletePatient">Delete</button>
            </td>';
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