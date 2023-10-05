<?php
include_once 'db_conn.php';
require_once 'pusher.php';
session_start();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$fclt_id = $_SESSION['id'];
$fclt_name = $_SESSION["names"];

if(isset($_POST['delete_field'])){
    $field_name = mysqli_real_escape_string($conn, $_POST['field_name']);

    $query = "DELETE FROM referral_format WHERE field_name='$field_name'";
    $query_run = mysqli_query($conn, $query);

    $query = "ALTER TABLE referral_forms DROP COLUMN $field_name";
    $second_query_run = mysqli_query($conn, $query);

    if($query_run && $second_query_run){
        
        $res = [
            'status' => 200,
            'message' => 'Field deleted successfully'
        ];
        echo json_encode($res);
        $pusher->trigger('my-channel', 'my-event', array('message' => 'Field Deleted from ' . $field_name));
        return false;
    }else{
        $res = [
            'status' => 500,
            'message' => 'Field not deleted'
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_POST['delete_referral'])){
    $referral_id = mysqli_real_escape_string($conn, $_POST['referral_id']);

    $query = "DELETE FROM referral_forms WHERE id='$referral_id'";
    $query_run = mysqli_query($conn, $query);

    $query = "DELETE FROM referral_records WHERE rfrrl_id='$referral_id'";
    $second_query_run = mysqli_query($conn, $query);

    if($query_run && $second_query_run){
        
        $res = [
            'status' => 200,
            'message' => 'Field deleted successfully'
        ];
        echo json_encode($res);
        $pusher->trigger('my-channel', 'my-event', array('message' => 'Referral Deleted from ' . $fclt_name));
        return false;
    }else{
        $res = [
            'status' => 500,
            'message' => 'Field not deleted'
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_GET['rffrl_id'])){
    $rffrl_id = mysqli_real_escape_string($conn, $_GET['rffrl_id']);

    $query = "SELECT referral_forms.*, facilities.fclt_name FROM referral_records 
    LEFT JOIN referral_forms on referral_records.rfrrl_id = referral_forms.id 
    LEFT JOIN facilities ON referral_records.fclt_id = facilities.fclt_id where rfrrl_id = '$rffrl_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1){
        $rffrl = mysqli_fetch_array($query_run);
        
        $res = [
            'status' => 200,
            'message' => 'Referral fetch successfully by id',
            'data' => $rffrl
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'No id found'
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_GET['myrecord_rffrl_id'])){
    $rffrl_id = mysqli_real_escape_string($conn, $_GET['myrecord_rffrl_id']);

    $query = "SELECT referral_forms.*, referral_records.*, facilities.*
    FROM referral_forms
    INNER JOIN referral_records ON referral_forms.id = referral_records.rfrrl_id
    INNER JOIN facilities ON facilities.fclt_id = referral_records.referred_hospital
    WHERE rfrrl_id = '$rffrl_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1){
        $rffrl = mysqli_fetch_array($query_run);
        
        $res = [
            'status' => 200,
            'message' => 'Referral fetch successfully by id',
            'data' => $rffrl
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'No id found'
        ];
        echo json_encode($res);
        return false;
    }
}

if (isset($_POST['create_referral'])) {
    // Sanitize and retrieve data from the form fields
    $data = [];
    foreach ($_POST as $field => $value) {
        if ($field !== 'create_referral' && $field !== 'referred_hospital') {
            $data[$field] = mysqli_real_escape_string($conn, $value);
        }
    }

    $referred_hospital = mysqli_real_escape_string($conn, $_POST['referred_hospital']);

    $columns = implode(', ', array_keys($data));
    $values = "'" . implode("', '", $data) . "'";
    $sql = "INSERT INTO referral_forms ($columns) VALUES ($values)";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Additional actions after successful insertion
        $pusher->trigger('my-channel', 'my-event', array('message' => 'New Referral from ' . $fclt_name));
        $new_inserted_id = mysqli_insert_id($conn);

        date_default_timezone_set('Asia/Manila');
        $date = date("Y-m-d");
        $time = date("h:i A");

        // Insert into another table (referral_records) and include the referred_hospital value
        $query_another_table = "INSERT INTO referral_records (fclt_id, rfrrl_id, date, time, referred_hospital, status)
        VALUES ('$fclt_id', '$new_inserted_id', '$date', '$time', '$referred_hospital', 'Pending')";
        $query_another_table_run = mysqli_query($conn, $query_another_table);

        $notify_query = "INSERT INTO referral_notification (message, rfrrl_id, fclt_id, date, time, is_displayed) VALUES ('New referral', '$new_inserted_id', 
                          '$fclt_id', '$date', '$time', '0')";
        $notify_query_run = mysqli_query($conn, $notify_query);

        if ($query_another_table_run && $notify_query_run) {
            // Success message
            $response = [
                'status' => 200,
                'message' => 'Referral data inserted successfully',
            ];
        } else {
            // Error message
            $response = [
                'status' => 500,
                'message' => 'Error inserting data into another table: ' . mysqli_error($conn),
            ];
        }
    } else {
        // Error message if the main insertion fails
        $response = [
            'status' => 422,
            'message' => 'Error inserting referral data: ' . mysqli_error($conn),
        ];
    }

    // Return JSON response to your AJAX request
    echo json_encode($response);
}


if (isset($_POST['add_patient'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $contactNum = mysqli_real_escape_string($conn, $_POST['contactNum']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    if ($fname == NULL || $lname == NULL || $contactNum == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Field is mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    $query = "INSERT INTO patients (fname, mname, lname, contact, address, fclt_id) VALUES ('$fname',  '$mname', '$lname',  '$contactNum', '$address' , '$fclt_id')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Patient added successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        // At least one query failed
        $res = [
            'status' => 500,
            'message' => 'Patient not created successfully'
        ];
        echo json_encode($res);
        return false;
    }
    header('Content-Type: application/json');
    echo json_encode($responseArray);
}

if (isset($_POST['patients_details'])) {
    $patientID = mysqli_real_escape_string($conn, $_POST['patient_id']);
    $petsa_unang_checkup = mysqli_real_escape_string($conn, $_POST['petsa_unang_checkup']);
    $edad = mysqli_real_escape_string($conn, $_POST['edad']);
    $timbang = mysqli_real_escape_string($conn, $_POST['timbang']);
    $taas = mysqli_real_escape_string($conn, $_POST['taas']);
    $kalagayan_kalusugan = mysqli_real_escape_string($conn, $_POST['kalagayan_kalusugan']);
    $petsa_huling_regla = mysqli_real_escape_string($conn, $_POST['petsa_huling_regla']);
    $kailan_manganganak = mysqli_real_escape_string($conn, $_POST['kailan_manganganak']);
    $ilang_pagbubuntis = mysqli_real_escape_string($conn, $_POST['ilang_pagbubuntis']);

    if ($patientID == NULL || $petsa_unang_checkup == NULL || $edad == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }

    $query = "INSERT INTO patients_details (patients_id, petsa_unang_checkup, edad, timbang, taas, kalagayan_kalusugan, petsa_huling_regla, kailan_manganganak, ilang_pagbubuntis)
                VALUES ('$patientID', '$petsa_unang_checkup', '$edad', '$timbang', '$taas', '$kalagayan_kalusugan', '$petsa_huling_regla', '$kailan_manganganak', '$ilang_pagbubuntis')";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Patient added successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        // At least one query failed
        $res = [
            'status' => 500,
            'message' => 'Patient not created successfully'
        ];
        echo json_encode($res);
        return false;
    }
    header('Content-Type: application/json');
    echo json_encode($responseArray);
}


if (isset($_POST['login'])) {
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    if (empty($uid) || empty($pwd)) {
        $res = [
            'status' => 422,
            'message' => 'Username and password are mandatory'
        ];
        echo json_encode($res);
        return false;
    }

    $query = "SELECT * FROM users WHERE usersUid = '$uid'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $user = mysqli_fetch_assoc($query_run);
        if ($user) {
            // Continue with the password verification using the correct column name
            $hashed_password = $user['usersPwd']; // Use the correct column name

            // Verify the provided password against the stored hash
            if (password_verify($pwd, $hashed_password)) {
                $_SESSION["second_account"] = true;
                $_SESSION["userid"] = $user["usersId"];
                $_SESSION["usersname"] = $user["usersName"];
                $_SESSION["usersuid"] = $user["usersUid"];
                $_SESSION["usersrole"] = $user["usersrole"];

                // Return a JSON response for a successful login
                $res = [
                    'status' => 200,
                    'message' => 'Login successful',
                    // Include any additional data you want to return
                    'user_id' => $user["usersId"],
                    'user_name' => $user["usersName"]
                ];
                echo json_encode($res);
            } else {
                $res = [
                    'status' => 401,
                    'message' => 'Invalid username or password'
                ];
                echo json_encode($res);
            }
        } else {
            $res = [
                'status' => 401,
                'message' => 'Invalid username or password'
            ];
            echo json_encode($res);
        }
    } else {
        // Database query error
        $res = [
            'status' => 500,
            'message' => 'Database error. Unable to perform login.'
        ];
        echo json_encode($res);
    }
}

if (isset($_POST['save_field'])) {
    $field = mysqli_real_escape_string($conn, $_POST['field_name']);

    $field = str_replace(' ', '_', $field);

    if ($field == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Field is mandatory'
        ];
        echo json_encode($res);
        return false;
    }

    if (!preg_match('/^\d+$/', $field)) {

        // Execute the second query
        $query = "ALTER TABLE referral_forms ADD $field varchar(255)";
        $query_run = mysqli_query($conn, $second_query);
    } else {
        $res = [
            'status' => 300,
            'message' => 'Invalid Field Name'
        ];
        echo json_encode($res);
        return false;
    }

    if ($query_run) {
        // Both queries executed successfully
        $res = [
            'status' => 200,
            'message' => 'Both queries executed successfully',
            'field_name' => $field
        ];
        echo json_encode($res);
        return false;
    } else {
        // At least one query failed
        $res = [
            'status' => 500,
            'message' => 'One or both queries failed'
        ];
        echo json_encode($res);

        return false;
    }
}


if (isset($_POST['accept_referral'])) {
    $rfrrl_id = mysqli_real_escape_string($conn, $_POST['rffrl_id']);

    if ($rfrrl_id == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Field is mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d");
    $time = date("h:i A");

    $query = "UPDATE referral_records SET status ='Accepted' WHERE rfrrl_id='$rfrrl_id'";
    $query_run = mysqli_query($conn, $query);

    // Execute the second query
    $second_query = "INSERT INTO referral_transaction (fclt_id, rfrrl_id, status, date, time) VALUES ('$fclt_id', '$rfrrl_id', 'Accepted', '$date', '$time')";
    $second_query_run = mysqli_query($conn, $second_query);

    $third_query = "INSERT INTO referral_notification (message, rfrrl_id, fclt_id, date, time) VALUES ('Referral Accepted', '$rfrrl_id', '$fclt_id', '$date', '$time')";
    $third_query_run = mysqli_query($conn, $third_query);

    if ($query_run && $second_query_run && $third_query_run) {
        // Both queries executed successfully
        $res = [
            'status' => 200,
            'message' => 'Both queries executed successfully'
        ];
        echo json_encode($res);
        $pusher->trigger('my-channel', 'my-event', array('message' => 'Referral accepted by: ' . $fclt_name));
        return false;
        
    } else {
        // At least one query failed
        $res = [
            'status' => 500,
            'message' => 'One or both queries failed'
        ];
        echo json_encode($res);
        return false;
    }
    
}

if (isset($_POST['decline_referral'])) {
    $rfrrl_id = mysqli_real_escape_string($conn, $_POST['rffrl_id']);

    if ($rfrrl_id == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Field is mandatory'
        ];
        echo json_encode($res);
        return false;
    }

    date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d");
    $time = date("h:i A");

    $query = "UPDATE referral_records SET status ='Declined' WHERE rfrrl_id='$rfrrl_id'";
    $query_run = mysqli_query($conn, $query);

    // Execute the second query
    $second_query = "INSERT INTO referral_transaction (fclt_id, rfrrl_id, status, date, time) VALUES ('$fclt_id', '$rfrrl_id', 'Declined', '$date', '$time')";
    $second_query_run = mysqli_query($conn, $second_query);

    $third_query = "INSERT INTO referral_notification (message, rfrrl_id, fclt_id, date, time) VALUES ('Referral Declined', '$rfrrl_id', '$fclt_id', '$date', '$time')";
    $third_query_run = mysqli_query($conn, $third_query);

    if ($query_run && $second_query_run && $third_query_run) {
        // Both queries executed successfully
        $res = [
            'status' => 200,
            'message' => 'Both queries executed successfully'
        ];
        echo json_encode($res);
        $pusher->trigger('my-channel', 'my-event', array('message' => 'Referral declined by: ' . $fclt_name));
        return false;
    } else {
        // At least one query failed
        $res = [
            'status' => 500,
            'message' => 'One or both queries failed'
        ];
        echo json_encode($res);
        return false;
    }
}

if (isset($_POST['send_message'])) {
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $contact_id = mysqli_real_escape_string($conn, $_POST['contact_id']); // Get the contact ID

    if ($message == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Field is mandatory'
        ];
        echo json_encode($res);
        return false;
    } else {
        date_default_timezone_set('Asia/Manila');
        $date = date("Y-m-d");
        $time = date("h:i:s A");

        // Use $contact_id in your SQL query
        $query = "INSERT INTO messages (user1, message, user2, date, time) VALUES ('$fclt_id', '$message', '$contact_id', '$date', '$time')";
        $query_run = mysqli_query($conn, $query);
    }

    if ($query_run) {
        $pusher->trigger('my-channel', 'my-event', array('message' => 'New Message from ' . $fclt_name));
        $res = [
            'status' => 200,
            'message' => 'Message successfully sent'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Message failed'
        ];
        echo json_encode($res);
        return false;
    }
}

if (isset($_GET['contact_id'])) {
    $contactId = mysqli_real_escape_string($conn, $_GET['contact_id']);

    $responseData = [];

    // Modify your SQL query to include ORDER BY time
    $query = "SELECT * FROM messages WHERE (user1 = '$fclt_id' AND user2 = '$contactId') OR (user1 = '$contactId' AND user2 = '$fclt_id') ORDER BY date ASC, time ASC";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            // Add a 'type' property to indicate if it's a sent or received message
            $messageType = ($row['user1'] == $fclt_id) ? 'sent' : 'received';
            
            $responseData[] = [
                'message' => $row['message'],
                'type' => $messageType,
            ];
        }

        echo json_encode($responseData);
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}

if (isset($_GET['message_contact_id'])) {
    $contactId = mysqli_real_escape_string($conn, $_GET['message_contact_id']);

    $responseData = [];

    // Modify your SQL query to include ORDER BY time
    $query = "SELECT * FROM messages 
          WHERE (user1 = '$fclt_id' AND user2 = '$contactId') 
          OR (user1 = '$contactId' AND user2 = '$fclt_id') 
          ORDER BY date DESC, time DESC 
          LIMIT 1";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if ($query_run->num_rows > 0) {
            $row = $query_run->fetch_assoc();
            $latestMessage = $row["message"];
            $time = $row["time"]; // Get the time value
            
            // Create an array to hold the latest message and time
            $response = array(
                'latestMessage' => $latestMessage,
                'time' => $time
            );
            
            // Send the response as JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }else {
        // Handle the case where there was an error in the query
        echo json_encode(array('error' => 'Error executing the query.'));
    }
    
    $conn->close();
}











