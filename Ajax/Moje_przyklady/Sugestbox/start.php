<html>
<head>
    <TITLE>jQuery AJAX Autocomplete - Country Example</TITLE>
    <head>
        <style>
            body{width:610px;}
            .frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
            #country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
            #country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
            #country-list li:hover{background:#ece3d2;cursor: pointer;}
            #search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
        </style>
        <script src="../../../../planfinansowy/assets/global/jquery/jquery-3.2.1.js" type="text/javascript"></script>
        <script type="text/javascript" src="ajax.js"></script>
    </head>
<body>
<?php
if(!isset($_SESSION['login_shop_id'])) {$_SESSION['login_shop_id'] = 4;}
?>
<div class="frmSearch">
    <input type="text" id="search-box" placeholder="Country Name" onkeyup="sugestshop()"/>
    <div id="suggesstion-box"></div>
</div>
</body>
</html>