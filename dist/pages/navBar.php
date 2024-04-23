
<!-- Nav_Bar Begins Here --------------------------- -->
<nav class="navbar navbar-expand-lg bg-transparent">
    <div class="container  align-to-center">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav mx-auto">
          <a class="nav-link active mx-3 text-light font-weight-300" aria-current="page" href="#">About</a>
          <a class="nav-link active text-light font-weight-300" aria-current="page" href="#">Features</a>
          <a class="nav-link active mx-3 text-light font-weight-300" aria-current="page" href="#">Support</a>        
          <a href="index.php?language" class="btn btn-sm btn-language btn-primary bg-gradient text-light font-weight-300" aria-disabled="true">  <img src="/img/Ellipse 2.svg" alt="language Image" width="30" height="30"> Language</a>
        </div>
        <div class = "notification-icon">
          <img src="/img/bell.webp" alt="notification icon" width = "30px" height = "30px">
        </div>
      </div>
          <!-- <h5 class="user-name font-weight-600 align-to-center">name5</h5>
          <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="40" height="40" class="rounded-circle"> -->

          <?php
                echo '<h5 class="user-name font-weight-600 align-to-center">' . $_SESSION["first_name"]. '</h5>';

                echo '<img src="' . $_SESSION['profile_picture'] . '" width="40" height="40" class="rounded-circle" />';
          ?>
       </div>
    </div>
</nav>
<!-- Nav_Bar Ends Here --------------------------- -->

