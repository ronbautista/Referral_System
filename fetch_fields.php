<?php
include_once 'db_conn.php';
require_once 'pusher.php';

// Perform a query to fetch the field data from the database
$query = "SELECT field_name FROM referral_format";
$query_run = mysqli_query($conn, $query);

$fields = array();

if ($query_run) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        $fields[] = $row;
    }
}

// Close the database connection if needed

// Return the field data as JSON
header('Content-Type: application/json');
echo json_encode($fields);
?>
