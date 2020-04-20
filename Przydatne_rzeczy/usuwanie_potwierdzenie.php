<script type="text/javascript">

    $(document).ready(function e() {

        $(".delete_article").click(function(){
            var articleid = $(this).attr('data-articleid');

            if(confirm('Na pewno usunąć ten artykuł?'))
            {
                $.ajax({
                    url: 'blog_deletearticle.php',
                    type: 'GET',
                    data: {articleid: articleid},
                    error: function() {
                        alert('Błąd');
                    },
                    success: function(data) {
                        $("#articlelist"+articleid).remove();
                    }



                });
            }
        });
    });

</script>
<?php
$deletebutton = "<a class=\"delete_article\" data-articleid=\"$articleid\"><button class=\"btn btn-danger btn-xs\">Usuń artykuł</button></a>";

$tr_id = "articlelist" . $articleid;
echo "<tr id=\"$tr_id\">";
echo "<td>$articleid</td>";
echo "<td>$articledate</td>";
echo "<td><a href=\"blog_editarticle-$articleid\">$title</a></td>";
echo "<td>$deletebutton</td>";
echo "</tr>";


#blog_deletearticle.php
session_start();
require_once("../classes/DataBase.php");
require_once ("checkifloginisneeded.php");
$findrecord = new db();


if (isset($_SESSION['adminauthorizationcashisback']) && ($_SESSION['adminauthorizationcashisback'] == "admin")) {

    if (isset($_GET['articleid'])) {$articleid = $_GET['articleid'];} else {$articleid = 0;}


    //DELETE ARTICLE
    $table = "blog";
    $where = "id='$articleid'";
    $findrecord->deleteAllRecords($table, $where);


}


?>
<!--WERSJA Z OKIENKAMI MODALNYMI-->
<script type="text/javascript">

    $(document).ready(function e() {

        $(".delete_sliderphoto").click(function(){
            var sliderphotoid = $(this).attr('data-sliderphotoid');
            $('.modalsliderphotoid').val(sliderphotoid);
        });
    });

</script>

<div class="modal fade" id="modalDeleteSliderPhoto" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">×</span></button>
                <h5 class="modal-title">Are you sure you want to delete this photo?</h5>
            </div>
            <form method="post" action="add_photo_to_portfolio" enctype="multipart/form-data">
                <div class="modal-footer">
                    <button class="btn btn-default btn-sm" type="submit" data-dismiss="modal">Close</button>
                    <button class="btn btn-crimson btn-sm" type="submit">Delete slider photo</button>
                </div>
                <input type="hidden" class="modalsliderphotoid" name="sliderphotoid" value="">
            </form>
        </div>
    </div>
</div>