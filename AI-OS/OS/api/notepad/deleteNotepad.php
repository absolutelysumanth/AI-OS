<?php
// Include database connection
include('../../config/db_connection.php'); // Assuming the database connection is in this file

// Check if data is sent via DELETE
parse_str(file_get_contents("php://input"), $deleteData); // Get DELETE data

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $id = $deleteData['id'];  // Note ID

    // Prepare SQL to delete the note
    $sql = "DELETE FROM notepad WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['message' => 'Note deleted successfully']);
    } else {
        echo json_encode(['message' => 'Error deleting note']);
    }

    $stmt->close();
}
?>
