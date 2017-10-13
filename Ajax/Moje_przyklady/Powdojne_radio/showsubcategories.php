<?php
require_once("../../../../planfinansowy/classes/DataBase.php");


//if (!isset($_POST['submcategory'])) {echo "dasdas";}

//if (!isset($_POST['submcategory'])) {echo "<div style=\"color: red;\">Wybierz podkategorię</div>";}

//$userid = 4;
$table = "categories";
$findrecords = new db();
$order = "category_name";
$parent_category_id = $_GET['parent_category_id'];

$query = Array(
    'parent_category_id' => $parent_category_id

);

$fields = Array(
    'id',
    'category_name',
);


//echo "parent_category_id: $parent_category_id<br>";


$exists = $findrecords->checkHowManyExists($table, $query);

if ($exists > 0) {
    //echo "<select name=\"subcategory\" id=\"subCategorySelectId\">";
//<select name=\"mid\" onchange=\"ajaxFunction()\" id=\"mid\" width=\"25\">


    $records = $findrecords->findFullRecordsOrdered($table, $fields, $query, $order);
//var_dump($records);

    $fieldsSize = count($fields);
    $recordSize = count($records);

    for ($i = 0; $i < $recordSize; $i += $fieldsSize) {
        $subcategoryid = $records[$i];
        $subcategoryname = $records[$i + 1];

        echo "<input type=\"radio\" name=\"subcategory\" value=\"$subcategoryid\">$subcategoryname<br>";
        //echo "<option value=\"$categoryid\">$categoryname</option>";
//echo "<option>Option 2</option>";
    }
    echo "<input type=\"hidden\" name=\"subcategoryneeded\" value=\"1\">";
}

