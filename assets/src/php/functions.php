<?php
session_start();
require_once "../../db/kuberkosh_db.sql";

// for including pages in index.php
function viewPage($page, $page_title = "")
{
    include "assets/src/pages/$page.php";
}

//for creating full site urls
function site_url($path)
{
    $site_url = "http://localhost/offlinewallet/";
    return $site_url . $path;
}

?>