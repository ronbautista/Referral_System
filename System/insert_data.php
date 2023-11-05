<?php

include_once 'db_conn.php';
require_once 'pusher.php';

session_start();
$fclt_id = $_SESSION['id'];
$fclt_name = $_SESSION["names"];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['table_name']) && isset($_POST['Check-up']) && isset($_POST['patients_id'])) {
        $table_name = $_POST['table_name'];
        $check_up_value = $_POST['Check-up'];
        $patients_id = $_POST['patients_id'];

        $formData = $_POST;
        unset($formData['table_name']);
        unset($formData['Check-up']);
        unset($formData['patients_id']);

        include('db_conn.php');

        $columns = array_keys($formData);
        $columnsString = implode(', ', array_map(function ($column) {
            return "`$column`";
        }, $columns));

        $values = array_map(function ($value) use ($conn) {
            return "'" . mysqli_real_escape_string($conn, $value) . "'";
        }, $formData);
        
        $values[] = "'" . mysqli_real_escape_string($conn, $check_up_value) . "'";
        $values[] = "'" . mysqli_real_escape_string($conn, $patients_id) . "'";
        
        $valuesString = implode(', ', $values);
        
        $query = "INSERT INTO $table_name ($columnsString, `check-up`, `patients_id`) VALUES ($valuesString)";

        if (mysqli_query($conn, $query)) {
            $response = array('success' => true, 'message' => 'Data inserted successfully', 'reloadPage' => true);
            $pusher->trigger('my-channel', 'my-event', array('message' => 'New Prenatal from ' . $fclt_name));
        } else {
            $response = array('success' => false, 'message' => 'Error inserting data: ' . mysqli_error($conn), 'reloadPage' => false);
        }        

        // Send a JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'message' => 'Missing table_name, Check-up, or patients_id parameter.');
        // Send a JSON response for the missing parameters
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
