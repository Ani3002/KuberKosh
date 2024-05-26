<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #fff;
        }

        .transaction-card {
            background-color: #1e1e1e;
            border: none;
            margin-bottom: 1rem;
        }

        .transaction-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .transaction-details {
            padding: 1rem;
        }

        .transaction-details p {
            margin: 0;
        }

        .transaction-details .optional {
            color: #b3b3b3;
        }

        .btn-toggle {
            color: #b3b3b3;
            background-color: transparent;
            border: none;
        }

        .btn-toggle:focus {
            box-shadow: none;
        }

        .arrow-btn {
            display: flex;
            align-items: center;
            margin-left: 10px;
        }

        .arrow-btn i {
            transition: transform 0.3s ease;
        }

        .arrow-btn.collapsed i {
            transform: rotate(0deg);
        }

        .arrow-btn:not(.collapsed) i {
            transform: rotate(180deg);
        }

        .transaction-info {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .transaction-info div {
            margin-right: 10px;
        }

        .text-end {
            text-align: right;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h4>Recent History</h4>
            <button class="btn btn-outline-light">Select Dates</button>
        </div>

        <!-- Transaction Card -->
        <div class="card card1 transaction-card">
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

        <!-- Transaction Card -->
        <div class="card card1 transaction-card">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>