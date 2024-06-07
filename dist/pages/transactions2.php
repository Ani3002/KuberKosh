<!-- Modal -->
<div class="modal fade" id="failedModal" tabindex="1" aria-labelledby="failedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger fw-semibold" id="failedModalLabel">Failed</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="failedModalMessage" class="modal-body text-light fw-normal">
                Failed.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>


<div class="card transactions_div_card transactions_div_main mt-8">
    <div class="d-flex justify-content-between mx-1 mt-1 mb-1 align-items-center">
        <h4>Transaction History</h4>
        <div class="d-flex gap-1">
            <div class="d-flex gap-1">
                <div class="col-auto">
                    <button type="button" class="btn btn-primary rounded-pill" id="oneWeekBtn">1 Week</button>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary rounded-pill" id="oneMonthBtn">1 Month</button>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary rounded-pill" id="sixMonthsBtn">6 Months</button>
                </div>
            </div>
            <div class="col-auto">
                <input type="text" id="dateRange" name="date_range" class="form-control rounded-pill" />
                <input type="hidden" id="startDate" name="start_date" />
                <input type="hidden" id="endDate" name="end_date" />
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary rounded-pill" id="filterBtn">Filter</button>
            </div>
        </div>
    </div>
    <div id="transactionsContainer" class="transactions_div"></div>
</div>


    <script>
        $(function () {
            // Set default date range to 1 week when the page loads
            var start = moment().subtract(6, 'days').format('YYYY-MM-DD');
            var end = moment().format('YYYY-MM-DD');
            $('#startDate').val(start);
            $('#endDate').val(end);
            $('#dateRange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: start,
                endDate: end
            }, function (start, end) {
                $('#startDate').val(start.format('YYYY-MM-DD'));
                $('#endDate').val(end.format('YYYY-MM-DD'));
            });

            // Set date range to 1 week
            $('#oneWeekBtn').on('click', function (event) {
                event.preventDefault();
                var start = moment().subtract(6, 'days').format('YYYY-MM-DD');
                var end = moment().format('YYYY-MM-DD');
                $('#dateRange').data('daterangepicker').setStartDate(start);
                $('#dateRange').data('daterangepicker').setEndDate(end);
                $('#startDate').val(start);
                $('#endDate').val(end);
                sendAjaxRequest(start, end);
            });

            // Set date range to 1 month
            $('#oneMonthBtn').on('click', function (event) {
                event.preventDefault();
                var start = moment().subtract(1, 'month').format('YYYY-MM-DD');
                var end = moment().format('YYYY-MM-DD');
                $('#dateRange').data('daterangepicker').setStartDate(start);
                $('#dateRange').data('daterangepicker').setEndDate(end);
                $('#startDate').val(start);
                $('#endDate').val(end);
                sendAjaxRequest(start, end);
            });

            // Set date range to 6 months
            $('#sixMonthsBtn').on('click', function (event) {
                event.preventDefault();
                var start = moment().subtract(6, 'months').format('YYYY-MM-DD');
                var end = moment().format('YYYY-MM-DD');
                $('#dateRange').data('daterangepicker').setStartDate(start);
                $('#dateRange').data('daterangepicker').setEndDate(end);
                $('#startDate').val(start);
                $('#endDate').val(end);
                sendAjaxRequest(start, end);
            });

            // Filter button event (already using jQuery)
            $('#filterBtn').on('click', function (event) {
                event.preventDefault();
                var start = $('#startDate').val();
                var end = $('#endDate').val();
                sendAjaxRequest(start, end);
            });

            // Send AJAX request (unchanged)
            function sendAjaxRequest(start, end) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'php/ajaxRenderTransactions.php', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                var dataToSend = JSON.stringify({ startDate: start, endDate: end });
                xhr.send(dataToSend);

                xhr.onload = function () {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        displayTransactions(response.page);
                    } else {
                        var modalElement = document.getElementById('failedModal');
                        var failedModalLabel = document.getElementById('failedModalLabel');
                        failedModalLabel.textContent = "Failed";
                        var failedModalMessage = document.getElementById('failedModalMessage');
                        failedModalMessage.textContent = "Error occurred while fetching transactions. Please try again.";
                        var myModal = new bootstrap.Modal(modalElement);
                        myModal.show();
                    }
                };
            }

            // Display transactions in the container (unchanged)
            function displayTransactions(pageContent) {
                document.getElementById('transactionsContainer').innerHTML = pageContent;
            }

            // Load default transactions on page load (unchanged)
            sendAjaxRequest(start, end);
        });

    </script>