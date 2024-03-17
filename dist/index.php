<?php
require_once('php/functions.php');
// sleep(2);

if((isset($_GET['home']))){ 
    //for home page
        viewPage('home');
}elseif(isset($_GET['login'])){
    // for login page
        viewPage('auth');
    
}elseif(isset($_GET['signup'])){
    // for signup page
        viewPage('auth');
    
}elseif(isset($_GET['dash'])){
    // for dashboard page
        viewPage('dash');
    
}elseif(isset($_GET['database'])){
    // for dashboard page
        viewPage('database');
}
elseif(isset($_GET['logout'])){
    // for dashboard page
        viewPage('logout');
}
elseif(isset($_GET['bank'])){
    // for dashboard page
        viewPage('bank');
}
elseif(isset($_GET['settings'])){
    // for dashboard page
        viewPage('settings');
}
elseif(isset($_GET['set'])){
    // for dashboard page
        viewPage('set');
}