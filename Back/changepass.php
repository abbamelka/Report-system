<?php
session_start();

// Include the database connection
include('db.php'); // Include your db.php file with the connection

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // You can access session data like this
    $userId = $_SESSION['id'];
    $username = $_SESSION['username'];
    $userType = $_SESSION['usertype'];

    //echo "Welcome, $username!";  // Display username
} else {
    // User is not logged in, redirect to login page
    header('Location: ../user/login.php');
    exit;
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the current and new passwords from the form
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Input validation
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['message'] = "All fields are required.";
        header('Location:../Front/main/changePassword.php');
        exit;
    }

    if ($new_password !== $confirm_password) {
        $_SESSION['message'] = "New password and confirmation do not match.";
        header('Location:../Front/main/changePassword.php');
        exit;
    }

    // Retrieve the current password from the database
    $stmt = $conn->prepare("SELECT Userpassword FROM userTable WHERE id = ?");
    $stmt->bind_param("i", $userId); // Bind user_id to the prepared statement
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($stored_password);
    $stmt->fetch();

    if (!$stored_password || !password_verify($current_password, $stored_password)) {
        $_SESSION['message'] = "Current password is incorrect.";
        header('Location: ../Front/main/changePassword.php');
        exit;
    }

    // Hash the new password
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    /*
    $update_stmt = $conn->prepare("UPDATE userTable SET Userpassword = ? WHERE id = ?");
    $update_stmt->bind_param("si", $hashed_new_password, $user_id); // Bind new password and user_id
    if ($update_stmt->execute()) {
        $_SESSION['message'] = "Password changed successfully!".$userId ."". $new_password;
    } else {
        $_SESSION['message'] = "Error updating password.";
    }

    // Close statements
    $stmt->close();
    $update_stmt->close();
*/
// Construct the SQL query directly
$sql = "UPDATE userTable SET Userpassword = '$hashed_new_password' WHERE id = $userId";

// Execute the query
if ($conn->query($sql)) {
    $_SESSION['message'] = "Password changed successfully!".$userId ."". $new_password;;
} else {
    $_SESSION['message'] = "Error updating password. " . $conn->error;
}
    // Redirect back to the change password page
    header('Location: ../Front/main/changePassword.php');
    exit;
}
