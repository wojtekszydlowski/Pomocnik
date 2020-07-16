<?php
//Sumowanie wartości rekordów spełniających określone wymagania

$sql = "SELECT SUM(price) AS totalprice FROM quotedetails WHERE quoteid = '$quoteid';";
$totalprice = $findrecord->getValueFromDB($sql,'totalprice'); // moja funkcja

//Znajdź różne (nie będą się powtarzać) rekordy
$sql = "SELECT DISTINCT senderid FROM messenger WHERE (addresseeid='$CSid' OR addresseeid='$PMid') AND isread='0'";
$sql = "SELECT DISTINCT userid,projectname FROM projects WHERE active='1' AND status<>'Done' AND status<>'Cancelled'";

//-
$sql = "SELECT * FROM przelewy24";
$totalrecords = $findrecord->checkHowManyExistsQueryGiven($sql);

//-

$quotevalid = $checkdateformat->transformDataIntoNewFormat ($valid, "ue", "withdots");

//--

$sql = "SELECT * FROM usersdata WHERE userid='$userid' ORDER BY id LIMIT 0,1";
$customername = $findrecord->getValueFromDB($sql, 'customername');

//---

$sql = "SELECT * FROM quotes WHERE id='$quoteid'";
$fields = Array(
    'userid',
    'valid',
    'package'
);

$records = $findrecord->findAllRecordsQueryGiven($sql, $fields);
$fieldsSize = count($fields);
$recordSize = count($records);


if ($recordSize >= $fieldsSize) {
    for ($i = 0; $i < $recordSize; $i += $fieldsSize) {
        $userid = $records[$i];
        $valid = $records[$i + 1];
        $package = $records[$i + 2];
    }
}

//--

$table = "quotedetails";
$query = Array(
    'quantity' => $quantity[$i],
    'price' => $price[$i] * 100
);
$where = Array(
    'id' => $detailid[$i],
    'quoteid' => $quoteid
);
$findrecord->updateOneRecord($table, $query, $where);

//---


$table2 = "payments";
$query2 = Array(
    'userid' => $userid,
    'orderid' => $orderid,
    'amount' => $amount,
    'currency' => "GBP",
    'paymentdate' => $paymentdate,
    'paymentime' => $paymentime,
    'paymentmethod' => $paymentmethod,
    'description' => $paymentdescription
);
$usersdataid = $findrecord->insertRecord($table2, $query2);

//---

$table = "products_files";
$where = "productid='$productid'";
$findrecord->deleteAllRecords($table, $where);