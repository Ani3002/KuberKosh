<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Page</title>
    <style>
        /* Add your CSS styles here */
        /* Navbar styles */
        /* Navbar styles */
        /* Navbar styles */
        /* Navbar styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            flex-wrap: wrap; /* Allow items to wrap onto multiple lines */
        }

        .navbar .navbar-links {
            display: flex;
            flex-wrap: wrap; /* Allow items to wrap onto multiple lines */
            justify-content: center; /* Center items horizontally */
        }

        .navbar a, .navbar button {
            margin: 0 10px;
            color: white; /* Set link text color to white */
            text-decoration: none; /* Remove underline */
        }
        .navbar button {
            margin: 0 10px;
            color: black; /* Set link text color to white */
            text-decoration: none; /* Remove underline */
        }

        /* Profile section */
        .navbar .profile {
            display: flex;
            align-items: center;
        }




        /* Side left page styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 200px;
            background-color: #f0f0f0;
            padding-top: 60px; /* Adjust this according to your navbar height */
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .sidebar li:last-child {
            border-bottom: none;
        }
        .sidebar li a {
            color: #333;
            text-decoration: none;
        }
        .sidebar li a:hover {
            background-color: #ddd;
        }

        /* Main content styles */
        .content {
            margin-left: 200px; /* Adjust this according to your sidebar width */
            padding: 20px;
            padding-left: 220px; /* Add padding to the left to accommodate the sidebar */

        }




        body {
        margin: 0;
        font-family: sans-serif;
        }

        .tabs {
        width: 100%;
        }

        .tab-nav {
        display: flex;
        background: #f0f0f0;
        }

        .nav-item {
        display: block;
        padding: 16px;
        cursor: pointer;
        
        &.selected {
            font-weight: bold;
            background: #fff;
        }
        }

        .tab {
        display: none;
        padding: 16px;
        
        &.selected {
            display: block;
        }
        }

        .tab-pag {
        padding: 0 16px;
        display: flex;
        justify-content: flex-end;
        }

        .pag-item {
        display: block;
        padding: 12px;
        cursor: pointer;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 8px;
        
        &:last-child {
            margin-right: 0;
        }
        
        &.hidden {
            display: none;
        }
        }

        .pag-item-submit {
        flex: 0 1 180px;
        font-size: 1rem;
        color: #fff;
        border-color: #696969;
        background: #696969;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            KuberKosh
        </div>
        <div class="navbar-links">
            <a href="#">About</a>
            <a href="#">Features</a>
            <a href="#">Support</a>
            <button>Language</button>
            <div class="profile">
                <span>Name</span>
                <img src="profile-picture.jpg" alt="Profile Picture" style="width: 40px; height: 40px; border-radius: 50%;">
            </div>
        </div>
    </div>

    <!-- Side left page -->
    <div class="sidebar">
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Send Money</a></li>
            <li><a href="#">Receive Money</a></li>
            <li><a href="#">Add Money</a></li>
            <li><a href="#">Withdraw Money</a></li>
            <li><a href="#">Transactions</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="content">
        <!-- User Details Form -->
        <div id="user-details" class="tab-content">
            <h2>User Details</h2>
            <!-- Your user details form goes here -->
        </div>

        <!-- Bank Settings Form -->
        <div id="bank-settings" class="tab-content" style="display: none;">
            <h2>Bank Settings</h2>
            <!-- Your bank settings form goes here -->
        </div>

        <!-- Change Password Form -->
        <div id="change-password" class="tab-content" style="display: none;">
            <h2>Change Password</h2>
            <!-- Your change password form goes here -->
        </div>

        <!-- 2FA Form -->
        <div id="2fa" class="tab-content" style="display: none;">
            <h2>2FA</h2>
            <!-- Your 2FA form goes here -->
        </div>
    </div>

    <script>
        // JavaScript for tab functionality
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabContents = document.querySelectorAll('.tab-content');

        tabLinks.forEach(link => {
            link.addEventListener('click', () => {
                const tabName = link.getAttribute('data-tab');

                // Hide all tab contents
                tabContents.forEach(content => {
                    content.style.display = 'none';
                });

                // Show the clicked tab content
                document.getElementById(tabName).style.display = 'block';
            });
        });
    </script>
</body>
</html>
