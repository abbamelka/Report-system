<?php
// fetch_report_data.php
include('db.php'); // Include the database connection file

// Default query for fetching all reports
$query = "SELECT * FROM report";

// Check if area, uname, or type is passed as a search parameter
$conditions = [];
if (isset($_GET['area']) && !empty($_GET['area'])) {
    $conditions[] = "area = '" . mysqli_real_escape_string($conn, $_GET['area']) . "'";
}

if (isset($_GET['uname']) && !empty($_GET['uname'])) {
    $conditions[] = "uname = '" . mysqli_real_escape_string($conn, $_GET['uname']) . "'";
}

if (isset($_GET['type']) && !empty($_GET['type'])) {
    $conditions[] = "Reporttype = '" . mysqli_real_escape_string($conn, $_GET['type']) . "'";
}

if (count($conditions) > 0) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

// Execute the query
$result = mysqli_query($conn, $query);

// Fetch the results and send them as JSON
$reports = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reports[] = $row;
}

echo json_encode($reports); // Send the data back as JSON
?>
