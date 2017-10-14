<?php
require_once("../../../../planfinansowy/classes/DataBase.php");


//$userid = 4;
$table2 = "categories";
$findrecords2 = new db();
$order2 = "category_name";


$query2 = Array(
    'parent_category_id' => $chosencategoryid

);

$fields2 = Array(
    'id',
    'category_name',
);


$exists2 = $findrecords2->checkHowManyExists($table2, $query2);

if ($exists2 > 0) {
    //echo "<select name=\"subcategory\" id=\"subCategorySelectId\">";
//<select name=\"mid\" onchange=\"ajaxFunction()\" id=\"mid\" width=\"25\">


    $records2 = $findrecords2->findFullRecordsOrdered($table2, $fields2, $query2, $order2);
//var_dump($records);

    $fieldsSize2 = count($fields2);
    $recordSize2 = count($records2);

    for ($i = 0; $i < $recordSize2; $i += $fieldsSize2) {
        $subcategoryid2 = $records2[$i];
        $subcategoryname2 = $records2[$i + 1];

        if (isset ($_POST['subcategory']) && $_POST['subcategory'] == $subcategoryid2) {$checked = "checked";} else {$checked = "";}

        echo "<input type=\"radio\" name=\"subcategory\" value=\"$subcategoryid2\" $checked>$subcategoryname2<br>";

    }
    //echo "<input type=\"hidden\" name=\"subcategoryneeded\" value=\"1\">";
}