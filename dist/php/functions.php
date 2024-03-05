<?php
session_start();
// require_once "../../db/kuberkosh_db.sql";

// for including pages in index.php
function viewHTML($page, $page_title = "")
{
    echo "Including: $page.php";
    // include "pages/$page.html";
    require_once "pages/signup.php";
}

function viewPage($page, $page_title = "")
{
    include "pages/$page.php";
}


//for creating full site urls
function site_url($path)
{
    $site_url = "http://localhost/kuberkosh/";
    return $site_url . $path;
}

?>