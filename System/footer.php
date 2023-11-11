</div>
</div>
<!-- Include Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="js/script.js"></script>

<!-- Include Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Include Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

<!-- Include Boxicons -->
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

<!-- Include Pusher JavaScript -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<!-- Include Bootstrap-datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>



<script>

// JavaScript to toggle the sidebar
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const toggleButton = document.getElementById('toggleButton');

    toggleButton.addEventListener('click', () => {
      sidebar.style.left = sidebar.style.left === '0px' ? '-250px' : '0px';
      content.style.marginLeft = content.style.marginLeft === '0px' ? '250px' : '0px';
    });

    // Check the screen width and auto-collapse the sidebar
    function checkScreenWidth() {
      if (window.innerWidth <= 1400) {
        sidebar.style.left = '-250px';
        content.style.marginLeft = '0';
      } else {
        sidebar.style.left = '0px';
        content.style.marginLeft = '250px';
      }
    }

    // Call the function on page load and window resize
    window.addEventListener('load', checkScreenWidth);
    window.addEventListener('resize', checkScreenWidth);


var secondAccountEmpty = <?php echo $secondAccountEmpty ? 'true' : 'false'; ?>;

// Check if the second account is empty and show the modal if necessary
if (secondAccountEmpty) {
    $(document).ready(function(){
        console.log("Showing modal");
        $("#loginModal").modal('show');
    });
}


function showToast(message) {
  var toast = document.getElementById("liveToast");
  var toastMessage = toast.querySelector(".toast-message");
  var formattedMessage = message.replace(/_/g, " "); // Replace underscores with spaces
  toastMessage.innerText = formattedMessage;

  var bsToast = new bootstrap.Toast(toast);
  bsToast.show();
}

$(document).on("click", "#decline_button", function () {
    var formData = new FormData($("#referral_form")[0]);
    formData.append("decline_referral", true);

    $.ajax({
        type: "POST",
        url: "new_function.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 200) {
                $("#referralModal").modal("hide");
                $("#yourDivId").load(location.href + " #yourDivId");
                restoreButtons();
                $('#reason').val('');
            }else if(res.status == 422){
              $("#errorMessage").removeClass("d-none");
              $("#errorMessage").text(res.message);
            }
        },
    });
});


$(document).on("click", "#accept_button", function () {
    var formData = new FormData($("#referral_form")[0]);
    formData.append("accept_referral", true);

    $.ajax({
        type: "POST",
        url: "new_function.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 200) {
                $("#referralModal").modal("hide");
                $("#yourDivId").load(location.href + " #yourDivId");
                hideReasonAndButtons();
                $('#reason').val('');
            }
        },
    });
});

$(document).on("click", "#restore_button", function () {
    var formData = new FormData($("#referral_form")[0]);
    formData.append("restore_referral", true);

    $.ajax({
        type: "POST",
        url: "new_function.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 200) {
                $("#referralModal").modal("hide");
                $("#yourDivId").load(location.href + " #yourDivId");
            }
        },
    });
});

function restoreButtons(){
  const declineReferral = document.getElementById("decline_referral");
  const cancelButton = document.getElementById("cancel_button");
  const declineButton = document.getElementById("decline_button");
  const acceptButton = document.getElementById("accept_button");
  const referralReason = document.querySelector(".referral-reason");

    referralReason.style.display = "none";
    declineButton.style.display = "none";
    cancelButton.style.display = "none";
    declineReferral.style.display = "block";
    acceptButton.style.display = "block";

}

document.addEventListener("DOMContentLoaded", function() {
  const declineReferral = document.getElementById("decline_referral");
  const cancelButton = document.getElementById("cancel_button");
  const declineButton = document.getElementById("decline_button");
  const acceptButton = document.getElementById("accept_button");
  const referralReason = document.querySelector(".referral-reason");

  firstFunction();

  function firstFunction() {
    referralReason.style.display = "none";
    declineButton.style.display = "none";
    cancelButton.style.display = "none";
  }

  function SecondFunction() {
    referralReason.style.display = "block";
    declineButton.style.display = "block";
    cancelButton.style.display = "block";
  }

  declineReferral.addEventListener("click", function() {
    SecondFunction();
    declineReferral.style.display = "none";
    acceptButton.style.display = "none";

  });

  cancelButton.addEventListener("click", function() {
    firstFunction();
    declineReferral.style.display = "block";
    acceptButton.style.display = "block";
  });
});



$(document).on("click", ".deleteReferral", function (e) {
  e.preventDefault();

  if (confirm("Are you sure you want to delete this referral?")) {
    var referral = $(this).val();

    $.ajax({
      type: "POST",
      url: "new_function.php",
      data: {
        delete_referral: true,
        referral_id: referral,
      },
      success: function (response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 500) {
          alert(res.message);
        } else {
          alert(res.message);
          $("#referralsTable").load(location.href + " #referralsTable");
          $("#fieldForm").load(location.href + " #fieldForm");
        }
      },
    });
  }
});

$(document).on("click", "#deletePatient", function (e) {
  e.preventDefault();

  if (confirm("Are you sure you want to delete this patient?")) {
    var patientID = $(this).val();

    $.ajax({
      type: "POST",
      url: "new_function.php",
      data: {
        delete_patient: true,
        patient_id: patientID,
      },
      success: function (response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 500) {
          alert(res.message);
        } else {
          alert(res.message);
          $("#table").load(location.href + " #table");
          $("#fieldForm").load(location.href + " #fieldForm");
        }
      },
    });
  }
});

$(document).on("submit", "#createReferral", function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("create_referral", true);

  $.ajax({
    type: "POST",
    url: "new_function.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      console.log(response);
      if (res.status == 422) {
        $("#errorMessage").removeClass("d-none");
        $("#errorMessage").text(res.message);
      } else if (res.status == 400) {
        $("#referralError").removeClass("d-none");
        $("#referralError").text(res.message);
      }else if (res.status == 200) {
        $("#errorMessage").addClass("d-none");
        $("#staticBackdrop").modal("hide");
        $("#createReferral")[0].reset();

        $("#fieldTable").load(location.href + " #fieldTable");
        $("#fieldForm").load(location.href + " #fieldForm");
      }
    },
  });
});


$(document).on("submit", "#loginStaff", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("login", true);

    $.ajax({
        type: "POST",
        url: "new_function.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                $("#errorMessage").removeClass("d-none");
                $("#errorMessage").text(res.message);
            }else if(res.status == 401) {
              $("#errorMessage").removeClass("d-none");
              $("#errorMessage").text(res.message);
            }else if (res.status == 200) {
                location.reload();
            }
        },
    });
});

$(document).on("submit", "#addPatient", function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("add_patient", true);

  $.ajax({
    type: "POST",
    url: "prenatal_function.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 422) {
        console.log(res); // Log the response for debugging
        $("#errorMessage").removeClass("d-none");
        $("#errorMessage").text(res.message);
      } else if (res.status == 200) {
        $("#errorMessage").addClass("d-none");
        $("#staticBackdrop").modal("hide");
        $("#addPatient")[0].reset();

        
        $("#nav_buttons").load(location.href + " #nav_buttons");
        $("#table").load(location.href + " #table");
      }
    },
  });
});

$(document).on("click", "#submitBtn", function (e) {
    e.preventDefault();

    // Get the patient ID from the hidden input field
    var patientID = $("input[name='patients_id']").val();

    var formData = new FormData($("#patients_details")[0]); // Use the form's ID to get the form data

    formData.append("patients_details", true);

    // Add the patient ID to the formData
    formData.append("patients_id", patientID);

    $.ajax({
        type: "POST",
        url: "new_function.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                console.log(res); // Log the response for debugging
                $("#errorMessage").removeClass("d-none");
                $("#errorMessage").text(res.message);
            } else if (res.status == 200) {
                $("#errorMessage").addClass("d-none");
                $("#successMessage").removeClass("d-none");
                $("#successMessage").text(res.message);
                $('#submitBtn').hide(); // Hide the "Submit" button
                $('#editBtn').show();

                // Set readonly attribute for all input fields
                $('input.form-control').attr('readonly', true);

                $('#datepicker').attr('readonly', true);
            }
        },
    });
});

$(document).on("click", "#editBtn", function (e) {
    e.preventDefault();

    // Remove readonly attribute from all input fields
    $('input.form-control').removeAttr('readonly');
    $('#editBtnSave').show(); // Hide the "Submit" button
    $('#editBtn').hide();
    $("#errorMessage").addClass("d-none");
    $("#successMessage").addClass("d-none");

    // Remove readonly attribute specifically from the datepicker input field
    $('#datepicker').removeAttr('readonly');
});

$(document).on("click", "#editBtnSave", function (e) {
    e.preventDefault();

    // Get the patient ID from the hidden input field
    var patientID = $("input[name='patients_id']").val();

    var formData = new FormData($("#patients_details")[0]); // Use the form's ID to get the form data

    formData.append("edited_patients_details", true);

    // Add the patient ID to the formData
    formData.append("patients_id", patientID);

    $.ajax({
        type: "POST",
        url: "new_function.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                console.log(res); // Log the response for debugging
                $("#errorMessage").removeClass("d-none");
                $("#errorMessage").text(res.message);
            } else if (res.status == 200) {
                $("#errorMessage").addClass("d-none");
                $("#successMessage").removeClass("d-none");
                $("#successMessage").text(res.message);
                $('#submitBtn').hide(); // Hide the "Submit" button
                $('#editBtnSave').hide();
                $('#editBtn').show();

                // Set readonly attribute for all input fields
               $('input.form-control').prop('readonly', true);
               $('#datepicker').prop('readonly', true);
            }
        },
    });
});

$(document).ready(function () {
    var datepickerInput = $('.datepicker');
    
    // Function to initialize the date picker
    function initializeDatePicker() {
        datepickerInput.datepicker({
            autoclose: true,
            todayHighlight: true
        });
    }

    if (!datepickerInput.prop('readonly')) {
        initializeDatePicker();
    }

    // Add a click event to the "editBtn" to reinitialize the date picker
    $(document).on("click", "#editBtn", function (e) {
        e.preventDefault();

        // Remove readonly attribute specifically from the datepicker input field
        datepickerInput.removeAttr('readonly');
        
        // Destroy and reinitialize the date picker
        datepickerInput.datepicker('remove');
        initializeDatePicker();
    });
    
    $(document).on("click", "#editBtnSave", function (e) {
    e.preventDefault();

    // Add the 'readonly' attribute to the datepicker input field
    datepickerInput.attr('readonly', 'readonly');
    
    // Destroy the date picker
    datepickerInput.datepicker('destroy');
});

});

$(document).on("click", ".deleteField", function (e) {
  e.preventDefault();

  if (confirm("Are you sure you want to delete this field?")) {
    var field_name = $(this).val();

    $.ajax({
      type: "POST",
      url: "new_function.php",
      data: {
        delete_field: true,
        field_name: field_name,
      },
      success: function (response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 500) {
          alert(res.message);
        } else {
          alert(res.message);
          $("#fieldTable").load(location.href + " #fieldTable");
          $("#fieldForm").load(location.href + " #fieldForm");
        }
      },
    });
  }
});

$(document).on("click", ".deletePrenatalField", function (e) {
  e.preventDefault();

  if (confirm("Are you sure you want to delete this field?")) {
    var field_name = $(this).val();

    $.ajax({
      type: "POST",
      url: "new_function.php",
      data: {
        delete_prenatal_field: true,
        field_name: field_name,
      },
      success: function (response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 500) {
          alert(res.message);
        } else {
          alert(res.message);
          $("#prenatalFieldTable").load(location.href + " #prenatalFieldTable");
          $("#fieldForm").load(location.href + " #fieldForm");
        }
      },
    });
  }
});

$(document).on("submit", "#addField", function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("save_field", true);

  $.ajax({
    type: "POST",
    url: "new_function.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 422) {
        $("#errorMessage").removeClass("d-none");
        $("#errorMessage").text(res.message);
      } else if (res.status == 200) {
        $("#errorMessage").addClass("d-none");
        $("#staticBackdrop").modal("hide");
        $("#addField")[0].reset();

        $("#fieldTable").load(location.href + " #fieldTable");
        $("#fieldForm").load(location.href + " #fieldForm");
      } else if (res.status == 300) {
        $("#errorMessage").removeClass("d-none");
        $("#errorMessage").text(res.message);
      }
    },
  });
});

$(document).on("submit", "#addPrenatalField", function (e) {
  e.preventDefault();

  var formData = new FormData(this);
  formData.append("save_prenatal_field", true);

  $.ajax({
    type: "POST",
    url: "new_function.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 422) {
        $("#errorMessage").removeClass("d-none");
        $("#errorMessage").text(res.message);
      } else if (res.status == 200) {
        $("#errorMessage").addClass("d-none");
        $("#prenatalModalAdd").modal("hide");
        $("#addField")[0].reset();

        $("#prenatalFieldTable").load(location.href + " #prenatalFieldTable");
        $("#addPrenatalField").load(location.href + " #addPrenatalField");
      } else if (res.status == 300) {
        $("#errorMessage").removeClass("d-none");
        $("#errorMessage").text(res.message);
      }
    },
  });
});

// Code to View Records to Modal
$(document).on('click', '.viewRecord', function () {
    var rffrl_id = $(this).val();
    $.ajax({
        type: "GET",
        url: "new_function.php?rffrl_id=" + rffrl_id,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                alert(res.message);
            } else if (res.status == 200) {
                $('#fclt_name').text(res.data.fclt_name);
                $('#rffrl_id').val(res.data.rfrrl_id);
                $('#referralModal').modal('show');

                var columnNames = res.column_data;

                for (var i = 0; i < columnNames.length; i++) {
                    var columnName = columnNames[i];
                    var columnData = res.data[columnName];
                    $('#' + columnName).val(columnData);
                }

                // Display referral transactions
                var querytransactions_data = res.transactions;
                var referralTransactionsDiv = $('#referral_transactions');
                var audit = document.querySelector(".referral-audit");
                referralTransactionsDiv.empty(); // Clear any previous data

                for (var i = 0; i < querytransactions_data.length; i++) {
                    var transactionData = querytransactions_data[i];
                    var status = transactionData.status;
                    var time = transactionData.time;
                    var fclt_name = transactionData.fclt_name;

                    if (status) {
                        audit.classList.remove("d-none");
                        var pElement = $('<p></p>'); // Create a new <p> element
                        pElement.text(status +" by "+ fclt_name +" at "+ time); // Include the label
                        referralTransactionsDiv.append(pElement); // Append the <p> element to the div
                    }
                }
            }
        }
    });
});

// Code to View Records to Modal
$(document).on('click', '.viewMyRecord', function () {
    var rffrl_id = $(this).val();
    $.ajax({
        type: "GET",
        url: "new_function.php?myrecord_rffrl_id=" + rffrl_id,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                alert(res.message);
            } else if (res.status == 200) {
                $('#fclt_name').text(res.data.fclt_name);
                $('#rffrl_id').val(res.data.rfrrl_id);
                $('#referralModal').modal('show');

                var columnNames = res.column_data;

                for (var i = 0; i < columnNames.length; i++) {
                    var columnName = columnNames[i];
                    var columnData = res.data[columnName];
                    $('#' + columnName).val(columnData);
                }

                // Display referral transactions
                var querytransactions_data = res.transactions;
                var referralTransactionsDiv = $('#referral_transactions');
                var audit = document.querySelector(".referral-audit");
                referralTransactionsDiv.empty(); // Clear any previous data

                for (var i = 0; i < querytransactions_data.length; i++) {
                    var transactionData = querytransactions_data[i];
                    var status = transactionData.status;
                    var time = transactionData.time;
                    var fclt_name = transactionData.fclt_name;

                    if (status) {
                        audit.classList.remove("d-none");
                        var pElement = $('<p></p>'); // Create a new <p> element
                        pElement.text(status +" by "+ fclt_name +" at "+ time); // Include the label
                        referralTransactionsDiv.append(pElement); // Append the <p> element to the div
                    }
                }
            }
        }
    });
});


document.addEventListener("DOMContentLoaded", () => {


  let rightTab = document.querySelector(".nav-link.right-button.active").getAttribute("data-tab");
  let leftTab = document.querySelector(".nav-link.left-button.active").getAttribute("data-tab");
  const urlParams = new URLSearchParams(window.location.search);
  const patientID = urlParams.get("id");
  


  const rightBtn = document.querySelectorAll(".nav-link.right-button");
  const leftBtn = document.querySelectorAll(".nav-link.left-button");

  $(document).on('click', '#createNewRecord', function () {
   
   console.log("clicked");
   
 
 
 
 });
 

  if(rightTab && rightTab){
    getTrimesterData(leftTab, rightTab, patientID);
  }

  rightBtn.forEach((button) => {
    button.addEventListener("click", function () {
      rightTab = this.getAttribute("data-tab");
      console.log(rightTab);
      getTrimesterData(leftTab, rightTab, patientID);
    });
  });

  leftBtn.forEach((button) => {
    button.addEventListener("click", function () {
      leftTab = this.getAttribute("data-tab");
      console.log(leftTab);
      getTrimesterData(leftTab, rightTab, patientID);
    });
  });
  getBirthExData(patientID);
  getPatientDetailsData(patientID)

  function getTrimesterData(trimester, checkup, patient_id) {
  $.ajax({
    type: "GET",
    url: "prenatal_function.php",
    data: {
      trimester_table: trimester,
      patientid: patient_id,
      check_up: checkup
    },
    success: function (response) {
      var res = JSON.parse(response);
      if (res.table == "first_trimester") {
        $('#firstTri_date').val(res.data.date);
        $('#firstTri_date').datepicker('update');
        $('#firstTri_weight').val(res.data.weight);
        $('#firstTri_height').val(res.data.height);
        $('#firstTri_age_of_gestation').val(res.data.age_of_gestation);
        $('#firstTri_blood_pressure').val(res.data.blood_pressure);
        $('#firstTri_nutritional_status').val(res.data.nutritional_status);
        $('#firstTri_laboratory_tests_done').val(res.data.laboratory_tests_done);
        $('#firstTri_hemoglobin_count').val(res.data.hemoglobin_count);
        $('#firstTri_urinalysis').val(res.data.urinalysis);
        $('#firstTri_complete_blood_count').val(res.data.complete_blood_count);
        $('#firstTri_stis_using_a_syndromic_approach').val(res.data.stis_using_a_syndromic_approach);
        $('#firstTri_tetanus_containing_vaccine').val(res.data.tetanus_containing_vaccine);
        $('#firstTri_given_services').val(res.data.given_services);
        $('#firstTri_date_of_return').val(res.data.date_of_return);
        $('#firstTri_date_of_return').datepicker('update');
        $('#firstTri_health_provider_name').val(res.data.health_provider_name);
        $('#firstTri_hospital_referral').val(res.data.hospital_referral);
        $("#firstTriSave").hide();
        $("#firstTriUpdate").show();
      }else if(res.table == "second_trimester"){
        $('#secondTri_date').val(res.data.date);
        $('#secondTri_date').datepicker('update');
        $('#secondTri_weight').val(res.data.weight);
        $('#secondTri_height').val(res.data.height);
        $('#secondTri_age_of_gestation').val(res.data.age_of_gestation);
        $('#secondTri_blood_pressure').val(res.data.blood_pressure);
        $('#secondTri_nutritional_status').val(res.data.nutritional_status);
        $('#secondTri_given_advise').val(res.data.given_advise);
        $('#secondTri_laboratory_tests_done').val(res.data.laboratory_tests_done);
        $('#secondTri_urinalysis').val(res.data.urinalysis);
        $('#secondTri_complete_blood_count').val(res.data.complete_blood_count);
        $('#secondTri_given_services').val(res.data.given_services);
        $('#secondTri_date_of_return').val(res.data.date_of_return);
        $('#secondTri_date_of_return').datepicker('update');
        $('#secondTri_health_provider_name').val(res.data.health_provider_name);
        $('#secondTri_hospital_referral').val(res.data.hospital_referral);
        $("#secondTriSave").hide();
        $("#secondTriUpdate").show();
      }else if(res.table == "third_trimester"){
        $('#thirdTri_date').val(res.data.date);
        $('#thirdTri_date').datepicker('update');
        $('#thirdTri_weight').val(res.data.weight);
        $('#thirdTri_height').val(res.data.height);
        $('#thirdTri_age_of_gestation').val(res.data.age_of_gestation);
        $('#thirdTri_blood_pressure').val(res.data.blood_pressure);
        $('#thirdTri_nutritional_status').val(res.data.nutritional_status);
        $('#thirdTri_given_advise').val(res.data.given_advise);
        $('#thirdTri_laboratory_tests_done').val(res.data.laboratory_tests_done);
        $('#thirdTri_urinalysis').val(res.data.urinalysis);
        $('#thirdTri_complete_blood_count').val(res.data.complete_blood_count);
        $('#thirdTri_given_services').val(res.data.given_services);
        $('#thirdTri_date_of_return').val(res.data.date_of_return);
        $('#thirdTri_date_of_return').datepicker('update');
        $('#thirdTri_health_provider_name').val(res.data.health_provider_name);
        $('#thirdTri_hospital_referral').val(res.data.hospital_referral);
        $("#thirdTriSave").hide();
        $("#thirdTriUpdate").show();
        }else if(res.status == 404){
        $("#firstTriSave").show();
        $("#secondTriSave").show();
        $("#thirdTriSave").show();
        $("#firstTriUpdate").hide();
        $("#secondTriUpdate").hide();
        $("#thirdTriUpdate").hide();
        $("#firstTrimesterInsert")[0].reset();
        $('#firstTri_date').val('');
        $('#firstTri_date').datepicker('update');
        $('#secondTri_date').val('');
        $('#secondTri_date').datepicker('update');
        $('#thirdTri_date').val('');
        $('#thirdTri_date').datepicker('update');
        $("#secondTrimesterInsert")[0].reset();
        $("#thirdTrimesterInsert")[0].reset();
      }
    }
  });
}

function getBirthExData(patient_id) {
  $.ajax({
    type: "GET",
    url: "prenatal_function.php",
    data: {
      patient_id: patient_id
    },
    success: function (response) {
      var res = JSON.parse(response);
      if (res.status == 200) {
        $('#date_of_delivery').val(res.data.date_of_delivery);
        $('#date_of_delivery').datepicker('update');
        $('#type_of_delivery').val(res.data.type_of_delivery);
        $('#birth_outcome').val(res.data.birth_outcome);
        $('#number_of_children_delivered').val(res.data.number_of_children_delivered);
        $('#pregnancy_hypertension').val(res.data.pregnancy_hypertension);
        $('#preeclampsia_eclampsia').val(res.data.preeclampsia_eclampsia);
        $('#bleeding_during_pregnancy').val(res.data.bleeding_during_pregnancy);
        $("#birthExSave").hide();
        $("#birthExUpdate").show();
      }else if(res.status == 404){
        $('#date_of_delivery').val('');
        $('#date_of_delivery').datepicker('update');
        $("#birthExperienceInsert")[0].reset();
        $("#birthExSave").show();
        $("#birthExUpdate").hide();
      }
    }
  });
}

function getPatientDetailsData(patient_id) {
  $.ajax({
    type: "GET",
    url: "prenatal_function.php",
    data: {
      patient_details_id: patient_id
    },
    success: function (response) {
      var res = JSON.parse(response);
      if (res.status == 200) {
        $('#petsa_ng_unang_checkup').val(res.data.petsa_ng_unang_checkup);
        $('#petsa_ng_unang_checkup').datepicker('update');
        $('#edad').val(res.data.edad);
        $('#timbang').val(res.data.timbang);
        $('#taas').val(res.data.taas);
        $('#kalagayan_ng_kalusugan').val(res.data.kalagayan_ng_kalusugan);
        $('#petsa_ng_huling_regla').val(res.data.petsa_ng_huling_regla);
        $('#kailan_ako_manganganak').val(res.data.kailan_ako_manganganak);
        $('#pang_ilang_pagbubuntis').val(res.data.pang_ilang_pagbubuntis);
        $("#patientSave").addClass("d-none");
        $("#patientUpdate").removeClass("d-none");
      }else if(res.status == 404){
        $('#petsa_ng_unang_checkup').val('');
        $('#petsa_ng_unang_checkup').datepicker('update');
        $("#patientsDetailsInsert")[0].reset();
        $("#patientUpdate").addClass("d-none");
        $("#patientSave").removeClass("d-none");
      }
    }
  });
}

$(document).ready(function () {
  $('.prenatal-datepicker').datepicker({
    format: 'mm/dd/yyyy',
    autoclose: true,
    todayHighlight: true
  });
});

  $(document).on("submit", "#firstTrimesterInsert", function (e) {
  e.preventDefault();

  var formData = new FormData(this);

  var clickedButton = e.originalEvent.submitter;
  if (clickedButton.id === 'firstTriSave') {
    formData.append("first_trimesters_insert", true);
  } else if (clickedButton.id === 'firstTriUpdate') {
    formData.append("first_trimesters_update", true);
  }

  formData.append("checkup", rightTab);
  formData.append("patient_id", patientID);

  $.ajax({
    type: "POST",
    url: "prenatal_function.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if(res.status == 200) {
        $("#firstTriSave").hide();
        $("#firstTriUpdate").show();
      } else if (res.status == 300) {
        $("#errorMessage").removeClass("d-none");
        $("#errorMessage").text(res.message);
      }
    },
  });
});

$(document).on("submit", "#secondTrimesterInsert", function (e) {
  e.preventDefault();

  var formData = new FormData(this);

  var clickedButton = e.originalEvent.submitter;
  if (clickedButton.id === 'secondTriSave') {
    formData.append("second_trimesters_insert", true);
  } else if (clickedButton.id === 'secondTriUpdate') {
    formData.append("second_trimesters_update", true);
  }

  formData.append("checkup", rightTab);
  formData.append("patient_id", patientID);

  $.ajax({
    type: "POST",
    url: "prenatal_function.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 200) {
        $("#secondTriSave").hide();
        $("#secondTriUpdate").show();
      } else if (res.status == 300) {
        $("#errorMessage").removeClass("d-none");
        $("#errorMessage").text(res.message);
      }
    },
  });
});

$(document).on("submit", "#thirdTrimesterInsert", function (e) {
  e.preventDefault();

  var formData = new FormData(this);

  var clickedButton = e.originalEvent.submitter;
  if (clickedButton.id === 'thirdTriSave') {
    formData.append("third_trimesters_insert", true);
  } else if (clickedButton.id === 'thirdTriUpdate') {
    formData.append("third_trimesters_update", true);
  }

  formData.append("checkup", rightTab);
  formData.append("patient_id", patientID);

  $.ajax({
    type: "POST",
    url: "prenatal_function.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if (res.status == 200) {
        $("#thirdTriSave").hide();
        $("#thirdTriUpdate").show();
      } else if (res.status == 300) {
        $("#errorMessage").removeClass("d-none");
        $("#errorMessage").text(res.message);
      }
    },
  });
});

$(document).on("submit", "#birthExperienceInsert", function (e) {
  e.preventDefault();

  var formData = new FormData(this);

  var clickedButton = e.originalEvent.submitter;
  if (clickedButton.id === 'birthExSave') {
    formData.append("birth_experience_insert", true);
  } else if (clickedButton.id === 'birthExUpdate') {
    formData.append("birth_experience_update", true);
  }

  formData.append("patient_id", patientID);

  $.ajax({
    type: "POST",
    url: "prenatal_function.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if(res.status == 200) {
        $("#birthExSave").hide();
        $("#birthExUpdate").show();
      } else if (res.status == 300) {
        $("#errorMessage").removeClass("d-none");
        $("#errorMessage").text(res.message);
      }
    },
  });
});

$(document).on("submit", "#patientsDetailsInsert", function (e) {
  e.preventDefault();

  var formData = new FormData(this);

  var clickedButton = e.originalEvent.submitter;
  if (clickedButton.id === 'patientSave') {
    formData.append("patients_details_insert", true);
  } else if (clickedButton.id === 'patientUpdate') {
    formData.append("patients_details_update", true);
  }

  formData.append("patient_id", patientID);

  $.ajax({
    type: "POST",
    url: "prenatal_function.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      var res = jQuery.parseJSON(response);
      if(res.status == 200) {
        $("#patientSave").addClass("d-none");
        $("#patientUpdate").removeClass("d-none");
        //$("#patientSave").hide();
        //$("#patientUpdate").show();
      } else if (res.status == 300) {
        $("#errorMessage").removeClass("d-none");
        $("#errorMessage").text(res.message);
      }
    },
  });
});

});

var pusher = new Pusher('4c140a667948d3f0c3b4', {
    cluster: 'ap1'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function (data) {
    // Assuming 'contactIDValue' contains the contact ID of the currently selected contact
    loadLatestMessage(contactIDValue);
    loadMessages(contactIDValue);

    $.ajax({
        url: "includes/referral_functions.inc.php",
        success: function ($referrals) {
            $('#yourDivId').load(location.href + " #yourDivId");
            //$('#message-container').load(location.href + " #message-container");
            $('#referralsTable').load(location.href + " #referralsTable");
            showToast(data.message);
        }
    });
});


var referralCards = document.querySelectorAll('.referral-card');
var contactName = document.getElementById('contact_name');
var contactID = document.getElementById('contact_id');
var messageContainer = document.getElementById('message-container');
var latestMessageContainer = document.getElementById('latestMessage');
var contactIDValue = null; // Declare it here

function loadMessages(contactIDValue) {
    // Make an AJAX request using the contactIDValue as a data parameter
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the AJAX response here
            var responseData = JSON.parse(xhr.responseText);

            // Clear the existing messages
            messageContainer.innerHTML = '';

            // Append messages to the message container in sequence
            responseData.forEach(function (messageObj) {
                var messageElement = document.createElement('div');
                if (messageObj.type === 'sent') {
                    messageElement.className = 'sent';
                } else {
                    messageElement.className = 'received';
                }
                messageElement.textContent = messageObj.message;
                messageContainer.appendChild(messageElement);
            });

            scrollMessageContainerToBottom();
        }
    };

    // Replace 'new_function.php' with the actual URL to your PHP script
    xhr.open('GET', 'new_function.php?contact_id=' + contactIDValue, true);
    xhr.send();
}

function loadLatestMessageForContact(contactIDValue) {
    // Call the loadLatestMessage function for the specific contact
    loadLatestMessage(contactIDValue);
}

if (referralCards.length > 0) {
    var firstCard = referralCards[0];
    contactIDValue = firstCard.getAttribute('data-contact-id');
    console.log("Contact ID: " + contactIDValue);
    firstCard.click();
    loadMessages(contactIDValue);
    displayFirstContactName();
}

referralCards.forEach(function (card) {
    card.addEventListener('click', function () {
        var contactNameValue = card.getAttribute('data-contact-name');
        contactIDValue = card.getAttribute('data-contact-id');
        console.log("Contact ID: " + contactIDValue);
        contactName.textContent = contactNameValue;
        loadMessages(contactIDValue);
    });
    
    // Call the function to load the latest message for each contact
    var contactIDForLatestMessage = card.getAttribute('data-contact-id');
    loadLatestMessageForContact(contactIDForLatestMessage);
});

function loadLatestMessage(contactID) {
    // Make an AJAX request to retrieve the latest message for the given contactID
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the AJAX response here
            var response = JSON.parse(xhr.responseText);
            var latestMessage = response.latestMessage;
            var time = response.time; // Get the time from the response

            // Log the latest message and time to the console
           // console.log("Latest Message: " + latestMessage);
            //console.log("Time: " + time);

            // Update the latest message for the specific contact card
            setLatestMessage(contactID, latestMessage, time);
        }
    };

    // Replace 'new_function.php' with the actual URL to retrieve the latest message
    xhr.open('GET', 'new_function.php?message_contact_id=' + contactID, true);
    xhr.send();
}

// Update your JavaScript to set the contact name and latest message
function setLatestMessage(contactID, latestMessage, time) {
    // Find the contact card with the matching contact ID
    var contactCard = document.querySelector(`[data-contact-id="${contactID}"]`);

    // Find the "description" and "wews" elements within the contact card
    var descriptionElement = contactCard.querySelector('.description');
    var wewsElement = contactCard.querySelector('.wews'); // Change this line to select the "wews" element in the same contact card

    // Split the time string to keep only hours, minutes, and AM/PM
    var timeParts = time.split(' '); // Split by space to separate time and AM/PM
    var timeComponents = timeParts[0].split(':'); // Split the time part by colon
    var hours = timeComponents[0];
    var minutes = timeComponents[1];
    var amPm = timeParts[1];

    // Create the modified time string with AM/PM
    var modifiedTime = hours + ':' + minutes + ' ' + amPm;

    // Set the "description" text with the latest message and modified time
    descriptionElement.textContent = latestMessage + ' • ' + modifiedTime;

    // Set the "wews" text with the same content as the "description" element
    wewsElement.textContent = descriptionElement.textContent;
}

function displayFirstContactName() {
    var firstContactName = referralCards[0].getAttribute('data-contact-name');
    contactName.textContent = firstContactName;
}

function scrollMessageContainerToBottom() {
    var container = document.getElementById('message-container');
    container.scrollTop = container.scrollHeight;
}

    $(document).on("submit", "#message-form", function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("send_message", true);

        if (contactIDValue) {
            // Include contactIDValue in the formData
            formData.append("contact_id", contactIDValue);

            $.ajax({
                type: "POST",
                url: "new_function.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        // Insert the new message immediately
                        var newMessage = "<div class='message'>" + formData.get('message') + "</div>";
                        $("#message-container").append(newMessage);

                        $("#message-form")[0].reset();
                    } else if (res.status == 500) {
                        console.log(res.message);
                    }
                },
            });
        }
    });

$(document).on('click', '.viewPatient', function () {
    var rffrl_id = $(this).val();
    $.ajax({
        type: "GET",
        url: "prenatal_function.php?view_patient_id=" + rffrl_id,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                alert(res.message);
            } else if (res.status == 200) {
              $('#view_fname').val(res.data.fname);
              $('#view_mname').val(res.data.mname);
              $('#view_lname').val(res.data.lname);
              $('#view_contactNum').val(res.data.contact);
              $('#view_address').val(res.data.address);
              $('#viewPatientModal').modal('show');
            }
        }
    });
});

$(document).on('click', '.viewPatientRecords', function () {
    var patients_id = $(this).val();
    $.ajax({
        type: "GET",
        url: "prenatal_function.php?view_patient_records_id=" + patients_id,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 404) {
              $("#createRecordBtn").attr("href", "add_prenatal.php?id=" + res.data.id);
              $("#viewRecordBtn").attr("href", "view_prenatal.php?id=" + res.data.id);
              $('#viewPatientRecordsModal').modal('show');
            } else if (res.status == 200) {
              $("#createRecordBtn").attr("href", "add_prenatal.php?id=" + res.data.id);
              $("#viewRecordBtn").attr("href", "view_prenatal.php?id=" + res.data.id);
              $('#viewPatientRecordsModal').modal('show');
            }
        }
    });
});


</script>

</body>
</html>