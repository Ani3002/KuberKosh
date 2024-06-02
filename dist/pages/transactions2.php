<?php
include_once 'php/database.php'; // Include the database.php file
include_once 'php/functions.php';

global $connect_kuberkosh_db;
global $connect_wallet_transactions_db;

$userId = $_SESSION['user_id'];
$wallet_id = fetchWalletDetails($connect_kuberkosh_db, $userId)['wallet_id'];
?>













<div class=" card transactions_div_card transactions_div_main mt-8">
    <div class="d-flex justify-content-between mx-1 mt-1 mb-1">
        <h4>Transaction History</h4>
        <div class="col-auto">
            <button type="button" class="btn btn-primary" id="oneWeekBtn">1 Week</button>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary" id="oneMonthBtn">1 Month</button>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary" id="sixMonthsBtn">6 Months</button>
        </div>
        <div class="col-auto">
            <input type="text" id="dateRange" name="date_range" class="form-control" />
            <input type="hidden" id="startDate" name="start_date" />
            <input type="hidden" id="endDate" name="end_date" />
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>

    <script>
        $(function () {
            $('#dateRange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: moment().format('YYYY-MM-DD'),
                endDate: moment().format('YYYY-MM-DD')
            }, function (start, end) {
                $('#startDate').val(start.format('YYYY-MM-DD'));
                $('#endDate').val(end.format('YYYY-MM-DD'));
            });

            $('#oneWeekBtn').click(function () {
                var start = moment().subtract(6, 'days').format('YYYY-MM-DD');
                var end = moment().format('YYYY-MM-DD');
                $('#startDate').val(start);
                $('#endDate').val(end);
                $('#filterForm').submit();
            });

            $('#oneMonthBtn').click(function () {
                var start = moment().subtract(1, 'month').format('YYYY-MM-DD');
                var end = moment().format('YYYY-MM-DD');
                $('#startDate').val(start);
                $('#endDate').val(end);
                $('#filterForm').submit();
            });

            $('#sixMonthsBtn').click(function () {
                var start = moment().subtract(6, 'months').format('YYYY-MM-DD');
                var end = moment().format('YYYY-MM-DD');
                $('#startDate').val(start);
                $('#endDate').val(end);
                $('#filterForm').submit();
            });
        });
    </script>


    <!-- // Optionally, you can make an AJAX call here to fetch and display the transactions for the selected date range
            // $.ajax({
            //     url: 'your_php_script.php',
            //     method: 'POST',
            //     data: { start_date: startDate, end_date: endDate },
            //     success: function(response) {
            //         // Handle the response
            //     }
            // }); -->


    <?php


    $start_date = '2024-05-01';
    $end_date = '2024-05-31';

    $transactions = getTrnxDetailsDateRange($connect_wallet_transactions_db, $wallet_id, $start_date, $end_date);

    ?>


    <div class="transactions_div">















        <?php if (!empty($transactions)): ?>
            <?php foreach ($transactions as $index => $transaction): ?>
                <div class="card card2 transaction-card">
                    <div class="card-header transaction-header">
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Profile Picture">
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
                            <div class="arrow-btn collapsed" data-bs-toggle="collapse"
                                data-bs-target="#details<?php echo $index; ?>" aria-expanded="false"
                                aria-controls="details<?php echo $index; ?>">
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
            <?php endforeach; ?>
        <?php else: ?>
            <p>No transactions found.</p>
        <?php endif; ?>





























        <!-- <div class="card card2 transaction-card">
            <div class="card-header transaction-header">
                <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Profile Picture">
                    <div>
                        <div class="fw-bold">Brandon Stark</div>
                        <small>@brandonstark@kosh</small>
                    </div>
                </div>
                <div class="transaction-info">
                    <div class="text-end">
                        <div>02 Feb</div>
                        <div class="text-success">+10.2 GDC</div>
                    </div>
                    <div class="arrow-btn collapsed" data-bs-toggle="collapse" data-bs-target="#details1" aria-expanded="false" aria-controls="details1">
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
            </div>
            <div id="details1" class="collapse transaction-details">
                <p><strong>Date:</strong> 2/2/2024</p>
                <p><strong>Time:</strong> 1:20:10 PM</p>
                <p><strong>Transaction Charge:</strong> 0 GDC</p>
                <p><strong>Transaction Id:</strong> PWW4Xj4bB0b85SwJRR5tUrWYoKYAm8ERtQKX1mAZ2xc=</p>
                <p><strong>Message (Optional):</strong> Hello, world!</p>
                <p><strong>Tag:</strong> Travel</p>
            </div>
        </div>

        <div class="card card2 transaction-card">
            <div class="card-header transaction-header">
                <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Profile Picture">
                    <div>
                        <div class="fw-bold">Brandon Stark</div>
                        <small>@brandonstark@kosh</small>
                    </div>
                </div>
                <div class="transaction-info">
                    <div class="text-end">
                        <div>02 Feb</div>
                        <div class="text-danger">-10.2 GDC</div>
                    </div>
                    <div class="arrow-btn collapsed" data-bs-toggle="collapse" data-bs-target="#details2" aria-expanded="false" aria-controls="details2">
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
            </div>
            <div id="details2" class="collapse transaction-details">
                <p><strong>Date:</strong> 2/2/2024</p>
                <p><strong>Time:</strong> 1:20:10 PM</p>
                <p><strong>Transaction Charge:</strong> 0 GDC</p>
                <p><strong>Transaction Id:</strong> PWW4Xj4bB0b85SwJRR5tUrWYoKYAm8ERtQKX1mAZ2xc=</p>
                <p><strong>Message (Optional):</strong> Hello, world!</p>
                <p><strong>Tag:</strong> Travel</p>
            </div>
        </div>
        <div class="card card2 transaction-card">
            <div class="card-header transaction-header">
                <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Profile Picture">
                    <div>
                        <div class="fw-bold">Brandon Stark</div>
                        <small>@brandonstark@kosh</small>
                    </div>
                </div>
                <div class="transaction-info">
                    <div class="text-end">
                        <div>02 Feb</div>
                        <div class="text-success">+10.2 GDC</div>
                    </div>
                    <div class="arrow-btn collapsed" data-bs-toggle="collapse" data-bs-target="#details3" aria-expanded="false" aria-controls="details3">
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
            </div>
            <div id="details3" class="collapse transaction-details">
                <p><strong>Date:</strong> 2/2/2024</p>
                <p><strong>Time:</strong> 1:20:10 PM</p>
                <p><strong>Transaction Charge:</strong> 0 GDC</p>
                <p><strong>Transaction Id:</strong> PWW4Xj4bB0b85SwJRR5tUrWYoKYAm8ERtQKX1mAZ2xc=</p>
                <p><strong>Message (Optional):</strong> Hello, world!</p>
                <p><strong>Tag:</strong> Travel</p>
            </div>
        </div>

        <div class="card card2 transaction-card">
            <div class="card-header transaction-header">
                <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Profile Picture">
                    <div>
                        <div class="fw-bold">Brandon Stark</div>
                        <small>@brandonstark@kosh</small>
                    </div>
                </div>
                <div class="transaction-info">
                    <div class="text-end">
                        <div>02 Feb</div>
                        <div class="text-danger">-10.2 GDC</div>
                    </div>
                    <div class="arrow-btn collapsed" data-bs-toggle="collapse" data-bs-target="#details4" aria-expanded="false" aria-controls="details4">
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
            </div>
            <div id="details4" class="collapse transaction-details">
                <p><strong>Date:</strong> 2/2/2024</p>
                <p><strong>Time:</strong> 1:20:10 PM</p>
                <p><strong>Transaction Charge:</strong> 0 GDC</p>
                <p><strong>Transaction Id:</strong> PWW4Xj4bB0b85SwJRR5tUrWYoKYAm8ERtQKX1mAZ2xc=</p>
                <p><strong>Message (Optional):</strong> Hello, world!</p>
                <p><strong>Tag:</strong> Travel</p>
            </div>
        </div> -->

















    </div>
</div>