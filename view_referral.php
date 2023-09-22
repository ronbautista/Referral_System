<?php
// Include your database connection or any required files
include 'db_conn.php';

// Get the referral ID from the URL
if (isset($_GET['id'])) {
    $referralId = $_GET['id'];

    // Fetch referral details from the database based on the ID
    $sql = "SELECT * FROM referrals WHERE id = $referralId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $referral = $result->fetch_assoc();
        // Now you have the referral details, and you can display them
    } else {
        echo "Referral not found.";
    }
} else {
    echo "Invalid referral ID.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Referral</title>
    <!-- Include any necessary CSS or meta tags -->
</head>
<body>
    <h1>Referral Details</h1>
    <?php if (isset($referral)) { ?>
        <p>Referral ID: <?php echo $referral['id']; ?></p>
        <p>Field Name: <?php echo $referral['field_name']; ?></p>
        <p>Facility ID: <?php echo $referral['fclt_id']; ?></p>
        <!-- Display more referral details here -->
    <?php } ?>
    <a href="accepted_referrals.php">Back to Accepted Referrals</a>
</body>
</html>
