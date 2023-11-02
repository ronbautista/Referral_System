<?php
include_once 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the file is uploaded without errors
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profile_image'];

        // Check if the uploaded file is an image
        $fileInfo = getimagesize($file['tmp_name']);
        if ($fileInfo !== false) {
            // Define the directory where you want to save the uploaded file
            $uploadDir = 'C:/xampp/htdocs/Referral_System/images/'; // Adjust the path for Windows

            // Create the upload directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Generate a unique filename to avoid overwriting existing files
            $filename = $uploadDir . uniqid() . '_' . $file['name'];

            // Move the uploaded file to the desired directory
            if (move_uploaded_file($file['tmp_name'], $filename)) {
                // File uploaded successfully

                // Access the additional form fields
                $name = $_POST['name'];
                $description = $_POST['description'];

                // Insert file information and form data into the database
                $sql = "INSERT INTO uploaded_files (file_name, file_path, name, description) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'ssss', $file['name'], $filename, $name, $description);
                    if (mysqli_stmt_execute($stmt)) {
                        // File information and form data inserted into the database successfully
                        $response = ['message' => 'File uploaded and form data saved successfully'];
                    } else {
                        // Database insertion error
                        $response = ['message' => 'File uploaded successfully, but failed to insert into the database.'];
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    // Database query preparation error
                    $response = ['message' => 'File uploaded successfully, but failed to prepare the database query.'];
                }
            } else {
                $response = ['message' => 'Failed to move the file'];
            }
        } else {
            $response = ['message' => 'Invalid file format. Only images are allowed.'];
        }
    } else {
        $response = ['message' => 'File upload error'];
    }

    // Send a JSON response back to the client
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Handle other HTTP request methods if necessary
    http_response_code(405); // Method Not Allowed
}
