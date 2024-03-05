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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>

	<section class="p-7 slide-section2" style="background-image: url(/img/AuthenticationBackground.webp);">

		<!-- <div class="container"> -->
        <!-- <div class="card mx-md-21 mx-lg-l40 auth-form"> -->
        <div class="card mx-md-21 auth-form">
        <form class="mx-auto" action="">
            <div class = "mx-auto text-center">
                
                
                <!--  -->            
                <?php
                if(isset($_GET['signup'])){
                ?>
                <h4 class=" auth-h1 text-center  mt-2 mb-1">Create an account</h4>
                <?php
                }
                elseif(isset($_GET['login'])){
                ?>
                <h4 class=" auth-h1 text-center  mt-2 mb-1">Welcome Back</h4>
                <?php
                }
                ?>




                <!-- <h4 class=" auth-h1 text-center  mt-2 mb-1">Create an account</h4> -->
                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col-lg-6 col-md-3 col-xs-12 col-sm-6">
                                <a href="#" class="auth-btn d-flex align-items-center gap-2">
									<img src="/img/github.svg" alt="Login with" width="30" height="30">
									<span>Github</span>
								</a>
                            </div>
                            <div class="col-lg-6 col-md-3 col-xs-12 col-sm-6">
								<a href="#" class="auth-btn d-flex align-items-center gap-2">
									<img src="/img/google.svg" alt="Login with" width="30" height="30">
									<span>Google</span>
								</a>                            
							</div>
                        </div>
                    </div>
                    <p class="mt-1 auth-or">Or</p>
            </div>

            <div class = "mx-auto">
                    <div class=" mt-100 mb-1">
                        <label for="InputEmail" class="form-label" >Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="anirbanrouth.dev@proton.me">
                    </div>
                    <div class="mb-1">
                        <label for="InputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password here">
                    </div>
            </div>

            <div class= " mt-1 mx-auto text-center" action="">



                    <!--  -->            
                    <?php
                    if(isset($_GET['signup'])){
                    ?>
                    <button type="submit" class="auth-submit-btn bg-gradient" >Create Account</button>
                    <p class="mt-1 auth-p"> Already have an account? <a href="index.php?login" class="auth-p-link">Log In</a></p>
                    <?php
                    }
                    elseif(isset($_GET['login'])){
                    ?>
                    <button type="submit" class="auth-submit-btn bg-gradient" >Log In</button>
                    <p class="mt-1 auth-p"> Don't have an account? <a href="index.php?signup" class="auth-p-link">Sign Up</a></p>
                    <?php
                    }
                    ?>




                    <!-- <button type="submit" class="auth-submit-btn bg-gradient" >Create Account</button> -->
                    <!-- <p class="mt-1 auth-p"> Already have an account? <a href="" class="auth-p-link">Log In</a></p> -->
            </div>
        </form>
        </div>
	</section>
</body>
</html>