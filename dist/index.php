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
        viewPage('collapsableSideBar');
        viewPage('navBar');
        viewPage('dash2');
}elseif(isset($_GET['database'])){
    // for dashboard page
        viewPage('database');
}
elseif(isset($_GET['logout'])){
    // for dashboard page
        viewPage('logout');
}
elseif(isset($_GET['settings'])){
    // for send money page
        viewPage('settings1');
        viewPage('collapsableSideBar');
        viewPage('navBar');
        viewPage('settings2');
}
elseif(isset($_GET['send'])){
    // for send money page
        viewPage('sendMoneyPart1');
        viewPage('collapsableSideBar');
        viewPage('navBar');
        viewPage('sendMoneyPart2');
}
elseif(isset($_GET['profile'])){
    // for send money page
        viewPage('profile1');
        viewPage('collapsableSideBar');
        viewPage('navBar');
        viewPage('profile2');
}
elseif(isset($_GET['send-verify'])){
    // for send money page
        viewPage('sendMoneyVerify1');
        viewPage('collapsableSideBar');
        viewPage('navBar');
        viewPage('sendMoneyVerify2');
}
elseif(isset($_GET['send-confirm'])){
    // for send money page
        viewPage('sendMoneyConfirmation1');
        viewPage('collapsableSideBar');
        viewPage('navBar');
        viewPage('sendMoneyConfirmation2');
}
elseif(isset($_GET['test'])){
    // for send money page
        viewPage('settings1');
        viewPage('collapsableSideBar');
        viewPage('navBar');
        viewPage('test');
}
elseif(isset($_GET['withdraw-money'])){
    // for send money page
        viewPage('settings1');
        viewPage('collapsableSideBar');
        viewPage('navBar');
        viewPage('withdrawMoney2');
}
elseif(isset($_GET['transactions'])){
    // for send money page
        viewPage('transactions1');
        viewPage('collapsableSideBar');
        viewPage('navBar');
        viewPage('transactions2');
}
elseif(isset($_GET['request'])){
    // for send money page
        viewPage('requestMoney1');
        viewPage('collapsableSideBar');
        viewPage('navBar');
        viewPage('requestMoney2');
}
elseif(isset($_GET['add-money'])){
    // for send money page
        viewPage('addMoney1');
        viewPage('collapsableSideBar');
        viewPage('navBar');
        viewPage('addMoney2');
}