
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump ($_FILES);
    var_dump($_POST);
}
?>


<div>Załącz plik </div>
<form action="file_upload.php" method="post" enctype="multipart/form-data">
    <input type="text" name="description"><br>
    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*">
    <input type="submit" name="uploadFile31" value="Wyślij plik" name="submit">

</form>

<?php