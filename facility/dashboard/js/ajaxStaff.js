document.addEventListener("DOMContentLoaded", function () {

    tooltip();

    function tooltip() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    const form = document.getElementById('addStaff');
    const input = document.getElementById('staffformFile');
    const imagePreview = document.getElementById('staffimagePreview');
    const imageName = document.getElementById('staffimage_name');

    var staffModal = $('#staffModal');

    staffModal.on('hidden.bs.modal', function () {
        form.classList.remove('was-validated');
    });

    form.addEventListener('submit', function (event) {
        // Prevent the form from submitting if it fails validation
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
    
        // Add validation styling to the form
        form.classList.add('was-validated');
    
        // If the form is valid, proceed with additional client-side validation
        if (form.checkValidity()) {
            const fname = document.getElementById('fname').value;
            const lname = document.getElementById('lname').value;
            const contactNum = document.getElementById('contactNum').value;
            const address = document.getElementById('address').value;
            const role = document.getElementById('role').value;
    
            // Perform additional validation
            if (!fname || !lname || !contactNum || !address || !role) {
                return;
            }
    
            // If all validations pass, proceed with form submission
            const formData = new FormData(form);
            formData.append('add_staff', true);
            formData.append('profile_image', input.files[0]);
    
            fetch('server/staff_function.php', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.text();
                })
                .then(data => {
                    console.log(data);
    
                    try {
                        const jsonData = JSON.parse(data);
                        if (jsonData.success) {
                            // Reset the form and remove validation styling
                            form.classList.remove('was-validated');
                            staffModal.modal('hide');
                            $("#staffTable").load(location.href + " #staffTable");
                            $("#addStaff")[0].reset();
                        } else {
                            alert('Error: ' + jsonData.error);
                        }
                    } catch (error) {
                        alert('Error parsing JSON: ' + error.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error.message);
                    alert('Error uploading file.');
                });
        }
    });    

    document.getElementById('staffuploadButton').addEventListener('click', function () {
        input.click();
    });

    input.addEventListener('change', function () {
        staffDisplaySelectedImage();
    });

    function staffDisplaySelectedImage() {
        if (input.files && input.files[0]) {
            const file = input.files[0];

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imageName.textContent = file.name;
                };

                reader.readAsDataURL(file);
            } else {
                alert('Please select a valid image file.');
                input.value = '';
            }
        }
    }

    $(document).on('click', '.editStaff', function () {
        var staff_id = $(this).val();
        var $tooltipTrigger = $(this);
        var tooltipInstance = bootstrap.Tooltip.getInstance($tooltipTrigger[0]);
        
        if (tooltipInstance) {
            tooltipInstance.hide();
        }
        $.ajax({
            type: "GET",
            url: "server/staff_function.php?view_staff=" + staff_id,
            success: function (response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $('#fname').val(res.data.fname);
                    $('#mname').val(res.data.mname);
                    $('#lname').val(res.data.lname);
                    $('#contactNum').val(res.data.contact_num);
                    $('#address').val(res.data.address);
                    $('#role').val(res.data.role);
                    var imagePath = "../dashboard/assets/" + res.data.img;
                    $('#staffimagePreview').attr('src', imagePath);
                    $("#staffsaveButton").addClass("d-none");
                    $("#staffupdateButton").removeClass("d-none");
    
                    var staffModal = $('#staffModal');
    
                    // Show the modal
                    staffModal.modal('show');
    
                    // Add an event listener for when the modal is hidden
                    staffModal.on('hidden.bs.modal', function () {
                        // Your condition when the modal is closed
                        $("#staffsaveButton").removeClass("d-none");
                        $("#staffupdateButton").addClass("d-none");
                        var imagePath = "../dashboard/assets/patient.png";
                        $('#staffimagePreview').attr('src', imagePath);
                        imageName.textContent = "";
                        $("#addStaff")[0].reset();
                    });
                }
            }
        });
    });

    $(document).on('click', '.deleteStaff', function () {
        var staff_id = $(this).val();
        var $tooltipTrigger = $(this); // Save the tooltip trigger element
        if (confirm("Are you sure you want to delete this patient?")) {
            $.ajax({
                type: "GET",
                url: "server/staff_function.php?delete_staff=" + staff_id,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        alert(res.message);
                    } else if (res.status == 200) {
                        // Hide the tooltip
                        var tooltipInstance = bootstrap.Tooltip.getInstance($tooltipTrigger[0]);
                        if (tooltipInstance) {
                            tooltipInstance.hide();
                        }           
                        // Update content
                        $("#staffTable").load(location.href + " #staffTable", function () {
                            tooltip(); // Call tooltip function after content is loaded
                        });
                    }
                }
            });
        }
     });
});
