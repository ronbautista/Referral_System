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

$(document).ready(function () {
    // Check if a stored active link exists in local storage
    var activeLink = localStorage.getItem('activeLink');

    // Set the "active" class on the stored active link
    if (activeLink) {
        $(".sidebarbtn[href='" + activeLink + "']").addClass("active");
    }

    // Add click event listeners to your sidebar links
    $(".sidebarbtn").click(function () {
        // Remove the "active" class from all list items
        $(".sidebarbtn").removeClass("active");

        // Add the "active" class to the clicked button
        $(this).addClass("active");

        // Store the clicked link in local storage
        localStorage.setItem('activeLink', $(this).attr('href'));
    });
});



var secondAccountEmpty = <?php echo $secondAccountEmpty ? 'true' : 'false'; ?>;

// Check if the second account is empty and show the modal if necessary
if (secondAccountEmpty) {
    $(document).ready(function(){
        console.log("Showing modal");
        $("#loginModal").modal('show');
    });
}


  // Enable Pusher logging - don't include this in production
  //Pusher.logToConsole = true;



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
            }
        },
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
      if (res.status == 422) {
        $("#errorMessage").removeClass("d-none");
        $("#errorMessage").text(res.message);
      } else if (res.status == 200) {
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
        $("#staticBackdrop").modal("hide");
        console.log(response);
        $("#addPatient")[0].reset();

        $("#table").load(location.href + " #table");
      }
    },
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


// Code to View Records to Modal
$(document).on('click', '.viewRecord', function(){

var rffrl_id = $(this).val();
$.ajax({
    type:"GET",
    url:"new_function.php?rffrl_id=" + rffrl_id,
    success: function(response){

var res = jQuery.parseJSON(response);
if(res.status == 422){
    alert(res.message);
}else if(res.status == 200){
$('#fclt_name').text(res.data.fclt_name);
$('#rffrl_id').val(res.data.id);
<?php 
$query = "SELECT * FROM referral_format";
$query_run = mysqli_query($conn, $query);

if(mysqli_num_rows($query_run) > 0){
foreach($query_run as $field){
?>
$('#<?=  $field['field_name'] ?>').val(res.data.<?=  $field['field_name'] ?>);
<?php 
}
}
?>
$('#referralModal').modal('show');
        }
    }
});
});

document.addEventListener("DOMContentLoaded", () => {
  // Get the 'leftTab' and 'rightTab' values from URL parameters
  const urlParams = new URLSearchParams(window.location.search);
  const leftTab = urlParams.get("table_name");
  const rightTab = urlParams.get("Check_up");

  // DOM elements
  const buttonsLeft = document.querySelectorAll(
    ".button-container-left .button"
  );
  const buttonsRight = document.querySelectorAll(
    ".button-container-right .button"
  );

  // Default left and right tabs
  const defaultLeftTab = buttonsLeft[0].getAttribute("data-tab");
  const defaultRightTab = buttonsRight[0].getAttribute("data-tab");

  // Active buttons
  let activeLeftButton = buttonsLeft[0];
  let activeRightButton = buttonsRight[0];

  // Set the active left button based on the 'leftTab' value
  buttonsLeft.forEach((button) => {
    const dataTab = button.getAttribute("data-tab");
    console.log("Button data-tab:", dataTab);
    console.log("leftTab value:", leftTab);

    if (dataTab === leftTab) {
      setActiveButton(buttonsLeft, button);
      activeLeftButton = button;
    }
  });

  // Set the active right button based on the 'rightTab' value
  buttonsRight.forEach((button) => {
    const dataTab = button.getAttribute("data-tab");
    console.log("Button data-tab:", dataTab);
    console.log("rightTab value:", rightTab);

    if (dataTab === rightTab) {
      setActiveButton(buttonsRight, button);
      activeRightButton = button;
    }
  });

  // Fetch and display data for the selected tabs
  fetchAndDisplayForm(
    activeLeftButton.getAttribute("data-tab"),
    activeRightButton.getAttribute("data-tab")
  );

  // Event handler for button click
  function handleButtonClick(buttons, activeButton) {
    return (event) => {
      const clickedButton = event.target;

      setActiveButton(buttons, clickedButton);

      if (buttons === buttonsLeft) {
        activeLeftButton = clickedButton;
      } else if (buttons === buttonsRight) {
        activeRightButton = clickedButton;
      }

      // Fetch and display data for the selected tabs
      fetchAndDisplayForm(
        activeLeftButton.getAttribute("data-tab"),
        activeRightButton.getAttribute("data-tab")
      );
    };
  }

  // Add event listeners for left buttons
  buttonsLeft.forEach((button) => {
    button.addEventListener(
      "click",
      handleButtonClick(buttonsLeft, activeLeftButton)
    );
  });

  // Add event listeners for right buttons
  buttonsRight.forEach((button) => {
    button.addEventListener(
      "click",
      handleButtonClick(buttonsRight, activeRightButton)
    );
  });

  // Set active button style
  function setActiveButton(buttons, activeButton) {
    buttons.forEach((button) => {
      button.classList.remove("active");
    });
    activeButton.classList.add("active");
  }

  // Fetch and display form data
  function fetchAndDisplayForm(leftTab, rightTab) {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("id");

    $.ajax({
      type: "POST",
      url: "server_script.php",
      data: {
        getc_columns: true,
        table_name: leftTab,
        Check_up: rightTab,
        patients_id: id,
      },
      dataType: "json",
      success: function (response) {
        console.log("Fetch data success:", response);

        if (response.success) {
          // Log the data received
          console.log("Data:", response.data);

          if (response.data.length > 0) {
            // Data exists, generate form with data
            const formHtml = generateFormHtmlWithData(response.data);
            const formContainer = document.getElementById("formContainer");
            formContainer.innerHTML = formHtml;
          }
        } else {
          console.error("Error:", response.message);
          fetchColumns(leftTab);
        }
      },
      error: function (error) {
        console.log("Fetch data error:", error);
        console.error("Error:", error);
      },
    });
  }

  function fetchColumns(leftTab) {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("id");

    $.ajax({
      type: "POST",
      url: "fetch_columns.php",
      data: {
        getc_columns: true,
        table_name: leftTab,
        Check_up: activeRightButton.getAttribute("data-tab"),
        patients_id: id,
      },
      dataType: "json",
      success: function (response) {
        console.log("AJAX success:", response);
        if (response.success) {
          displayForm(response.columns);
        } else {
          console.error("Error:", response.message);
        }
      },
      error: function (error) {
        console.log("AJAX error:", error);
        console.error("Error:", error);
      },
    });
  }

  function displayForm(columns) {
    const formHtml = generateFormHtmlWithoutData(columns);
    const contentTab = document.getElementById("contenttab");
    const formContainer = contentTab.querySelector("#formContainer");
    formContainer.innerHTML = formHtml;

    const insertForm = document.getElementById("insertForm");
    insertForm.addEventListener("submit", handleFormSubmit);
  }

  function generateFormHtmlWithData(data) {
    let formHtml = '<form id="insertForm" method="post" class="row">';
    for (const column in data[0]) {
      if (
        column !== "id" &&
        column !== "check-up" &&
        column !== "patients_id"
      ) {
        const label = column.replace(/_/g, " ");
        const value = data && data[0] && data[0][column] ? data[0][column] : "";
        formHtml += `<div class="col-sm-4 mb-3">`;
        formHtml += `<label for="${column}">${label}:</label>`;
        formHtml += `<input type="text" name="${column}" id="${column}" class="form-control" value="${value}">`;
        formHtml += `</div>`;
      }
    }
    formHtml +=
      '<div hidden class="col-sm-12"><button type="submit" id="submitForm" class="btn btn-primary">Submit</button></div>';
    formHtml += "</form>";
    return formHtml;
  }

  function generateFormHtmlWithoutData(columns) {
    let formHtml = '<form id="insertForm" method="post" class="row">';
    columns.forEach((column) => {
      if (
        column !== "id" &&
        column !== "check-up" &&
        column !== "patients_id"
      ) {
        const label = column.replace(/_/g, " ");
        formHtml += `<div class="col-sm-4 mb-3">`;
        formHtml += `<label for="${column}">${label}:</label>`;
        formHtml += `<input type="text" name="${column}" id="${column}" class="form-control">`;
        formHtml += `</div>`;
      }
    });
    formHtml +=
      '<div class="col-sm-12"><button type="submit" id="submitForm" class="btn btn-primary">Submit</button></div>';
    formHtml += "</form>";
    return formHtml;
  }

  function handleFormSubmit(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    formData.append("table_name", activeLeftButton.getAttribute("data-tab"));
    formData.append("Check-up", activeRightButton.getAttribute("data-tab"));
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("id");
    formData.append("patients_id", id);

    $.ajax({
      type: "POST",
      url: "insert_data.php",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json", // Ensure that the response is treated as JSON
      success: function (response) {
        console.log("Insertion success:", response);
        console.log(response); // Add this line to inspect the entire response
        if (response.reloadPage === true) {
          // Save the active buttons and other parameters
          const urlParams = new URLSearchParams(window.location.search);
          urlParams.set(
            "table_name",
            activeLeftButton.getAttribute("data-tab")
          );
          urlParams.set("Check_up", activeRightButton.getAttribute("data-tab"));

          // Update the URL with the new parameters
          const newUrl = `${window.location.pathname}?${urlParams.toString()}`;
          history.replaceState(null, null, newUrl);

          // Reload the page
          location.reload();
        }
      },

      error: function (xhr, status, error) {
        console.error("Insertion error:", error);
        console.log(xhr.responseText); // Log the full server response
        // Handle insertion error, if needed
      },
    });
  }
});

var pusher = new Pusher('4c140a667948d3f0c3b4', {
cluster: 'ap1'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) { 
  
$.ajax({url: "includes/referral_functions.inc.php", success: function($referrals){
 $('#yourDivId').load(location.href + " #yourDivId");
 //$('#message-container').load(location.href + " #message-container");
 $('#referralsTable').load(location.href + " #referralsTable");
 loadMessages(contactIDValue);
 showToast(data.message);
 }});
});

var referralCards = document.querySelectorAll('.referral-card');
var contactName = document.getElementById('contact_name');
var contactID = document.getElementById('contact_id');
var messageContainer = document.getElementById('message-container');
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



function scrollMessageContainerToBottom() {
    var container = document.getElementById('message-container');
    container.scrollTop = container.scrollHeight;
}


    if (referralCards.length > 0) {
        var firstCard = referralCards[0];
        contactIDValue = firstCard.getAttribute('data-contact-id'); // Get the contact ID
        console.log("Contact ID: " + contactIDValue); // Log the contact ID
        firstCard.click(); // Simulate a click event
        loadMessages(contactIDValue); 
    }

    referralCards.forEach(function (card) {
        card.addEventListener('click', function () {
            var contactNameValue = card.getAttribute('data-contact-name');
            contactIDValue = card.getAttribute('data-contact-id'); // Set contactIDValue
            console.log("Contact ID: " + contactIDValue); // Log the contact ID

            // Set the contact_name as the text content of #contact_name
            contactName.textContent = contactNameValue;

            loadMessages(contactIDValue);
            
        });
    });

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




</script>

</body>
</html>