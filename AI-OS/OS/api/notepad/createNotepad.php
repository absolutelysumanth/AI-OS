<?php
// Include database connection
include('../../config/db_connection.php'); // Assuming the database connection is in this file

// Check if data is sent via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $save_name = $_POST['save_name'];  // You can get the user or session info for save_name
    $notes = $_POST['notes'];

    // Prepare SQL statement
    $sql = "INSERT INTO notepad (save_name, notes, created_at, modified_at) 
            VALUES (?, ?, NOW(), NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $save_name, $notes);  // 'i' for integer, 's' for string
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['message' => 'Note saved successfully!']);
    } else {
        echo json_encode(['message' => 'Error saving note']);
    }

    $stmt->close();
}
?>
