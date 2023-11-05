<?php
if (isset($_POST['getc_columns']) && $_POST['getc_columns'] === 'true') {
    $table_name = $_POST['table_name'];

    // Include the database connection file
    include('db_conn.php');

    $response = array();

    // Replace with your database query logic
    $columns = fetchColumnsForTab($conn, $table_name);

    if ($columns) {
        $response['success'] = true;
        $response['columns'] = $columns;
    } else {
        $response['success'] = false;
        $response['message'] = 'Error fetching columns.';
    }

    // Echo the JSON-encoded response
    echo json_encode($response);
    exit;
}

function fetchColumnsForTab($connection, $tabName) {
    $columns = array();

    // Generate a SQL query to fetch all columns from the specified table
    $sql = "SHOW COLUMNS FROM $tabName";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $columns[] = $row['Field'];
        }
    }

    return $columns;
}
