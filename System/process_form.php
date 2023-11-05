<?php

include_once 'db_conn.php';
require_once 'pusher.php';
session_start();
$fclt_id = $_SESSION['id'];
$fclt_name = $_SESSION["names"];

// Ensure that the form was submitted
if (isset($_POST['submit_form'])) {
    // Remove the 'submit_form' key from the $_POST array as it's not needed for insertion
    unset($_POST['submit_form']);

    // Loop through the fields from the form and build the data to be inserted
    $columns = [];
    $values = [];
    foreach ($_POST as $field_name => $field_value) {
        $column_name = mysqli_real_escape_string($conn, $field_name);
        $field_value = mysqli_real_escape_string($conn, $field_value);
        $columns[] = $column_name;
        $values[] = "'" . $field_value . "'";
    }

    // Join the column names and values into a comma-separated string
    $columns_str = implode(', ', $columns);
    $values_str = implode(', ', $values);

    // Create and execute the INSERT query
    $query = "INSERT INTO referral_forms ($columns_str) VALUES ($values_str)";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $pusher->trigger('my-channel', 'my-event', array('message' => 'New Referral from ' . $fclt_name));
        // Get the ID of the newly inserted row
        $new_inserted_id = mysqli_insert_id($conn);

        date_default_timezone_set('Asia/Manila');
        $date = date("Y-m-d");
        $time = date("h:i A");

        // Use the $new_inserted_id to insert into another table
        $query_another_table = "INSERT INTO referral_records (fclt_id, rfrrl_id, status) VALUES ('$fclt_id', '$new_inserted_id', 'pending')";
        $query_another_table_run = mysqli_query($conn, $query_another_table);

        $notify_query = "INSERT INTO referral_notification (message, rfrrl_id, fclt_id, date, time, is_displayed) VALUES ('New referral', '$new_inserted_id', 
                          '$fclt_id', '$date', '$time', '0')";
        $notify_query_run = mysqli_query($conn, $notify_query);

        if ($query_another_table_run && $notify_query_run) {
            echo "Data inserted successfully!";
            header("Location: index.php");
            exit();
        } else {
            echo "Error inserting into another table: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
