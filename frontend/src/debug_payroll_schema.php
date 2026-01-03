<?php
include 'config/db.php';
function describeTable($conn, $table)
{
    echo "Table: $table\n";
    $result = mysqli_query($conn, "DESCRIBE $table");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['Field'] . " | " . $row['Type'] . "\n";
        }
    } else {
        echo "Error: " . mysqli_error($conn) . "\n";
    }
    echo "-----------------\n";
}
describeTable($conn, 'salary_structures');
describeTable($conn, 'payroll_history');
?>