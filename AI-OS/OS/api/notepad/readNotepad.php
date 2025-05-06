<?php
// Include database connection
include('../../config/db_connection.php'); // Adjust path based on your file structure

// Check if 'save_name' parameter is present in the URL
if (!isset($_GET['save_name'])) {
    echo json_encode(['message' => 'Missing save_name parameter']);
    exit();
}

$save_name = $_GET['save_name'];  // Get the 'save_name' from the query string

// Prepare SQL to get the notes
$sql = "SELECT * FROM notepad WHERE save_name = ? ORDER BY created_at DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $save_name);  // 's' for string
$stmt->execute();

$result = $stmt->get_result();
$note = $result->fetch_assoc();

if ($note) {
    // Pretty print the JSON response
    echo json_encode($note, JSON_PRETTY_PRINT);
} else {
    echo json_encode(['message' => 'No notes found']);
}

$stmt->close();
?>
