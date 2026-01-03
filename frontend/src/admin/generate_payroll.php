<?php
session_start();
include '../config/db.php';

header('Content-Type: application/json');

// 1. Strict Role Check (Admin Only)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized access.']);
    exit();
}

// 2. Input Validation
if (!isset($_POST['month'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Month is required (YYYY-MM).']);
    exit();
}

$month = mysqli_real_escape_string($conn, $_POST['month']); // Format: YYYY-MM
$generatedCount = 0;
$updatedCount = 0;

// 3. Fetch All Active Employees with Salary Structure
$sql = "SELECT ss.*, e.emp_id, e.first_name, e.last_name 
        FROM salary_structures ss 
        JOIN employees e ON ss.emp_id = e.emp_id";

$result = mysqli_query($conn, $sql);

if (!$result) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error fetching structures: ' . mysqli_error($conn)]);
    exit();
}

while ($row = mysqli_fetch_assoc($result)) {
    $emp_id = $row['emp_id'];
    $base_salary = floatval($row['basic_salary']);

    // Components
    $hra = floatval($row['hra']);
    $std_allow = floatval($row['standard_allowance']);
    $bonus = floatval($row['performance_bonus']);
    $lta = floatval($row['lta']);
    $fixed = floatval($row['fixed_allowance']);

    $pf_emp = floatval($row['pf_employee']);
    $pf_employer = floatval($row['pf_employer']); // For info only
    $prof_tax = floatval($row['prof_tax']);

    // Legacy/Generic Allowances/Deductions backup (if used)
    $legacy_allow = floatval($row['allowances']);
    $legacy_deduct = floatval($row['deductions']);

    // Server-Side Calculation Logic
    // Gross Salary = Base + Components + Legacy
    $gross_salary = $base_salary + $hra + $std_allow + $bonus + $lta + $fixed + $legacy_allow;

    // Total Deductions
    $total_deductions = $pf_emp + $prof_tax + $legacy_deduct;

    $net_salary = $gross_salary - $total_deductions;

    // Ensure no negative salary
    if ($net_salary < 0)
        $net_salary = 0;

    // 5. Persist to payroll_history
    // Check if record exists for this month
    $checkQ = "SELECT id FROM payroll_history WHERE emp_id='$emp_id' AND month='$month'";
    $checkRes = mysqli_query($conn, $checkQ);

    if (mysqli_num_rows($checkRes) > 0) {
        // Update existing
        $updateQ = "UPDATE payroll_history SET 
                    base_salary='$base_salary', 
                    hra='$hra', standard_allowance='$std_allow', performance_bonus='$bonus', lta='$lta', fixed_allowance='$fixed',
                    pf_employee='$pf_emp', pf_employer='$pf_employer', prof_tax='$prof_tax',
                    total_allowance='" . ($gross_salary - $base_salary) . "', 
                    total_deduction='$total_deductions', 
                    net_salary='$net_salary'
                    WHERE emp_id='$emp_id' AND month='$month'";
        if (mysqli_query($conn, $updateQ)) {
            $updatedCount++;
        }
    } else {
        // Insert new
        $insertQ = "INSERT INTO payroll_history 
                    (emp_id, month, base_salary, hra, standard_allowance, performance_bonus, lta, fixed_allowance, pf_employee, pf_employer, prof_tax, total_allowance, total_deduction, net_salary, payment_date, status) 
                    VALUES 
                    ('$emp_id', '$month', '$base_salary', '$hra', '$std_allow', '$bonus', '$lta', '$fixed', '$pf_emp', '$pf_employer', '$prof_tax', '" . ($gross_salary - $base_salary) . "', '$total_deductions', '$net_salary', CURDATE(), 'Pending')";
        if (mysqli_query($conn, $insertQ)) {
            $generatedCount++;
        }
    }
}

// 6. Return Success Response
echo json_encode([
    'success' => true,
    'message' => "Payroll generated for $month. Created: $generatedCount, Updated: $updatedCount.",
    'stats' => ['created' => $generatedCount, 'updated' => $updatedCount]
]);
?>