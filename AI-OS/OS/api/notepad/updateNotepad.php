<?php
// Include database connection
include('../../config/db_connection.php'); // Adjust path based on your file structure

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get ID from the URL
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); // Get the ID from the URL as an integer

        // Get JSON body
        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true);  // Decode the JSON data into an array

        // Make sure notes field exists
        if (isset($data['notes'])) {
            $notes = $data['notes']; // Get notes from the body

            // Prepare the SQL query to update the note
            $sql = "UPDATE notepad SET notes = ?, modified_at = NOW() WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $notes, $id);  // Bind the notes and ID parameters
            $stmt->execute();  // Execute the query

            if ($stmt->affected_rows > 0) {
                // If the note was updated successfully
                echo json_encode(['message' => 'Note updated successfully']);
            } else {
                // If no rows were affected (meaning no update occurred, maybe wrong ID)
                echo json_encode(['message' => 'No changes made or note not found']);
            }

            $stmt->close();  // Close the statement
        } else {
            // If the notes field is missing in the request
            echo json_encode(['message' => 'Missing "notes" field']);
        }
    } else {
        // If the ID is missing in the URL
        echo json_encode(['message' => 'Missing ID in URL']);
    }
} else {
    // If the request method is not POST
    echo json_encode(['message' => 'Invalid request method']);
}

$conn->close(); // Close the DB connection
?>
