<?php
include 'php/google-auth.php';

global $connect_kuberkosh_db;

// Redirect if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    echo "
    <script type='text/javascript'>
        window.location.href = 'index.php?login';
    </script>
    ";
    exit;
}

// Get user ID from session
$userId = $_SESSION['user_id'];

// Check if TOTP is enabled for the user
$totpStatus = json_decode(checkTOTPenabled($userId, $connect_kuberkosh_db), true);

// Redirect if TOTP is not enabled
if (!$totpStatus['TOTPenabled']) {
    header('Location: index.php?dash');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KuberKosh</title>
    <script src="js/bundle.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <script>
        function verifyTOTP(event) {
            event.preventDefault(); // Prevent form submission

            var totp = document.getElementById("totpInput").value;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "php/ajaxVerifyTOTP.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    var response = JSON.parse(xhr.responseText);

                    if (response.message === "valid OTP") {
                        window.location.href = "index.php?dash";
                    } else {
                        alert("Invalid TOTP");
                    }
                }
            };

            xhr.send("otp=" + totp);
        }
    </script>
</head>
<body>
    <img class="bg-img" style="position: absolute;" src="/img/AuthenticationBackground.webp" alt="background image">
    <div class="card card1 mx-md-21 auth-form">
        <form class="mx-auto" onsubmit="verifyTOTP(event)">
            <div class="mx-auto text-center">
                <?php
                if (isset($_GET['signup'])) {
                    echo '<h4 class="auth-h1 text-center mt-2 mb-1">Create an account</h4>';
                } elseif (isset($_GET['login'])) {
                    echo '<h4 class="auth-h1 text-center mt-2 mb-1">Welcome Back</h4>';
                } elseif (isset($_GET['mfa'])) {
                    echo '<h4 class="auth-h1 text-center mt-6 mb-3">Complete 2FA</h4>';
                }
                ?>

                <?php
                if ((isset($_GET['signup'])) || (isset($_GET['login']))) {
                    ?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-md-3 col-xs-12 col-sm-6">
                                <a href="#" class="auth-btn d-flex align-items-center gap-2">
                                    <img src="/img/github.svg" alt="Login with" width="30" height="30">
                                    <span>Github</span>
                                </a>
                            </div>
                            <div class="col-lg-6 col-md-3 col-xs-12 col-sm-6">
                                <a href="<?php echo $google_client->createAuthUrl(); ?>"
                                    class="auth-btn d-flex align-items-center gap-2">
                                    <img src="/img/google.svg" alt="Login with" width="30" height="30">
                                    <span>Google</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <p class="mt-1 auth-or">Or</p>
                </div>
                <div class="mx-auto">
                    <div class="mt-100 mb-1">
                        <label for="InputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="anirbanrouth.dev@proton.me">
                    </div>
                    <div class="mb-1">
                        <label for="InputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Enter your password here">
                    </div>
                </div>
                <?php
                } elseif (isset($_GET['mfa'])) {
                    ?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-md-3 col-xs-12 col-sm-6"></div>
                            <div class="col-lg-6 col-md-3 col-xs-12 col-sm-6"></div>
                        </div>
                    </div>
                    <p class="mt-1 mb-1 auth-or"><?php echo $_SESSION['email_address'] ?></p>

                </div>
                <div class="mx-auto">
                    <div class="mb-1">
                        <label for="InputPassword" class="form-label">TOTP</label>
                        <input type="password" class="form-control" id="totpInput" placeholder="Enter your TOTP here">
                    </div>
                </div>
                <?php
                }
                ?>

                <div class="mt-1 mx-auto text-center">
                    <?php
                    if (isset($_GET['signup'])) {
                        echo '<button type="submit" class="auth-submit-btn bg-gradient">Create Account</button>';
                        echo '<p class="mt-1 auth-p"> Already have an account? <a href="index.php?login" class="auth-p-link">Log In</a></p>';
                    } elseif (isset($_GET['login'])) {
                        echo '<button type="submit" class="auth-submit-btn bg-gradient">Log In</button>';
                        echo '<p class="mt-1 auth-p"> Don\'t have an account? <a href="index.php?signup" class="auth-p-link">Sign Up</a></p>';
                    } elseif (isset($_GET['mfa'])) {
                        echo '<button type="submit" class="auth-submit-btn bg-gradient">Verify TOTP</button>';
                        echo '<p class="mt-1 auth-p"> Lost TOTP? <a href="index.php?signup" class="auth-p-link">Contact Support</a></p>';
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
