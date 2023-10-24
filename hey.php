<?php
include_once 'db_conn.php';
include_once 'includes/prenatal_functions.inc.php';

$specificID = 31;
$row = getPatientDetails($conn, $specificID);
$columnNames = ($row) ? array_keys($row) : [];

?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <form method="post" action="process_form.php">
        <?php
        foreach ($columnNames as $columnName) {
            if ($columnName != 'patients_id' && $columnName != 'patients_details_id' && $columnName != 'id') {
                echo '<label for="' . $columnName . '">' . $columnName . '</label>';
                echo '<input type="text" name="' . $columnName . '" id="' . $columnName . '" value="' . ($row ? $row[$columnName] : '') . '"><br>';
            }
        }
        ?>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
