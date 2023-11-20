<?php
session_start();

include_once '../../../db/db_conn.php';
include_once '../../../config/pusher.php';

$fclt_id = $_SESSION['fcltid'];
$fclt_name = $_SESSION["fcltname"];
date_default_timezone_set('Asia/Manila');
$date = date("Y-m-d");
$time = date("h:i A");

    if (isset($_SESSION['fcltid'])) {
        $sender_id = mysqli_real_escape_string($conn, $_POST['sender_id']);
        $receiver_id = mysqli_real_escape_string($conn, $_POST['receiver_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        if(empty($receiver_id)){
            echo "Select Contact First ";
        }

        if (!empty($message)) {
            $stmt = $conn->prepare("INSERT INTO messages (sender_id, message, receiver_id, date, time) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $sender_id, $message, $receiver_id, $date, $time);
            $stmt->execute();
            echo htmlspecialchars("Message sent successfully", ENT_QUOTES, 'UTF-8');

            $data = $fclt_name;
            $pusher->trigger($receiver_id, 'message', $data);
        } else {
            echo "Message is empty";
        }
    } else {
        echo "User not authenticated";
    }
