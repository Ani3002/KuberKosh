<?php
require_once 'database.php'; // Include the database connection

global $connect_kuberkosh_db;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $requestData = json_decode(file_get_contents("php://input"), true);
    // $userId = $requestData['userId'];

    $bankUserId = $requestData['bankUserId'];

    if ($bankUserId !== null) {
        $linkedAccountsCount = getLinkedAccountsCount($connect_kuberkosh_db, $bankUserId);
        if ($linkedAccountsCount !== false) {
            $response = array('success' => true, 'linkedAccounts' => $linkedAccountsCount);
        } else {
            $response = array('success' => false, 'message' => 'Failed to retrieve linked accounts count.');
        }
    } else {
        $response = array('success' => false, 'message' => 'Invalid user.');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Invalid request method'));
}

function getLinkedAccountsCount($db, $bankUserId) {
    $query = "SELECT COUNT(*) as count FROM bank_accounts WHERE bank_user_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $bankUserId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'];
    } else {
        return false;
    }
}
?>
