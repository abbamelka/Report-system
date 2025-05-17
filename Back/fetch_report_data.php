<?php
// Include your database connection
include('db.php');

// Get the area type from the AJAX request
if(isset($_GET['area'])) {
    $area = $_GET['area'];
    
    // Query to count reports by area type
    $query = "SELECT COUNT(*) as report_count FROM report WHERE area = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $area);  // 's' means string
    $stmt->execute();
    $stmt->bind_result($report_count);
    $stmt->fetch();
    $stmt->close();

    // Return the report count as a JSON response
    echo json_encode(['report_count' => $report_count]);
}
?>
