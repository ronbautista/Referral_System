<?php
session_start();
include_once '../../../db/db_conn.php';
require_once '../../../config/pusher.php';

$fclt_id = $_SESSION['fcltid'];
$uploadDirectory = '../assets/';
if (isset($_POST['add_staff']) && $_POST['add_staff'] === 'true') {

    if ($_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $originalFilename = $_FILES['profile_image']['name'];

        $randomNumbers = bin2hex(random_bytes(4));
        $newFilename = $randomNumbers . '_' . $originalFilename;

        $tempFile = $_FILES['profile_image']['tmp_name'];
        $targetFile = $uploadDirectory . $newFilename;

        // Check if the file already exists, and generate a new filename if needed
        $counter = 1;
        while (file_exists($targetFile)) {
            $newFilename = $randomNumbers . '_' . $counter . '_' . $originalFilename;
            $targetFile = $uploadDirectory . $newFilename;
            $counter++;
        }

        if (move_uploaded_file($tempFile, $targetFile)) {

            $fname = mysqli_real_escape_string($conn, $_POST['fname']);
            $mname = mysqli_real_escape_string($conn, $_POST['mname']);
            $lname = mysqli_real_escape_string($conn, $_POST['lname']);
            $contactNum = mysqli_real_escape_string($conn, $_POST['contactNum']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $role = mysqli_real_escape_string($conn, $_POST['role']);

            // Check if required fields are empty (except for middle name)
            if (empty($fname) || empty($lname) || empty($contactNum) || empty($address) || empty($role)) {
                echo json_encode(['error' => 'Required fields cannot be empty.']);
            } else {
                $img = $newFilename;

                $sql = "INSERT INTO staff (fname, mname, lname, contact_num, address, role, img, fclt_id) VALUES ('$fname', '$mname', '$lname', '$contactNum', '$address', '$role', '$img', '$fclt_id')";
                if ($conn->query($sql) === TRUE) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['error' => 'Failed to add entry to the database: ' . $conn->error]);
                }
            }
        } else {
            echo json_encode(['error' => 'Failed to move the file.']);
        }
    } else {
        echo json_encode(['error' => 'File upload error.']);
    }
}

if (isset($_GET['view_staff'])) {
    $staff_id = $_GET['view_staff'];

    // Call the stored procedure
    $query = "CALL get_staff(?)";
    $stmt = mysqli_prepare($conn, $query);

    // Assuming 'i' is the correct type for patient_id; adjust if needed
    mysqli_stmt_bind_param($stmt, "i", $staff_id,);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Check for errors in the query execution
    if (!$result) {
        die('Error in query: ' . mysqli_error($conn));
    }

    // Check the number of rows
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_array($result);

        $res = [
            'status' => 200,
            'message' => 'Data fetched',
            'data' => $data
        ];
    } else {
        $res = [
            'status' => 404,
            'message' => 'Data not found'
        ];
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    echo json_encode($res);
}

if (isset($_GET['delete_staff'])) {
    $staff_id = $_GET['delete_staff'];

    // Call the stored procedure
    $query = "CALL remove_staff(?)";
    $stmt = mysqli_prepare($conn, $query);

    // Assuming 'i' is the correct type for staff_id; adjust if needed
    mysqli_stmt_bind_param($stmt, "i", $staff_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Check for errors in the query execution
    if (!$stmt) {
        die('Error in query: ' . mysqli_error($conn));
    }

    // Check the number of affected rows
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $res = [
            'status' => 200,
            'message' => 'Staff Removed'
        ];
    } else {
        $res = [
            'status' => 404,
            'message' => 'Data not found'
        ];
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    echo json_encode($res);
}