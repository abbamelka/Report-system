<?php
// Start the session (if you need session management elsewhere)
session_start();

// Include database connection
include('db.php');

// Check if user is logged in (assuming 'uname' is stored in session)
if (isset($_SESSION['id'])) {
    // Retrieve data from the session and form
    $uname = $_SESSION['username'];  // Username from session
    $reportType = $_POST['Reporttype'];  // Get report type from POST data
    $area = $_POST['area'];  // Get area from POST data
    $reportSubject = $_POST['Reportsubject'];  // Get report subject from POST data
    $detail = $_POST['detail'];  // Get report detail from POST data
    $date = date('Y-m-d');  // Current server date and time (you can adjust the format)

    // Validate inputs (basic example, you can improve this with more checks)
    if (empty($reportType) || empty($area) || empty($reportSubject) || empty($detail)) {
        // Redirect with error message if validation fails
        header('Location: ../Front/main/Addrep.php?message=All fields are required!');
        exit;
    }

    // Prepare the SQL query to insert the report data into the database
    $stmt = $conn->prepare("INSERT INTO report (Reporttype, area, Reportsubject, detail, uname, Creationdate) 
                            VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameters to the SQL query
    $stmt->bind_param("ssssss", $reportType, $area, $reportSubject, $detail, $uname, $date);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        // Redirect with success message if insertion is successful
        header('Location: ../Front/main/Addrep.php?message=Report successfully submitted!');
    } else {
        // Redirect with error message if there was an issue
        header('Location: ../Front/main/Addrep.php?message=Error: ' . urlencode($stmt->error));
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // User is not logged in, redirect to login page
    header('Location:../Front/user/login.php');
    exit;
}

// Close the database connection
$conn->close();
?>
