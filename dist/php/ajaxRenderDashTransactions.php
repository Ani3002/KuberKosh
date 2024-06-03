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
        foreach ($transactions as $transaction):
            $type = htmlspecialchars(extractParticularsParts($transaction['Particulars'], 0));
            $datetime = htmlspecialchars(extractParticularsParts($transaction['Particulars'], 5));
            $time = date('H:i', strtotime($datetime));
            $date = date('d M', strtotime($datetime));
            $amountClass = $transaction['credit'] ? 'text-success' : 'text-danger';
            $amount = $transaction['credit'] ? '+' . $transaction['credit'] : '-' . $transaction['debit'];
            $status = 'Successful';

            // Determine image and type label
            $imgSrc = $transaction['credit'] ? 'img/up.svg' : 'img/down.svg';
            $typeLabel = '';
            if ($type === 'W2W') {
                $typeLabel = $transaction['credit'] ? 'Receive' : 'Send';
            } elseif ($type === 'B2W') {
                $typeLabel = 'Topup';
            } elseif ($type === 'W2B') {
                $typeLabel = 'Withdraw';
            }
            ?>
            <div class="card card2 transaction-card">
                <div class="card-header transaction-header">
                    <div class="d-flex align-items-center dashTransactions">
                        <img src="<?php echo $imgSrc; ?>" class="rounded-circle me-1" width="35px" height="35px">
                        <div class="d-flex gap-1">
                            <div class="fw-bold"><?php echo $typeLabel; ?></div>
                            <!-- <span class="fw-normal"><?php echo $time; ?></span> -->
                            <span class="fw-normal"><?php echo date('h:i:s A', strtotime(htmlspecialchars(extractParticularsParts($transaction['Particulars'], 5) ?? ''))); ?></span>

                            <span class="fw-normal"><?php echo $date; ?></span>
                            <span class="fw-normal <?php echo $amountClass; ?>"><?php echo $amount; ?></span>
                            <span class="fw-normal text-success"><?php echo $status; ?></span>
                        </div>
                    </div>
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
