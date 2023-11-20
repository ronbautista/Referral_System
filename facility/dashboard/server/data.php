<?php
        $sql2 = "SELECT * FROM messages WHERE (receiver_id = {$row['fclt_id']} OR sender_id = {$row['fclt_id']}) AND (receiver_id = {$fclt_id} OR sender_id = {$fclt_id}) ORDER BY id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        if(mysqli_num_rows($query2) > 0){
            $result = $row2['message'];
        }else{
            $result = "No message yet";
        }

        (strlen($result) > 28) ? $message = substr($result, 0, 28) : $message = $result;
        $output .= '<div class="referral-card message-contact" data-contact-id="'. $row['fclt_id'] .'">
        <div class="mini-referral-logo" id="message-logo">
            <img src="assets/person.png" alt="Logo" class="logo">
        </div>
        <div class="info">
            <div class="name">'. $row['fclt_name'] .'</div>
            <div class="description" id="latestMessage">
                '. $message .'
            </div>
        </div>
    </div>';