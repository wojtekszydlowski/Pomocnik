<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AJAX</title>
    <script type="text/javascript" src="ajax.js"></script>
</head>
<body>

<!--<script type="text/javascript">-->
<!--function hidedivshowerrormasage () {-->
<!--    document.getElementById('showerrormasage').style.display = "none";-->
<!--}-->
<!---->
<!--</script>-->


<?php
$error = 0;
$errormaincategory = 0;
$errorsubcategory = 0;
$errordescription = 0;
$chosencategoryid = 0;

if (!isset($_POST['subcategoryneeded'])) {$subcategoryneeded=2;} else {$subcategoryneeded =$_POST['subcategoryneeded'];}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//echo "subcategoryneeded: ". $_POST['subcategoryneeded'];

    if (!isset($_POST['maincategory'])) {$error=1; $errormaincategory = 1;} else {$chosencategoryid = $_POST['maincategory'];}
    if (isset($_POST['subcategoryneeded']) && $_POST['subcategoryneeded'] == 1 && !isset($_POST['subcategory'])) {$error=1; $errorsubcategory = 1;}
    if (!isset($_POST['description']) || strlen($_POST['description']) < 3) {$error=1; $errordescription = 1;}

    if ($error == 0 ) {echo "Formularz wysłany.<br><br>";}
}





require_once("../../../../planfinansowy/classes/DataBase.php");
echo "error: $error<br>errormsubcategory: $errorsubcategory<br>subcategoryneeded: $subcategoryneeded<br>";
$userid = 4;
$table = "categories";
$findrecords = new db();
$order = "category_name";

echo "<form action=\"radio.php\" method=\"post\">";
//echo "<div id=\"divmaincategory\" onclick=\"hidedivshowerrormasage()\">";


if ($errormaincategory == 1) {echo "<div style=\"color: red;\">Wybierz kategorię</div>";}

//echo "<select name=\"maincategory\" onchange=\"findsubcategories(this.value)\" id=\"mainCategorySelectId\">";
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

    if ($chosencategoryid == $categoryid) {echo "<input type=\"radio\" name=\"maincategory\" checked value=\"$categoryid\" onclick=\"findsubcategories(this.value)\">$categoryname<br>";} else {echo "<input type=\"radio\" name=\"maincategory\" value=\"$categoryid\" onclick=\"findsubcategories(this.value)\">$categoryname<br>";}
    //echo "<option value=\"$categoryid\">$categoryname</option>";
//echo "<option>Option 2</option>";
}
//echo "</select>";
echo "<input type=\"hidden\" name=\"subcategoryneeded\" value=\"0\">";
//echo "</div>";
echo "<hr>";

if (isset($_POST['maincategory']) && $error == 1) {$hideorshow = "display: block";} else {$hideorshow = "display: none";}
    echo "<div id=\"showerrormasage\" style=\"color: red; $hideorshow\">";
//if ($errorsubcategory == 1) {echo "Wybierz podkategorię<br>";}
if (isset($_POST['maincategory']) && $errorsubcategory == 1) {echo "Wybierz podkategorię<br>";}
    require_once ("loadsubcategories.php");
    echo "</div>";


//echo "<div id=\"showerrormasage\" style=\"color: red; visibility: hidden;\">";
////if ($errorsubcategory == 1) {echo "Wybierz podkategorię<br>";}
//echo "Wybierz podkategorię<br>";
//echo "</div>";

echo "<div id=\"secondSelect\">";

echo "</div>";

echo "<hr>";

if ($errordescription == 1) {echo "Podaj opis<br>";}
echo "Opis: <input type=\"text\" name=\"description\"><br><br>";
echo "<input type=\"submit\" value=\"Wyślij formularz\" />";

echo "</form>";
?>