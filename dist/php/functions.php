<?php
session_start();
// require_once "../../db/kuberkosh_db.sql";

// for including pages in index.php
function viewHTML($page, $page_title = "")
{
    include "assets/src/pages/$page.html";
}

function viewPage($page, $page_title = "")
{
    include "assets/src/pages/$page.php";
}


//for creating full site urls
function site_url($path)
{
    $site_url = "http://localhost/kuberkosh/";
    return $site_url . $path;
}

?>