<?php
// Include database connection
include('../../config/db_connection.php'); // Assuming the database connection is in this file

// Check if data is sent via PUT
parse_str(file_get_contents("php://input"), $putData); // Get PUT data

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $id = $putData['id'];   // Note ID
    $notes = $putData['notes'];  // Updated notes

    // Prepare SQL to update the note
    $sql = "UPDATE notepad SET notes = ?, modified_at = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $notes, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['message' => 'Note updated successfully']);
    } else {
        echo json_encode(['message' => 'Error updating note']);
    }

    $stmt->close();
}
?>
