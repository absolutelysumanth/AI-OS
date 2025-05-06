<?php
include('../../config/db_connection.php'); // Adjust path if needed

// Query to get the list of notepad filenames (assuming `save_name` is the filename)
$sql = "SELECT DISTINCT save_name FROM notepad";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $notepads = [];
    while($row = $result->fetch_assoc()) {
        $notepads[] = $row['save_name'];
    }
    echo json_encode($notepads); // Return the list as JSON
} else {
    echo json_encode(['message' => 'No notepads found']);
}

$conn->close();
?>
