<?php
include 'db_conn.php';

function createPatient($conn, $fname, $mname, $lname, $age, $sex) {
    $sql = "INSERT INTO patients(fname, mname, lname, age,sex)
            VALUES (?, ?, ?, ?, ?);";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
header("Location: ../prenatal.php?error=stmtfailed");
exit();
}

mysqli_stmt_bind_param($stmt, "sssis",$fname, $mname, $lname, $age, $sex);

mysqli_stmt_execute($stmt);
$newPatientID = mysqli_insert_id($conn);
mysqli_stmt_close($stmt);
header("Location: ../add_prenatal.php?id=$newPatientID");
exit();

}