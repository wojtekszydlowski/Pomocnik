<?php
function randHash($len=32)
{
    return substr(md5(openssl_random_pseudo_bytes(20)),-$len);
}

$hashtag1 = randHash(5); //z 5 znaków
$hashtag2 = randHash(20); //z 20 znaków
$hashtag3 = randHash(50); // maksymalnie 32 znaki


//Sprawdzanie czy nie ma takiego kodu już wygnerowanego
$notuniqecode = 1;
$passwordactivationcode = "";
while ($notuniqecode == 1) {
    $passwordactivationcode = randHash(20);
    $sql = "SELECT * FROM users WHERE passwordactivationcode='$passwordactivationcode'";
    $notuniqecode = $findrecords->checkHowManyExistsQueryGiven($sql);
}