<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AJAX</title>
    <script type="text/javascript" src="ajax.js"></script>
</head>
<body>

<script type="text/javascript">
    function hidedivshowerrormasage () {
        console.log ("działa");
        document.getElementById('showerrormasage').style.visibility = 'hidden';
    }

</script>



<?php
echo "<form action=\"probny.php\" method=\"post\">";
echo "<input type=\"radio\" name=\"maincategory\" value=\"1\" onclick=\"javascript:hidedivshowerrormasage();\">1<br>";
echo "<input type=\"radio\" name=\"maincategory\" value=\"2\" onclick=\"javascript:hidedivshowerrormasage();\">2<br>";
echo "</form>";


echo "<div id=\"showerrormasage\" style=\"color: red;\">";
echo "Wybierz podkategorię<br>";
//require_once ("loadsubcategories.php");
echo "</div>";