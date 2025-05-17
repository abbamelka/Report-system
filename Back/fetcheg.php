<?php
// fetch_report_data.php
include('db.php'); // Include the database connection file
session_start();

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // You can access session data like this
    $userId = $_SESSION['id'];
    $username = $_SESSION['username'];
    $userType = $_SESSION['usertype'];
} else {
    // User is not logged in, redirect to login page
    header('Location: ../user/login.php');
    exit;
}

// Default query for fetching all reports
$query = "SELECT * FROM report";

// Check if area, uname, type, or date is passed as search parameters
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

if (isset($_GET['date']) && !empty($_GET['date'])) {
   // $conditions[] = "Creationdate = '" . mysqli_real_escape_string($conn, $_GET['date']) . "'";
   // Escape the input date
   $date = mysqli_real_escape_string($conn, $_GET['date']);
    
   // Modify the condition to compare only the date part
  // $conditions[] = "DATE(Creationdate) = STR_TO_DATE('$date', '%d/%m/%y')";
  $conditions[] = "DATE_FORMAT(Creationdate, '%y/%m/%d') = '$date'";
}

// Add conditions to the query if any
if (count($conditions) > 0) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

// Pagination parameters
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$resultsPerPage = isset($_GET['resultsPerPage']) ? (int)$_GET['resultsPerPage'] : 5; // Default to 5 results per page
$offset = ($page - 1) * $resultsPerPage;

// Get the total number of results for pagination
$totalQuery = "SELECT COUNT(*) as total FROM report";
if (count($conditions) > 0) {
    $totalQuery .= " WHERE " . implode(" AND ", $conditions);
}
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalResults = $totalRow['total'];

// Modify the query to fetch results for the current page
$query .= " LIMIT $offset, $resultsPerPage";

// Execute the query
$result = mysqli_query($conn, $query);

// Check for query execution errors
if (!$result) {
    echo json_encode(['error' => mysqli_error($conn)]);
    exit;
}

// Fetch the results and send them as JSON
$reports = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reports[] = $row;
}

// Return the results and total count as JSON
echo json_encode(['results' => $reports, 'totalResults' => $totalResults]);
?>