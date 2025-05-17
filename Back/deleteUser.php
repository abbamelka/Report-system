<?php
include 'db.php'; // Include the database connection

if (isset($_GET['id'])) {
    $user_id = $_GET['id']; // Get the user ID from the URL

    // Prepare the SQL query to delete the user
    $sql = "DELETE FROM userTable WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Redirect back to the search page with a success message
        header("Location: ../Front/main/Admin/deleteUser.php?message=User%20deleted%20successfully");
    } else {
        // Redirect back with an error message
        header("Location: ../Front/main/Admin/deleteUser.php?message=Error%20deleting%20user");
    }

    $stmt->close();
    $conn->close();
}
else {
    // Handle the case where 'id' is not provided (security measure)
    header("../Front/main/Admin/deleteUser.php?message=Invalid%20user%20ID");
}
?>
