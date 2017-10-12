<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AJAX</title>
    <script type="text/javascript" src="ajax.js"></script>
</head>
<body>

<?php
require_once("../../../../planfinansowy/classes/DataBase.php");

$userid = 4;
$table = "categories";
$findrecords = new db();
$order = "category_name";

echo "<form action=\"select.php\" method=\"post\">";
echo "<select name=\"maincategory\" onchange=\"findsubcategories(this.value)\" id=\"mainCategorySelectId\">";
//<select name=\"mid\" onchange=\"ajaxFunction()\" id=\"mid\" width=\"25\">
$query = Array(
    'userid' => $userid,
    'subcategory' => "main",
    'income_expense' => "expense"

);

$fields = Array(
    'id',
    'category_name',
);

$records = $findrecords->findFullRecordsOrdered($table, $fields, $query, $order);
//var_dump($records);

$fieldsSize = count ($fields);
$recordSize = count ($records);

for ($i=0; $i < $recordSize; $i+=$fieldsSize) {
    $categoryid = $records[$i];
    $categoryname = $records[$i + 1];


    echo "<option value=\"$categoryid\">$categoryname</option>";
//echo "<option>Option 2</option>";
}
echo "</select>";


echo "<div id=\"secondSelect\">";
echo "<div>";



echo "</form>";
?>