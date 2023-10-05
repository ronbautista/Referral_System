<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<?php
include_once 'header.php';

include 'db_conn.php';

if (isset($_GET['id'])) {
  $patientID = $_GET['id'];

  // Retrieve patient information from the database using the provided ID
  $sql = "SELECT * FROM patients LEFT JOIN patients_details ON patients.id = patients_details.patients_id WHERE patients.id = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
      // Handle the error appropriately (e.g., show an error message)
      die("Statement preparation failed: " . mysqli_error($conn));
  }

  mysqli_stmt_bind_param($stmt, "i", $patientID);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);

  // Check if a patient is found with the provided ID
  if ($row = mysqli_fetch_assoc($result)) {
      // Display patient information here
      echo "Patient ID: " . $row['id'] . "<br>";
      // You can output other patient information as needed
  } else {
      // Handle the case when no patient is found with the provided ID
      echo "Patient not found.";
  }

  mysqli_stmt_close($stmt);
} else {
  // Handle the case when no ID is provided in the URL
  echo "Invalid patient ID.";
}

?>
<!-- Card Content -->
<div class="firstSec">
    <div class="head">
        <?php
        if ($row) {
            echo '<h2 class="mb-4"> Patient Name: ' . $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname'] . '</h2> ';
        }
        ?>
        <a href="prenatal.php"><button type="button" class="right-button btn">Back</button></a>
    </div>

    <div class="card">
        <div class="card-header">
            Fill the Fields
        </div>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <form id="patients_details">
                <input type="hidden" name="patient_id" value="<?php echo $patientID; ?>">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <label for="inputEmail4">Petsa ng unang check-up</label>
                        <input type="text" class="form-control" id="inputEmail4"
                            value="<?php echo ($row) ? $row['petsa_unang_checkup'] : ''; ?>"
                            name="petsa_unang_checkup">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <label for="inputEmail4">Petsa ng unang check-up</label>
                        <input type="text" class="form-control" id="inputEmail4"
                            value="<?php echo ($row) ? $row['edad'] : ''; ?>"
                            name="edad">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <label for="inputEmail4">Petsa ng unang check-up</label>
                        <input type="text" class="form-control" id="inputEmail4"
                            value="<?php echo ($row) ? $row['timbang'] : ''; ?>"
                            name="timbang">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <label for="inputEmail4">Petsa ng unang check-up</label>
                        <input type="text" class="form-control" id="inputEmail4"
                            value="<?php echo ($row) ? $row['taas'] : ''; ?>"
                            name="taas">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <label for="inputEmail4">Petsa ng unang check-up</label>
                        <input type="text" class="form-control" id="inputEmail4"
                            value="<?php echo ($row) ? $row['kalagayan_kalusugan'] : ''; ?>"
                            name="kalagayan_kalusugan">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <label for="inputEmail4">Petsa ng unang check-up</label>
                        <input type="text" class="form-control" id="inputEmail4"
                            value="<?php echo ($row) ? $row['petsa_huling_regla'] : ''; ?>"
                            name="petsa_huling_regla">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <label for="inputEmail4">Petsa ng unang check-up</label>
                        <input type="text" class="form-control" id="inputEmail4"
                            value="<?php echo ($row) ? $row['kailan_manganganak'] : ''; ?>"
                            name="kailan_manganganak">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <label for="inputEmail4">Petsa ng unang check-up</label>
                        <input type="text" class="form-control" id="inputEmail4"
                            value="<?php echo ($row) ? $row['ilang_pagbubuntis'] : ''; ?>"
                            name="ilang_pagbubuntis">
                    </div>
    </div>
    <button type="submit" class="btn btn-primary" name="submit" style="margin-top:20px">Submit</button>
    </form>
  </div>
</div>


<div class="secodSec">
<h3>Karanasan sa mga Naunang Pagbubuntis at Panganganak</h3>
<div class="card">
<div class="card-header">Fill the Fields</div>
  <div class="card-body">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Column 1</th>
        <th scope="col">Column 2</th>
        <th scope="col">1</th>
        <th scope="col">2</th>
        <th scope="col">3</th>
        <th scope="col">4</th>
        <th scope="col">5</th>
        <th scope="col">6</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <th>Date of delivery:</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th rowspan="2">Type of delivery:</th>
        <td>Normal(check) or</td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
      </tr>
      <tr>
        <td>Caesarean Delivery(C/S)</td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
      </tr>
      <tr>
        <th rowspan="3">Birth Outcome:</th>
        <td>Alive</td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
      </tr>
      <tr>
        <td>Misscarriage</td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
      </tr>
      <tr>
        <td>Stillbirth</td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
      </tr>
      <tr>
        <th rowspan="3">Number of child/children delivered:</th>
        <td>Single</td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
      </tr>
      <tr>
        <td>Twins</td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
      </tr>
      <tr>
        <td>Multiple Birth (No.)</td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
      </tr>
      <tr>
        <th rowspan="3">Pregnancy-related Conditions/Compications:</th>
        <td>Pregnancy Induced Hypertension (PIH) (Y/N)</td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
      </tr>
      <tr>
        <td>Preeclamsia/Ecllampsia (PE/E) (Y/N)</td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
      </tr>
      <tr>
        <td>Bleeding during pregnancy or after delivery (Y/N)</td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
        <td class="text-center"><input class="custom-textbox" type="checkbox"></td>
      </tr>
    </tbody>
  </table>
  <button type="button" class="btn btn-primary">Submit</button>
  </div>
</div>
</div>
</div>

   

<div class="thirdSec" id="thirdSec">
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <ul class="nav nav-tabs card-header-tabs button-container-left">
                <li class="nav-item">
                    <a class="nav-link active button" aria-current="true" role="button" data-tab="first_trimester">First Trimester</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link button" aria-current="false" role="button" data-tab="second_trimester">Second Trimester</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link button" aria-current="false" role="button" data-tab="third_trimester">Third Trimester</a>
                </li>
            </ul>
            <ul class="nav nav-tabs card-header-tabs second-nav-tabs button-container-right">
                <li class="nav-item">
                    <a class="nav-link active button" aria-current="true" role="button" data-tab="first_checkup">First Check-up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link button" aria-current="false" role="button" data-tab="second_checkup">Second Check-up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link button" aria-current="false" role="button" data-tab="third_checkup">Third Check-up</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active" id="contenttab">
                 <h5 class="card-title">Content Tab</h5>
                 <div id="formContainer">
            <!-- The form generated by JavaScript will be inserted here -->
                </div>
            </div>
        </div>
    </div>
</div>

    </div>



    <?php
include_once 'footer.php'
?>