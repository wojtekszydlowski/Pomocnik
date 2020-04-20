<?php
$bonusesdisplay = number_format($bonuses, 2, ',', ' '); //zapisze 1000.00 jako 1 000,00

//zamieni przecinki na kropki i usunie wszystkie zbędne znaki z ciągu tak aby był on liczbą:
$price = preg_replace('/[^0-9,.]/', '', $price);
$price = preg_replace('/[,]/', '.', $price);
$price = $price * 100;
$price = ceil ($price);