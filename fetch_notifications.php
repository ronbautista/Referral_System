<?php
// Include your existing db_con.php file
include 'db_conn.php';

// Fetch new notifications that haven't been displayed yet
$sql = "SELECT referral_notification.*, facilities.fclt_name FROM referral_notification
        INNER JOIN facilities ON referral_notification.fclt_id = facilities.fclt_id WHERE is_displayed = 0";
$result = $conn->query($sql);

$notifications = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = array(
            'id' => $row['id'],
            'message' => $row['message'],
            'rfrrl_id' => $row['rfrrl_id'],
            'fclt_id' => $row['fclt_id'],
            'date' => $row['date'],
            'time' => $row['time'],
            'fclt_name' => $row['fclt_name']
        );

        // Mark the notification as displayed
        $updateSql = "UPDATE referral_notification SET is_displayed = 1 WHERE id = " . $row['id'];
        $conn->query($updateSql);

    }
}

// Close the database connection
$conn->close();

// Return the notifications as JSON
header('Content-Type: application/json');
echo json_encode($notifications);
?>
