<div class="wrapper navbardiv">
        <aside id="sidebar" class="sidebar">
            <div class="d-flex">

                <div class= "toggle-btn">
                    <img src="img/Logo.svg" alt="kuberkosh logo" width="35px" hight="35px">
                </div>
                <div class="sidebar-logo">
                    <a href="#" class="sidebar-attribute">KuberKosh</a>
                </div>
            </div>
            <ul class="sidebar-nav p-0">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-attribute sidebar-link">
                        <!-- <i class="lni lni-user"></i> -->
                        <!-- <img src="img/google.svg" alt="profile logo" width="25px" hight="25px"> -->
                        <i> <img src="img/dashLogo.svg" alt="Dashboard Icon" width="25px" hight="25px"> </i>

                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-attribute sidebar-link">
                        <i> <img src="img/sendLogo.svg" alt="Send Money Icon" width="25px" hight="25px"> </i>
                        <span>Send Money</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-attribute sidebar-link">
                        <i> <img src="img/receiveLogo.svg" alt="Receive Money Icon" width="25px" hight="25px"> </i>
                        <span>Receive Money</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-attribute sidebar-link">
                        <i> <img src="img/addLogo.svg" alt="Add Money Icon" width="25px" hight="25px"> </i>
                        <span>Add Money</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-attribute sidebar-link">
                        <i> <img src="img/withdrawLogo.svg" alt="Withdraw Icon" width="25px" hight="25px"> </i>
                        <span>Withdraw Money</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-attribute sidebar-link">
                        <i> <img src="img/transacctionsLogo.svg" alt="Transactions Icon" width="25px" hight="25px"> </i>
                        <span>Transactions</span>
                    </a>
                </li>
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-attribute sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Auth</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-attribute sidebar-link">Login</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-attribute sidebar-link">Register</a>
                        </li>
                    </ul>
                </li> -->
            </ul>

            <ul class = "sidebar-nav p-0">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-attribute sidebar-link">
                        <i> <img src="img/profileLogo2.svg" alt="Profile Icon" width="25px" hight="25px"> </i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-attribute sidebar-link">
                        <i> <img src="img/settingsLogo.svg" alt="Settings Icon" width="25px" hight="25px"> </i>
                        <span>Settings</span>
                    </a>
                </li>                
            </ul>

            <div class="sidebar-footer togglebtn">
                <a href="#" class="sidebar-attribute sidebar-link">
                    <!-- <i class="lni lni-exit"></i> -->
                    <i> <img src="img/collapseLogo.svg" alt="Collapse Icon" width="25px" hight="25px"> </i>
                    <span>Collapse</span>
                </a>
            </div>

        </aside>
    </div>
    <script>
        const hamBurger = document.querySelector(".togglebtn");

        hamBurger.addEventListener("click", function () {
        document.querySelector("#sidebar").classList.toggle("expand");
        });
    </script>


