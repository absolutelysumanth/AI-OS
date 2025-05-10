<?php
// Include database connection
include('../../config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get ID from the URL
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);

        // Get JSON body
        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true);

        // Make sure notes field exists
        if (isset($data['notes'])) {
            $notes = $data['notes'];

            $sql = "UPDATE notepad SET notes = ?, modified_at = NOW() WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $notes, $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo json_encode(['message' => 'Note updated successfully']);
            } else {
                echo json_encode(['message' => 'No changes made or note not found']);
            }

            $stmt->close();
        } else {
            echo json_encode(['message' => 'Missing "notes" field']);
        }
    } else {
        echo json_encode(['message' => 'Missing ID in URL']);
    }
}
?>
