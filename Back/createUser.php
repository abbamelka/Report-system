<?php

 // Connect to MySQL database
 include 'db.php'; 
// Initialize the message variable
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form inputs
    if (isset($_POST['uname']) && isset($_POST['password'])) {
        $uname = $_POST['uname'];
        $password = $_POST['password'];

        // Add system date
        $date = date('Y-m-d H:i:s');  // Current date and time

        // Set default user type
        $user_type = 'normal';  // Default type is normal

        // Encrypt the password
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);  // Encrypt the password

       

        

        // Prepare the SQL query to insert data into the 'user' table
        $sql = "INSERT INTO userTable (uname, usertype, Userpassword, Creationdate) 
                VALUES ('$uname','$user_type', '$encrypted_password', '$date')";

        // Execute the query and check for success
        if ($conn->query($sql) === TRUE) {
            // Redirect back to the form page with a success message
            $message = "New user registered successfully!";
        } else {
            // If there was an error, set an error message
            $message = "Error: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        // If uname or password is missing, show an error message
        $message = "Please fill in both fields.";
    }

    // Redirect back to the form with the message in the URL
    header("Location: ../Front/main/Admin/Addrep.php?message=" . urlencode($message));
    exit();
}
?>
