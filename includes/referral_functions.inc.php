<?php
include 'db_conn.php';

function displayAllReferralsPending() {
    global $conn, $fclt_id; // Access the existing database connection

    // Perform the query to fetch all rows from the "referrals" table
    $sql = "SELECT referral_forms.*, referral_records.*, facilities.*, referral_transaction.status
    FROM referral_forms LEFT JOIN referral_records ON referral_forms.id = referral_records.rfrrl_id
    LEFT JOIN facilities ON facilities.fclt_id = referral_records.fclt_id
    LEFT JOIN referral_transaction ON referral_records.rfrrl_id = referral_transaction.rfrrl_id
    WHERE referral_transaction.status IS NULL";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch all rows into an associative array
        $referrals = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Free the result set
        mysqli_free_result($result);

        // Return the array of referrals
        return $referrals;
    } else {
        // Handle query error (you may choose to log or display an error message)
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Return an empty array in case of an error
    return array();
}

function displayAllReferralTransaction() {
    global $conn, $fclt_id; // Access the existing database connection

    // Perform the query to fetch all rows from the "referrals" table
    $sql = "SELECT * FROM referral_forms
    RIGHT JOIN referral_records ON referral_forms.id = referral_records.rfrrl_id
    RIGHT JOIN referral_transaction ON referral_forms.id = referral_transaction.rfrrl_id
    RIGHT JOIN facilities ON referral_records.fclt_id = facilities.fclt_id WHERE referral_transaction.fclt_id = $fclt_id
    ORDER BY referral_transaction.date DESC, referral_transaction.time ASC";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch all rows into an associative array
        $referrals = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Free the result set
        mysqli_free_result($result);

        // Return the array of referrals
        return $referrals;
    } else {
        // Handle query error (you may choose to log or display an error message)
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Return an empty array in case of an error
    return array();
}

function getAllReferrals() {
    global $conn; // Access the existing database connection

    // Perform the query to fetch all rows from the "referrals" table
    $sql = "SELECT * FROM referral_forms";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch all rows into an associative array
        $referrals = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Free the result set
        mysqli_free_result($result);

        // Return the array of referrals
        return $referrals;
    } else {
        // Handle query error (you may choose to log or display an error message)
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Return an empty array in case of an error
    return array();
}

function referral_format() {
    global $conn; // Access the existing database connection

    // Perform the query to fetch all rows from the "referrals" table
    $sql = "SHOW COLUMNS FROM referral_forms";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch all rows into an associative array
        $referrals = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Free the result set
        mysqli_free_result($result);

        // Return the array of referrals
        return $referrals;
    } else {
        // Handle query error (you may choose to log or display an error message)
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Return an empty array in case of an error
    return array();
}

function referrals() {
    global $conn; // Access the existing database connection

    // Perform the query to fetch all rows from the "referrals" table
    $sql = "SELECT referral_forms.*, facilities.fclt_name FROM referral_forms INNER JOIN referral_records ON referral_forms.id = referral_records.rfrrl_id INNER JOIN facilities ON referral_records.fclt_id = facilities.fclt_id";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch all rows into an associative array
        $referrals = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Free the result set
        mysqli_free_result($result);

        // Return the array of referrals
        return $referrals;
    } else {
        // Handle query error (you may choose to log or display an error message)
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Return an empty array in case of an error
    return array();
}


function myReferrals() {
    global $conn, $fclt_id;

    // Perform the query to fetch all rows from the "referrals" table
    $sql = "SELECT *
    FROM referral_forms
    JOIN referral_records
    ON referral_forms.id = referral_records.rfrrl_id
    JOIN facilities
    ON facilities.fclt_id = referral_records.fclt_id
    WHERE referral_records.fclt_id = $fclt_id";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch all rows into an associative array
        $referrals = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Free the result set
        mysqli_free_result($result);

        // Return the array of referrals
        return $referrals;
    } else {
        // Handle query error (you may choose to log or display an error message)
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Return an empty array in case of an error
    return array();
}

function minireferrals() {
    global $conn, $fclt_id;

    // Perform the query to fetch all rows from the "referrals" table
    $sql = "SELECT referral_forms.*, referral_records.*, facilities.*, referral_transaction.status, referral_records.time AS referral_records_time, referral_transaction.time AS referral_transaction_time
    FROM referral_forms LEFT JOIN referral_records ON referral_forms.id = referral_records.rfrrl_id
    LEFT JOIN facilities ON facilities.fclt_id = referral_records.fclt_id
    LEFT JOIN referral_transaction ON referral_records.rfrrl_id = referral_transaction.rfrrl_id
    ORDER BY referral_transaction.date ASC, referral_transaction.time ASC LIMIT 5";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch all rows into an associative array
        $referrals = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Free the result set
        mysqli_free_result($result);

        // Return the array of referrals
        return $referrals;
    } else {
        // Handle query error (you may choose to log or display an error message)
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Return an empty array in case of an error
    return array();
}