<?php
$currentdate = date ('Y-m-d'); // 2019-07-08
$currenttime = date ('H:i:s'); //09:01:05

//dodawanie ileś dni do daty
$checkingdate = "2019-09-20";
$checkingdate = date('Y-m-d', strtotime($checkingdate . "+3 day"));

$prepaymentduedate = $NewDate=Date('d.m.Y', strtotime("+7 days"));
$prepaymentduedatedb = $NewDate=Date('Y-m-d', strtotime("+7 days"));

$orderdate = $checkdateformat->transformDataIntoNewFormat ($orderdate, "ue", "withdots");

//timestamp
echo date('d.m.Y | H:i:s', time()); //pokaże aktualną datę i czas

$timestamp = 1572342854;
echo date('d.m.Y | H:i:s', $timestamp); // pokaże 29.10.2019 | 10:54:14

//Dodać miesiąc do wybranej daty
$lastduedate = "2020-05-30";
$time = strtotime($lastduedate);
$duedate = date("Y-m-d", strtotime("+1 month", $time));

//Wykonaj coś jeśli pora dnia jest ok
$currentTime = time();
if (date('H', $currentTime) >= 8 && date('H', $currentTime) < 20) {

}

//różnica czasu w dniach
$currentdate = date ('Y-m-d');
$thirtydayago = $NewDate=Date('Y-m-d', strtotime("-30 days"));
$later = new DateTime($currentdate);
$earlier = new DateTime($thirtydayago); // $thirtydayago dowolną datą w formacie "YYYY-MM-DD"
$diff = $later->diff($earlier)->format("%a");


//sprawdza czy data jest zapisana poprawnie
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}
//wywołanie funkcji: np. validateDate('2013-13-01')