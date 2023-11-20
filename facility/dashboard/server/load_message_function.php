<?php
include_once '../../../db/db_conn.php';

session_start();

$fclt_id = $_SESSION['fcltid'];
$fclt_name = $_SESSION["fcltname"];
$output = "";

    if (isset($_SESSION['fcltid'])) {
        $sender_id = mysqli_real_escape_string($conn, $_POST['sender_id']);
        $receiver_id = mysqli_real_escape_string($conn, $_POST['receiver_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

            $sql = "SELECT * FROM messages WHERE (receiver_id = '$receiver_id' AND sender_id = '$sender_id') OR (receiver_id = '$sender_id' AND sender_id = '$receiver_id') ORDER BY id ASC";

            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                    if($row['receiver_id'] === $receiver_id){
                        $output .= '<div class="sender" id="sender-messages" data-toggle="tooltip" data-placement="top" title="'. $row['time'] .'">
                                        '. $row['message'] .'
                                    </div>';
                    }else{
                        $output .= '<div class="receiver" id="receiver-messages" data-toggle="tooltip" data-placement="top" title="'. $row['time'] .'">
                                        '. $row['message'] .'
                                    </div>';
                    }
                }
                echo $output;
            }

    } else {
        echo "User not authenticated";
    }
