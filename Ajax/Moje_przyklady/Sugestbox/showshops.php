<?php
require_once("../../../../planfinansowy/classes/DataBase.php");


$login_shop_id = $_SESSION['login_shop_id'];
echo "login_shop_id: $login_shop_id<br>";


$table = "shops";
$findrecords = new db();
$order = "shop_name";


$query = Array(
    'parent_category_id' => $parent_category_id
);
$element = "income_expense";
$incomeorexpense = $findrecords->findOneElementInOneRecord($table, $query, $element);

$query = Array(
    'parent_category_id' => $parent_category_id

);

$fields = Array(
    'id',
    'category_name',
);
