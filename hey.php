<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Staff Profile Edit Modal</title>
    <style>
        #staffEdit .image-profile {
        flex: 1; /* Make the image-profile div expand to fill the modal body */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        }

        #staffEdit .image-content {
        width: 120px; /* Set a specific width for the circular container */
        height: 120px; /* Set a specific height for the circular container */
        border-radius: 50%; /* Create a circular shape */
        overflow: hidden; /* Hide any content outside the circle */
        margin: 0 auto; /* Center the circle horizontally (optional) */
        display: flex;
        align-items: center;
        justify-content: center;
        }

        #staffEdit .image-content img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensure the image fills the circular container */
        object-position: center center; /* Center the image within the circle */
        }
        #staffEdit #uploadButton{
            margin-top:10px;
        }
    </style>
</head>
<body>
    <h1>Edit Staff Profile Modal</h1>

    <!-- Button to open the modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staffEditModal">
        Edit Staff Profile
    </button>

    <!-- EDIT STAFF PROFILE modal -->
    <div class="modal fade" id="staffEditModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" id="staffEdit">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Staff Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="status"></div>
                    <form id="user_profile" enctype="multipart/form-data">
                        <div class="image-profile">
                            <div class="image-content">
                                <img src="images/boy.png" alt="Logo" class="profile-icon" id="imagePreview">
                            </div>
                            <div class="edit-button">
                                <!-- Use a button to trigger the file input -->
                                <button type="button" class="btn btn-primary" id="uploadButton">Upload Image</button>

                                <!-- Hide the file input element -->
                                <input style="display: none;" type="file" id="formFile" name="profile_image" onchange="displaySelectedImage()">

                            </div>
                            <div id="image_name"></div>
                        </div>
                        <div class="profile-details">
                            <!-- Additional form fields for name and description -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                            </div>
                            <button type="button" class="btn btn-primary" id="saveButton">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- JavaScript for handling form submission and image preview -->
    <script>
        function displaySelectedImage() {
            const input = document.getElementById('formFile');
            const imagePreview = document.getElementById('imagePreview');
            const imageName = document.getElementById('image_name');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imageName.textContent = input.files[0].name;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Add an event listener to the button to trigger the file input
        document.getElementById('uploadButton').addEventListener('click', function () {
            document.getElementById('formFile').click(); // Trigger the file input
        });

        document.getElementById('saveButton').addEventListener('click', function () {
            const formData = new FormData(document.getElementById('user_profile'));

            fetch('upload.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('status').textContent = data.message;
                if (data.message === 'File uploaded successfully') {
                    // Close the modal if the upload is successful
                    const staffEditModal = new bootstrap.Modal(document.getElementById('staffEditModal'));
                    staffEditModal.hide();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
