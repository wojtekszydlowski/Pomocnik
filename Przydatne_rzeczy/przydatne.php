<?php
// Walidacja adresu mailowego
if (filter_var($emailregister, FILTER_VALIDATE_EMAIL)) {
    $erroremailtxt = "";
    $emailregister = trim($emailregister);
} else {
    $error = 1;
    $erroremailtxt = "<em class=\"has-error-txt\">Wpisz poprawny adres email</em>";
    $emailclass = "has-error";
}


//Pobieranie plików przez header
//https://www.tutorialrepublic.com/php-tutorial/php-file-download.php

$quoted = sprintf('"%s"', addcslashes(basename($file), '"\\'));
$size   = filesize($file);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . $quoted);
header('Content-Transfer-Encoding: binary');
header('Connection: Keep-Alive');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . $size);