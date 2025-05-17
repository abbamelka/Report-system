<?php
include 'db.php'; // Include the database connection

$search_query = isset($_GET['search']) ? $_GET['search'] : ''; // Get search query from URL parameter

// Prepare the SQL query based on search input
$sql = "SELECT id, uname, usertype, Creationdate FROM userTable WHERE usertype = 'normal' AND uname LIKE ?";
$stmt = $conn->prepare($sql);
$search_term = "%$search_query%"; // Prepare search term with wildcard
$stmt->bind_param("s", $search_term);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['uname'] . "</td>";
        echo "<td>" . $row['usertype'] . "</td>";
        echo "<td>" . $row['Creationdate'] . "</td>";
        echo "<td><button class='btn btn-danger' onclick='confirmDelete(" . $row['id'] . ")'>Delete</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No users found.</td></tr>";
}

$stmt->close();
$conn->close();
?>
