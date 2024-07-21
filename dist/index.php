<?php
/*
This program handles page navigation based on URL parameters.
It directs users to different pages such as home, login, signup,
MFA (Multi-Factor Authentication), dashboard, settings,
and various transaction-related pages. It also ensures that
user sessions are verified for certain pages like dashboard,
settings, and other transaction-related pages. Each page is
presented with relevant components, like navigation bars and
sidebars, based on the parameter specified in the URL.
*/

require_once ('php/functions.php');

if ((isset($_GET['home']))) {
    // for home page
    viewPage('home');
} elseif (isset($_GET['login'])) {
    // for login page
    viewPage('auth');
} elseif (isset($_GET['signup'])) {
    // for signup page
    viewPage('auth');
} elseif (isset($_GET['mfa'])) {
    // for MFA page
    viewPage('MFA');
} elseif (isset($_GET['dash'])) {
    // for dashboard page
    viewPage('verifySession');
    viewPage('dash');
    viewPage('collapsableSideBar');
    viewPage('navBar');
    viewPage('dash2');
} elseif (isset($_GET['logout'])) {
    // for logout page
    viewPage('logout');
} elseif (isset($_GET['settings'])) {
    // for settings page
    viewPage('verifySession');
    viewPage('settings1');
    viewPage('collapsableSideBar');
    viewPage('navBar');
    viewPage('settings2');
}
elseif (isset($_GET['send'])) {
    // for send money page
    viewPage('verifySession');
    viewPage('sendMoneyPart1');
    viewPage('collapsableSideBar');
    viewPage('navBar');
    viewPage('sendMoneyPart2');
} elseif (isset($_GET['profile'])) {
    // for profile page
    viewPage('verifySession');
    viewPage('profile1');
    viewPage('collapsableSideBar');
    viewPage('navBar');
    viewPage('profile2');
} elseif (isset($_GET['withdraw-money'])) {
    // for withdraw money page
    viewPage('verifySession');
    viewPage('withdrawMoney1');
    viewPage('collapsableSideBar');
    viewPage('navBar');
    viewPage('withdrawMoney2');
} elseif (isset($_GET['transactions'])) {
    // for transactions page
    viewPage('verifySession');
    viewPage('transactions1');
    viewPage('collapsableSideBar');
    viewPage('navBar');
    viewPage('transactions2');
} elseif (isset($_GET['request'])) {
    // for request money page
    viewPage('verifySession');
    viewPage('requestMoney1');
    viewPage('collapsableSideBar');
    viewPage('navBar');
    viewPage('requestMoney2');
} elseif (isset($_GET['add-money'])) {
    // for add money page
    viewPage('verifySession');
    viewPage('addMoney1');
    viewPage('collapsableSideBar');
    viewPage('navBar');
    viewPage('addMoney2');
}
