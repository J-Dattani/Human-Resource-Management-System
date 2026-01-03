<?php
session_start();
include("../config/db.php");

$emp_id = $_SESSION['emp_id'];
$date = date("Y-m-d");
$time = date("H:i:s");

/* Get or create attendance */
$att = mysqli_query($conn,
    "SELECT * FROM attendance WHERE emp_id=$emp_id AND date='$date'"
);

if(mysqli_num_rows($att)==0){
    mysqli_query($conn,
        "INSERT INTO attendance (emp_id, date) VALUES ($emp_id,'$date')"
    );
    $attendance_id = mysqli_insert_id($conn);
}else{
    $attendance = mysqli_fetch_assoc($att);
    $attendance_id = $attendance['attendance_id'];
}

/* Get last log */
$last = mysqli_query($conn,
    "SELECT * FROM attendance_logs
     WHERE attendance_id=$attendance_id
     ORDER BY log_id DESC LIMIT 1"
);
$last_log = mysqli_fetch_assoc($last);
$next_action = (!$last_log || $last_log['log_type']=='OUT') ? 'IN' : 'OUT';

/* Handle punch */
if($_SERVER['REQUEST_METHOD']=='POST'){
    mysqli_query($conn,
        "INSERT INTO attendance_logs (attendance_id, log_type, log_time)
         VALUES ($attendance_id,'$next_action','$time')"
    );
    header("Location: attendance.php");
}
?>
