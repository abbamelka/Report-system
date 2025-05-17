<?php
session_start();

// Include your database connection file
include 'db.php'; // Adjust this path as needed

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL query to check if the user exists
    $query = "SELECT id, uname, Userpassword, usertype FROM userTable WHERE uname = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $uname, $storedPassword, $userType);

    if ($stmt->num_rows > 0) {
        // User found, now verify the password
        $stmt->fetch();

        // Check if the user is admin (password is stored as plaintext)
        if ($userType == 'admin') {
            // For admin, compare passwords directly (since password is stored as plain text)
            if ($password === $storedPassword) {
                // Admin login successful
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $uname;
                $_SESSION['usertype'] = $userType;

                // Redirect to admin dashboard
                header('Location: ../Front/main/admin/index.php');
                exit;
            } else {
                // Invalid password for admin
                $message = 'Invalid password for admin.';
                header("Location: ../Front/user/login.php?message=" . urlencode($message));
                exit;
            }
        } else {
            // For normal users, verify the password using password_verify
            if (password_verify($password, $storedPassword)) {
                // Normal user login successful
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $uname;
                $_SESSION['usertype'] = $userType;

                // Redirect to normal user dashboard
                header('Location: ../Front/main/index.php');
                exit;
            } else {
                // Invalid password for normal user
                $message = 'Invalid password.';
                header("Location:  ../Front/user/login.php?message=" . urlencode($message));
                exit;
            }
        }
    } else {
        // User not found
        $message = 'User not found.';
        header("Location:  ../Front/user/login.php?message=" . urlencode($message));
        exit;
    }
}
?>
