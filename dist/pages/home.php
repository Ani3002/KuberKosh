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
  <style>
    .slide-section1 {
      flex-grow: 1;
      /* This will make the section grow to fill the remaining vertical space */
    }

    .container1 {
      max-width: 600px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .container2 {
      max-width: 600px;
      margin: 0 auto 0 500px;
      padding: 0 20px;
      text-align: left;
      /* Align text to the left */
    }

    .container3 {
      max-width: 600px;
      margin: 0 500px 0 auto;
      padding: 0 20px;
      text-align: left;
    }

    .container4 {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .features {
      display: flex;
      justify-content: space-around;
      margin: 50px 0;
    }

    .features .feature {
      text-align: center;
      padding: 20px;
      background: rgba(0, 0, 0, 0.5);
      border-radius: 10px;
      width: 30%;
    }

    .features .feature h3 {
      margin-bottom: 20px;
    }

    .section2,
    .support-section,
    .final-cta-section,
    .footer {
      text-align: center;
      padding: 50px 20px;
    }
  </style>
</head>


<body>
  <!-- Nav_Bar Begins Here --------------------------- -->
  <nav class="navbar nav-home mx-4 navbar-expand-lg bg-transparent">
    <a class="navbar-brand" href="index.php?landing">
      <img src="img/Logo.svg" alt="kuberkosh logo" width="50px" hight="50px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav mx-auto">
        <a class="nav-link active mx-3 text-light font-weight-600" aria-current="page" href="#">About</a>
        <a class="nav-link active text-light font-weight-600" aria-current="page" href="#">Features</a>
        <a class="nav-link active mx-3 text-light font-weight-600" aria-current="page" href="#">Support</a>
      </div>
      <a href="index.php?login" class="btn btn-primary bg-transparent text-primary border-primary font-weight-600"
        aria-disabled="true">Sign In</a>
      <!-- <a href="index.php?signup" class="btn btn-primary bg-gradient text-light font-weight-600" aria-disabled="true">Sign Up</a> -->
    </div>
  </nav>
  <!-- Nav_Bar Ends Here --------------------------- -->


  <section class="p-7 slide-section1 body-home custom-bg" style="background-image: url(/img/LandingPage.webp);">

    <!-- H1 Begins Here------------------------------- -->
    <!-- <div class="container"> -->
    <div class="row">

      <div class="container col-md-12 col-lg-12 text-center mt-md-5">
        <h1 class="display-1 font-weight-900 ">We make digital <span class="d-block">Transactions</span> <span
            class="d-block">simple and secure</span></h1>
      </div>
      <p></p>
      <div class="container text-center mt-1">
        <a class="btn  bg-gradient text-light font-weight-600" aria-disabled="true">Get Started</a>
      </div>
    </div>
    <!-- </div> -->
    <!-- H1 Ends Here------------------------------- -->














    <div class="features mt-21">
      <div class="feature">
        <h3>Create</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor. Lorem ipsum dolor sit amet,
          consectetur adipisicing elit. Nemo, aspernatur expedita a dicta quis, fugiat quos consectetur voluptatem,
          earum recusandae aliquid eaque provident ipsam odit fugit sunt obcaecati blanditiis in.</p>
          <a class="btn  bg-gradient text-light font-weight-600 mt-1" aria-disabled="true">Get Started</a>
</span>
      </div>
      <div class="feature">
        <h3>Login</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor. Lorem ipsum dolor sit amet,
          consectetur adipisicing elit. Nemo, aspernatur expedita a dicta quis, fugiat quos consectetur voluptatem,
          earum recusandae aliquid eaque provident ipsam odit fugit sunt obcaecati blanditiis in.</p>
          <a class="btn  bg-gradient text-light font-weight-600 mt-1" aria-disabled="true">Get Started</a>
</span>
      </div>
      <div class="feature">
        <h3>Manage</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor. Lorem ipsum dolor sit amet,
          consectetur adipisicing elit. Nemo, aspernatur expedita a dicta quis, fugiat quos consectetur voluptatem,
          earum recusandae aliquid eaque provident ipsam odit fugit sunt obcaecati blanditiis in.</p>
          <a class="btn  bg-gradient text-light font-weight-600 mt-1" aria-disabled="true">Get Started</a>
</span>
      </div>
    </div>






    <div class="section2 mt-17">
      <div class="container1">
        <h2 class="text-light fw-bold">Get started with KuberKosh</h2>
        <p class="text-light mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
          incididunt
          ut labore et dolore magna aliqua.</p>
        <a class="btn  bg-gradient text-light font-weight-600 mt-2" aria-disabled="true">Get Started</a>
      </div>
    </div>
    <div class="section2 mt-7">
      <div class="container2">
        <h2 class="text-light fw-bold">24/7 access to full service customer support</h2>
        <p class="text-light mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
          incididunt
          ut labore et dolore magna aliqua.</p>
        <a class="btn  bg-gradient text-light font-weight-600 mt-2" aria-disabled="true">Get Started</a>
      </div>
    </div>
    <div class="section2 mt-40">
      <div class="container3">
        <h2 class="text-light fw-bold">Take your first step into safe, secure banking</h2>
        <p class="text-light mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
          incididunt
          ut labore et dolore magna aliqua.</p>
        <a class="btn  bg-gradient text-light font-weight-600 mt-2" aria-disabled="true">Get Started</a>
      </div>
    </div>
    <div class="section2 mt-19">
      <div class="container4">
        <h2 class="text-light fw-bold">Receive transmissions</h2>
        <p class="text-light mt-1">Unsubscribe at any time. <a href="#">Privacy policy</a></p>
        <!-- <input type="email" placeholder="Email Address"> -->
        <div class="row justify-content-center"> <!-- Center the columns -->
          <div class="col-4 mt-1">
          <input id="newsletter1" type="text" class="form-control border-primary bg-transparent"
              placeholder="anirbanrouth.dev@proton.me">
             <span> <a class="btn  bg-gradient text-light font-weight-600 mt-1" aria-disabled="true">Subscribe</a>
</span>
          </div>
        </div>
      </div>
    </div>




































    <!-- Footer Begins Here --------------------- -->
    <!-- <footer class=" text-white"> -->
    <div class="row mt-5">
      <div class="col-2">
        <h5>Section</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">Features</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">Pricing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">About</a></li>
        </ul>
      </div>
      <div class="col-2">
        <h5>Section</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">Features</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">Pricing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">About</a></li>
        </ul>
      </div>
      <div class="col-2">
        <h5>Section</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">Features</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">Pricing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-lgray">About</a></li>
        </ul>
      </div>
      <div class="col-4 offset-1">
        <form>
          <h5>Subscribe to our newsletter</h5>
          <p>Monthly digest of what's new and exciting from us.</p>
          <div class="d-flex w-100 gap-2">
            <label for="newsletter1" class="visually-hidden">Email address</label>
            <input id="newsletter1" type="text" class="form-control border-primary bg-transparent"
              placeholder="Email address">
            <button class="btn btn-primary bg-gradient" type="button">Subscribe</button>
          </div>
        </form>
      </div>
    </div>
    <div class="d-flex justify-content-between  border-top">
      <p>© 2024 Company, Inc. All rights reserved.</p>
      <ul class="list-unstyled d-flex">
        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
              <use xlink:href="#twitter"></use>
            </svg></a></li>
        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
              <use xlink:href="#instagram"></use>
            </svg></a></li>
        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
              <use xlink:href="#facebook"></use>
            </svg></a></li>
      </ul>
    </div>
    <!-- </footer> -->
    <!-- Footer Ends Here --------------------- -->
  </section>
</body>

</html>