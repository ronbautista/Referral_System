<?php
if (isset($_POST['getc_columns']) && $_POST['getc_columns'] === 'true') {
    $table_name = $_POST['table_name'];
    $patients_id = $_POST['patients_id'];
    $check_up_value = $_POST['Check_up']; // Get the Check-up value

    // Include the database connection file
    include('db_conn.php');

    $response = array();

    // Check if data exists for the given ID, table, and Check-up value
    $existingData = fetchDataForIDAndTable($conn, $patients_id, $table_name, $check_up_value);

    if ($existingData) {
        $response['success'] = true;
        $response['data'] = $existingData;
    } else {
        $response['success'] = false;
        $response['message'] = 'No data found for ID ' . $patients_id . ' in table ' . $table_name . ' with Check-up value ' . $check_up_value;
    }

    // Echo the JSON-encoded response
    echo json_encode($response);
    exit;
}

function fetchDataForIDAndTable($connection, $id, $table, $checkUp) {
    $data = array();

    // Modify this query to fetch data from the specified table for the given ID and Check-up value
    $sql = "SELECT * FROM $table WHERE patients_id = '$id' AND `check-up` = '$checkUp'";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    return $data;
}

