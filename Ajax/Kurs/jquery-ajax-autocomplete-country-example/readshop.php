<?php
require_once("../../../../planfinansowy/classes/DataBase.php");
$shops = new db();
if(!empty($_POST["keyword"])) {


    $findShopName = $_POST["keyword"];
    $table = "shops";
    $findrecords = new db();
    $query = Array(
        'shop_name' => $_POST["keyword"]
        //'shop_name' => "a"
    );

    $fields = Array(
        'id',
        'shop_name',
    );
    $order = "shop_name";
    $limit = 3;

    $sql = "SELECT id, shop_name FROM shops WHERE shop_name LIKE '$findShopName%' AND (userid='0' OR userid='1') ORDER BY shop_name LIMIT 0,3";


    $records = $findrecords->findAllRecordsQueryGiven($sql,$fields);


    $fieldsSize = count($fields);
    $recordSize = count($records);


    if ($recordSize > 0) {

        echo "<ul id=\"country-list\">";
        for ($i = 0; $i < $recordSize; $i += $fieldsSize) {
            $shopid = $records[$i];
            $shopname = $records[$i + 1];
            echo "<li onClick=\"selectCountry('$shopname');\">$shopname</li>";
        }
        echo "<ul>";
    }
}




