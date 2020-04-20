<?php
//Aktualna ścieżka url:

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $currenturl = "https://";
else
    $currenturl = "http://";
// Append the host(domain name, ip) to the URL.
$currenturl.= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL
$currenturl.= $_SERVER['REQUEST_URI'];