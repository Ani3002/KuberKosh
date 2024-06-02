<?php
include_once 'php/database.php'; // Include the database.php file
include_once 'php/functions.php';

global $connect_wallet_transactions_db;

function getAllTransactions($db) {
    $query = "SELECT * FROM `1`";
    $result = $db->query($query);
    $transactions = [];
    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
    return $transactions;
}

$transactions = getAllTransactions($connect_wallet_transactions_db);

function extractTransactionUser($particulars) {
    $parts = explode('/', $particulars);
    return isset($parts[3]) ? $parts[3] : 'unknown_user';
}
?>

<div class="card transactions_div_card transactions_div_main mt-8">
    <div class="d-flex justify-content-between mx-1 mt-1 mb-1">
        <h4>Recent History</h4>
        <button class="btn btn-outline-light">Select Dates</button>
    </div>

    <div class="transactions_div">
        <?php if (!empty($transactions)): ?>
            <?php foreach ($transactions as $index => $transaction): ?>
                <div class="card card2 transaction-card">
                    <div class="card-header transaction-header">
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Profile Picture">
                            <div>
                            <div class="fw-bold"><?php echo htmlspecialchars(extractParticularsParts($transaction['Particulars'], 2)); ?></div>
                                <small><?php echo '@' . htmlspecialchars(extractTransactionUser($transaction['Particulars'])); ?></small>
                            </div>
                        </div>
                        <div class="transaction-info">
                            <div class="text-end">
                                <div><?php echo date('d M', strtotime($transaction['Date'])); ?></div>
                                <div class="<?php echo $transaction['credit'] ? 'text-success' : 'text-danger'; ?>">
                                    <?php echo $transaction['credit'] ? '+' . $transaction['credit'] : '-' . $transaction['debit']; ?> GDC
                                </div>
                            </div>
                            <div class="arrow-btn collapsed" data-bs-toggle="collapse" data-bs-target="#details<?php echo $index; ?>" aria-expanded="false" aria-controls="details<?php echo $index; ?>">
                                <i class="bi bi-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div id="details<?php echo $index; ?>" class="collapse transaction-details">
                        <p><strong>Date:</strong> <?php echo date('j/n/Y', strtotime($transaction['Date'])); ?></p>
                        <p><strong>Time:</strong> <?php echo date('h:i:s A', strtotime($transaction['Date'])); ?></p>
                        <p><strong>Transaction Charge:</strong> 0 GDC</p>
                        <p><strong>Transaction Id:</strong> <?php echo htmlspecialchars($transaction['Trnx_id']); ?></p>
                        <p><strong>Message (Optional):</strong> Hello, world!</p> <!-- Replace with actual message if available -->
                        <p><strong>Tag:</strong> <?php echo htmlspecialchars($transaction['trnxPurpose']); ?></p> <!-- Replace with actual tag if available -->
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No transactions found.</p>
        <?php endif; ?>
    </div>
</div>
