<?php
include_once 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize the response message
    $response = ['message' => 'No changes were made.'];

    // Access the additional form fields
    $username = $_POST['username'];
    $email = $_POST['email'];
    $id = $_POST['id'];

    // Check if the file is uploaded without errors
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profile_image'];

        // Check if the uploaded file is an image
        $fileInfo = getimagesize($file['tmp_name']);
        if ($fileInfo !== false) {
            // Define the directory where you want to save the uploaded file
            $uploadDir = 'images/'; // Adjust the path for Windows

            // Create the upload directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Generate a unique filename to avoid overwriting existing files
            $filename = $uploadDir . uniqid() . '_' . $file['name'];

            // Move the uploaded file to the desired directory
            if (move_uploaded_file($file['tmp_name'], $filename)) {
                // File uploaded successfully
                // Update the image in the database
                $sql = "UPDATE users SET usersName = ? , usersEmail = ? , usersImg = ? WHERE usersId = ?";
                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'sssi', $username, $email, $filename, $id);
                    if (mysqli_stmt_execute($stmt)) {
                        $response = ['message' => 'File uploaded and form data saved successfully'];
                    } else {
                        $response = ['message' => 'File uploaded successfully, but failed to insert into the database.'];
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    $response = ['message' => 'File uploaded successfully, but failed to prepare the database query.'];
                }
            } else {
                $response = ['message' => 'Failed to move the file'];
            }
        } else {
            $response = ['message' => 'Invalid file format. Only images are allowed.'];
        }
    } else {
        // No file was uploaded, but you can still update the username and email
        $sql = "UPDATE users SET usersName = ? , usersEmail = ? WHERE usersId = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssi', $username, $email, $id);
            if (mysqli_stmt_execute($stmt)) {
                $response = ['message' => 'Form data saved successfully.'];
            } else {
                $response = ['message' => 'Failed to update form data in the database.'];
            }
            mysqli_stmt_close($stmt);
        } else {
            $response = ['message' => 'Failed to prepare the database query.'];
        }
    }

    // Send a JSON response back to the client
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Handle other HTTP request methods if necessary
    http_response_code(405); // Method Not Allowed
}
