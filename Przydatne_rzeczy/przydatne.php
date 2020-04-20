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