</div>
</div>
<!-- Include Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

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

</script>

</body>
</html>