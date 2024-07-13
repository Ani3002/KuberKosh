<?php
include 'functions.php';
require_once 'database.php';

// Establishing database connection
global $connect_kuberkosh_db;
global $connect_wallet_transactions_db;

// Check request is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get start and end date from the request
    $requestData = json_decode(file_get_contents("php://input"), true);
    $start_date = $requestData['startDate'];
    $end_date = $requestData['endDate'];

    // Fetch user ID from the session
    $userId = $_SESSION['user_id'];

    // Fetch wallet ID
    $wallet_id = fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_id'];

    // Fetch transactions
    $transactions = getTrnxDetailsDateRange($connect_wallet_transactions_db, $wallet_id, $start_date, $end_date);


    ob_start(); // Start output buffering

    if (!empty($transactions)):
        foreach ($transactions as $index => $transaction): ?>
            <?php

            if ($transaction['Trnx_id'] === 'initial_trnx_id') {
                continue;
            }
            
            $profilePicLink = fetchProfilePictureLinkViaWalletAddress($connect_kuberkosh_db, (extractParticularsParts($transaction['Particulars'], 3)));

            if (empty($profilePicLink)) {
                $profilePicLink = "img/Logo.png";
            }

            // $userIdViaWalletAddress = fetchUserIdViaWalletAddress($connect_kuberkosh_db, (extractParticularsParts($transaction['Particulars'], 3)));
            // // If $userIdViaWalletAddress is empty, set it to the user ID from session
            // if (empty($userIdViaWalletAddress)) {
            //     $userIdViaWalletAddress = $userId;
            // }

            // $userIdViaWalletAddress = fetchUserIdViaWalletAddress($connect_kuberkosh_db, $wallet_address); // Make sure this variable is defined properly
            // $profilePicPath = "../assets/profilePics/$userIdViaWalletAddress.png";

            // if (file_exists($profilePicPath)) {
            //     $profilePicLink = "assets/profilePics/$userIdViaWalletAddress.png";
            // } else {
            //     $profilePicLink = "img/Logo.png";
            // }


            ?>
            <div class="card card2 transaction-card">
                <div class="card-header transaction-header">
                    <div class="d-flex align-items-center">
                        <img src="<?php echo $profilePicLink; ?>" class="rounded-circle me-2" width="35px" height="35px">
                        <div>
                            <div class="fw-bold">
                                <?php echo htmlspecialchars(extractParticularsParts($transaction['Particulars'], 2)); ?>
                            </div>
                            <small><?php echo htmlspecialchars(extractParticularsParts($transaction['Particulars'], 3)); ?></small>
                        </div>
                    </div>
                    <div class="transaction-info">
                        <div class="text-end">
                            <div><?php echo date('d M', strtotime($transaction['Date'])); ?></div>
                            <div class="<?php echo $transaction['credit'] ? 'text-success' : 'text-danger'; ?>">
                                <?php echo $transaction['credit'] ? '+' . $transaction['credit'] : '-' . $transaction['debit']; ?>
                                INR
                            </div>
                        </div>
                        <div class="arrow-btn collapsed" data-bs-toggle="collapse" data-bs-target="#details<?php echo $index; ?>"
                            aria-expanded="false" aria-controls="details<?php echo $index; ?>">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <div id="details<?php echo $index; ?>" class="collapse transaction-details">
                    <p><strong>Date:</strong>
                        <?php echo date('j/n/Y', strtotime(htmlspecialchars(extractParticularsParts($transaction['Particulars'], 5) ?? ''))); ?>
                    </p>
                    <p><strong>Time:</strong>
                        <?php echo date('h:i:s A', strtotime(htmlspecialchars(extractParticularsParts($transaction['Particulars'], 5) ?? ''))); ?>
                    </p>
                    <p><strong>Transaction Id:</strong> <?php echo htmlspecialchars($transaction['Trnx_id'] ?? ''); ?></p>
                    <p><strong>Purpose:</strong> <?php echo htmlspecialchars($transaction['trnxPurpose'] ?? ''); ?></p>
                    <p><strong>Remarks
                            (Optional):</strong><?php echo htmlspecialchars(extractParticularsParts($transaction['Particulars'], 7) ?? '' ?? ''); ?>
                    </p>
                </div>
            </div>
        <?php endforeach;
    else: ?>
        <p>No transactions found.</p>
    <?php endif;

    $pageContent = ob_get_clean(); // Get the buffered content

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode(['page' => $pageContent]);
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Invalid request method'));
}
?>