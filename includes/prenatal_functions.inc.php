<?php
// Include the database connection file
include 'db_conn.php';

function getAllPatients() {
    global $conn, $fclt_id; // Access the existing database connection

    // Perform the query to fetch all rows from the "referrals" table
    $sql = "SELECT * FROM patients WHERE fclt_id = $fclt_id";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch all rows into an associative array
        $patients = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Free the result set
        mysqli_free_result($result);

        // Return the array of referrals
        return $patients;
    } else {
        // Handle query error (you may choose to log or display an error message)
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Return an empty array in case of an error
    return array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'get_first_trimester_columns') {
    // Fetch column names as before
    // ...
    
    // Send the column names as a JSON response
    echo json_encode(array('columns' => $columns));
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'insert_trimester_data') {
    // Prepare the SQL INSERT query
    $columns = array_keys($_POST);
    array_shift($columns); // Remove 'action' from columns
    $values = array_map(function($value) {
        // Escape and enclose values in quotes
        global $conn; // Use the existing connection
        return "'" . mysqli_real_escape_string($conn, $value) . "'";
    }, $_POST);
    array_shift($values); // Remove 'insert_trimester_data' from values
    
    $columnsStr = implode(',', $columns);
    $valuesStr = implode(',', $values);
    
    // Replace 'first_trimester' with your actual table name
    $table = 'first_trimester';
    
    // Prepare and execute the insert query
    $query = "INSERT INTO $table ($columnsStr) VALUES ($valuesStr)";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'error' => mysqli_error($conn)));
    }
}

function getPatientDetails($conn, $patientID) {
    $query = "SELECT patients.id, patients_details.* FROM patients LEFT JOIN patients_details ON patients.id = patients_details.patients_id WHERE id = $patientID";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);

    // Close the result and return the row
    mysqli_free_result($result);

    return $row;
}
