<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            background-color: #2a2a2e;
            color: white;
        }
        .nav{
            margin-left: 30px;
        }
        .nav-link.active {
            background-color: #2a2a2e;
            color: white;
        }
        .form-control-plaintext {
            color: white;
        }
        .btn-custom {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            border: none;
            color: white;
        }
        .header-container {
            align-items: center;
        }
        .user-info {
            margin-left: 10px;
        }
        
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card p-4">
        <div class="d-flex header-container">
            <img src="https://via.placeholder.com/50" alt="Profile" class="rounded-circle me-3">
            <div class="user-info">
                <h5 class="mb-0">Aegon Targaryan</h5>
                <small>brandonstark@kosh</small>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="user-details-tab" data-bs-toggle="tab" data-bs-target="#user-details" type="button" role="tab" aria-controls="user-details" aria-selected="true">User Details</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="bank-settings-tab" data-bs-toggle="tab" data-bs-target="#bank-settings" type="button" role="tab" aria-controls="bank-settings" aria-selected="false">Bank Settings</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="change-password-tab" data-bs-toggle="tab" data-bs-target="#change-password" type="button" role="tab" aria-controls="change-password" aria-selected="false">Change Password</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="manage-totp-tab" data-bs-toggle="tab" data-bs-target="#manage-totp" type="button" role="tab" aria-controls="manage-totp" aria-selected="false">Manage TOTP</button>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-3" id="myTabContent">
            <div class="tab-pane fade show active" id="user-details" role="tabpanel" aria-labelledby="user-details-tab">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control-plaintext" id="name" value="Lorem ipsum" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <div class="input-group">
                            <input type="text" class="form-control-plaintext" id="mobile" value="Lorem ipsum" readonly>
                            <button class="btn btn-outline-light btn-sm" type="button">Edit</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="text" class="form-control-plaintext" id="email" value="Lorem ipsum" readonly>
                            <button class="btn btn-outline-light btn-sm" type="button">Edit</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-custom">Save Changes</button>
                </form>
            </div>
            <!-- Placeholder content for other tabs -->
            <div class="tab-pane fade" id="bank-settings" role="tabpanel" aria-labelledby="bank-settings-tab">Bank Settings content here...</div>
            <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">Change Password content here...</div>
            <div class="tab-pane fade" id="manage-totp" role="tabpanel" aria-labelledby="manage-totp-tab">Manage TOTP content here...</div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            background-color: #2a2a2e;
            color: white;
        }
        .nav-link.active {
            background-color: #2a2a2e;
            color: white;
        }
        .form-control-plaintext {
            color: white;
        }
        .btn-custom {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            border: none;
            color: white;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card p-4">
        <div class="d-flex align-items-center mb-3">
            <img src="https://via.placeholder.com/50" alt="Profile" class="rounded-circle me-2">
            <div>
                <h5 class="mb-0">Aegon Targaryan</h5>
                <small>brandonstark@kosh</small>
            </div>
        </div>
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="user-details-tab" data-bs-toggle="tab" data-bs-target="#user-details" type="button" role="tab" aria-controls="user-details" aria-selected="true">User Details</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="bank-settings-tab" data-bs-toggle="tab" data-bs-target="#bank-settings" type="button" role="tab" aria-controls="bank-settings" aria-selected="false">Bank Settings</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="change-password-tab" data-bs-toggle="tab" data-bs-target="#change-password" type="button" role="tab" aria-controls="change-password" aria-selected="false">Change Password</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="manage-totp-tab" data-bs-toggle="tab" data-bs-target="#manage-totp" type="button" role="tab" aria-controls="manage-totp" aria-selected="false">Manage TOTP</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="user-details" role="tabpanel" aria-labelledby="user-details-tab">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control-plaintext" id="name" value="Lorem ipsum" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <div class="input-group">
                            <input type="text" class="form-control-plaintext" id="mobile" value="Lorem ipsum" readonly>
                            <button class="btn btn-outline-light btn-sm" type="button">Edit</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="text" class="form-control-plaintext" id="email" value="Lorem ipsum" readonly>
                            <button class="btn btn-outline-light btn-sm" type="button">Edit</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-custom">Save Changes</button>
                </form>
            </div>

            <div class="tab-pane fade" id="bank-settings" role="tabpanel" aria-labelledby="bank-settings-tab">Bank Settings content here...</div>
            <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">Change Password content here...</div>
            <div class="tab-pane fade" id="manage-totp" role="tabpanel" aria-labelledby="manage-totp-tab">Manage TOTP content here...</div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
