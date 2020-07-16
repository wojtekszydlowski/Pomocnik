<?php
//Ważne linki:
//https://stackoverflow.com/questions/26465712/ajax-call-not-working-second-time


//PRZYKŁAD 1: Zmiana statusu faktury po kliknięciu przycisku - działa w dwie strony - ważna linia 14: $('body').on('click' , '.autoissuebutton', function() {
//W html:
$autoissuebuttonid = "autoissuebuttonid" . $invoiceid;
if ($invoicestatus == 0 || $invoicestatus == 3) {$autoissuebutton = "<button type=\"button\" class=\"autoissuebutton mb-1 mt-1 mr-1 btn btn-xs btn-success\"  title=\"Wystaw automatycznie fakturę\" data-invoiceid=\"$invoiceid\"><i class=\"fas fa-file-upload\"></i></button>";} else {$autoissuebutton = "";}

//W ajax
?>
<script>
$('body').on('click' , '.autoissuebutton', function() {
    var invoiceid = $(this).attr('data-invoiceid');
    $.ajax({
            type:'POST',
            dataType:'JSON',
            url:'ajax_changeinvoicestatus.php',
            data:'invoiceid='+invoiceid,
            success:function(data)
            {
                //var data=eval(data);
                newinvoicestatus=data.newinvoicestatus;
                invoiceid = data.invoiceid;
                console.log (invoiceid);
                console.log (newinvoicestatus);
                if (newinvoicestatus == 1) {
                    $("#invoicestatusid"+invoiceid).html('<button type="button" class="btn btn-info btn-xs mb-2">Oczekuje</button>');
                    $('#autoissuebuttonid'+invoiceid).html('<button type="button" class="autoissuebutton mb-1 mt-1 mr-1 btn btn-xs btn-dark" title="Wróć fakturę do nierozliczonych" data-invoiceid="'+invoiceid+'"><i class="fas fa-file-download"></i></button>');
                }
                if (newinvoicestatus == 0) {
                    $("#invoicestatusid"+invoiceid).html('<button type="button" class="btn btn-warning btn-xs mb-2">Nierozliczona</button>');
                    $('#autoissuebuttonid'+invoiceid).html('<button type="button" class="autoissuebutton mb-1 mt-1 mr-1 btn btn-xs btn-success" title="Wystaw automatycznie fakturę" data-invoiceid="'+invoiceid+'"><i class="fas fa-file-upload"></i></button>');
                }

            }
        });
    });
</script>

<?php
//Plik ajaz_changeinvoicestatus.php
require_once("../classes/DataBase.php");
$findrecord = new db();

if (isset($_POST['invoiceid'])) {$invoiceid = $_POST['invoiceid'];} else {$invoiceid = 0;}
$newinvoicestatus = 1;

$sql = "SELECT * FROM orders_invoicedata WHERE id='$invoiceid' ORDER BY id LIMIT 0,1";
$currentinvoicestatus = $findrecord->getValueFromDB($sql, 'invoicestatus');

if ($currentinvoicestatus == 1 || $currentinvoicestatus == 3) {$newinvoicestatus = 0;}

$table = "orders_invoicedata";
$query = Array(
    'invoicestatus' => $newinvoicestatus
);
$where = Array(
    'id' => $invoiceid
);
$findrecord->updateOneRecord($table, $query, $where);


echo json_encode(array('newinvoicestatus'=>$newinvoicestatus, 'invoiceid'=>$invoiceid));