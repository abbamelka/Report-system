<?php
// Include database connection
include('db.php');

// Get the report type filter from the query parameters (if provided)
$reportType = isset($_GET['reportType']) ? $_GET['reportType'] : 'all'; // default to 'all' if no filter is provided

// Prepare the SQL query based on the filter for report type
if ($reportType == 'all') {
    // Get the counts for all report types and areas
    $query = "
        SELECT Reporttype, area, COUNT(*) as report_count
        FROM report
        GROUP BY Reporttype, area
        ORDER BY Reporttype, area;
    ";
} else {
    // Get the counts for a specific report type
    $query = "
        SELECT Reporttype, area, COUNT(*) as report_count
        FROM report
        WHERE Reporttype = ?
        GROUP BY Reporttype, area
        ORDER BY Reporttype, area;
    ";
}

// Prepare the statement
$stmt = $conn->prepare($query);

// If the filter is not 'all', bind the parameter for the specific report type
if ($reportType != 'all') {
    $stmt->bind_param("s", $reportType); // 's' for string (report type)
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Initialize arrays to store the data for the chart
$reportTypes = [];
$areas = [];
$reportCounts = [];
$areaCounts = [];

// Collect data for the report types and areas
while ($row = $result->fetch_assoc()) {
    $reportTypes[] = $row['Reporttype'];
    $areas[] = $row['area'];
    $reportCounts[] = $row['report_count'];
    $areaCounts[$row['area']][] = $row['report_count']; // Group area counts separately
}

// Prepare separate data for area chart
$uniqueAreas = array_unique($areas);
$areaCountsFinal = [];
foreach ($uniqueAreas as $area) {
    $areaCountsFinal[$area] = array_sum($areaCounts[$area]); // Sum all counts for each area
}

// Convert arrays to JSON format for use in JavaScript
$response = [
    'reportTypes' => $reportTypes,
    'areas' => $uniqueAreas,
    'reportCounts' => $reportCounts,
    'areaCounts' => $areaCountsFinal // Area chart data
];

// Output the response as JSON
echo json_encode($response);

// Close the statement
$stmt->close();
?>
