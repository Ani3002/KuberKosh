<?php
require_once 'database.php'; // Include the database connection

global $connect_kuberkosh_db;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $requestData = json_decode(file_get_contents("php://input"), true);

    $userId = $requestData['userId'];
    $pan = !empty($requestData['pan']) ? $requestData['pan'] : null;
    $dob = !empty($requestData['dob']) ? $requestData['dob'] : null;
    $gender = !empty($requestData['gender']) ? $requestData['gender'] : null;
    $mobile = !empty($requestData['mobile']) ? $requestData['mobile'] : null;
    $secondaryEmail = !empty($requestData['secondaryEmail']) ? $requestData['secondaryEmail'] : null;

    if ($userId !== null) {
        $updateStatus = updateUserDetails($connect_kuberkosh_db, $userId, $pan, $dob, $gender, $mobile, $secondaryEmail);        if ($updateStatus) {
            $response = array('success' => true, 'message' => 'User details updated successfully.');
        } else {
            $response = array('success' => false, 'message' => 'Failed to update user details.');
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

function updateUserDetails($db, $userId, $pan, $dob, $gender, $mobile, $secondaryEmail) {
    $fields = [];
    $params = [];
    $types = "";

    if (!empty($pan)) {
        $fields[] = "pan = ?";
        $params[] = $pan;
        $types .= "s";
    }
    if (!empty($dob)) {
        $fields[] = "dob = ?";
        $params[] = $dob;
        $types .= "s";
    }
    if (!empty($gender)) {
        $fields[] = "gender = ?";
        $params[] = $gender;
        $types .= "s";
    }
    if (!empty($mobile)) {
        $fields[] = "mobile = ?";
        $params[] = $mobile;
        $types .= "s";
    }
    if (!empty($secondaryEmail)) {
        $fields[] = "secondary_email = ?";
        $params[] = $secondaryEmail;
        $types .= "s";
    }

    if (empty($fields)) {
        return false; // Nothing to update
    }

    $params[] = $userId;
    $types .= "i";

    $query = "UPDATE users SET " . implode(", ", $fields) . ", modified = NOW() WHERE user_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param($types, ...$params);

    return $stmt->execute();
}
?>
