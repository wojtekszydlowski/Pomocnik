<!--Po kliknięciu na checkbox zaznacza/odzacza wszystkie checkboxy o tej samej klasie:-->
<script type="text/javascript">

    $(document).ready(function e() {

        $("input:checkbox").change(function () {
            //alert('Ok!');
            var value = $(this).attr("class");
            $(":checkbox[class='" + value + "']").prop("checked", this.checked);
        })
    });
</script>


<!--Sprawdzanie wartości pola input przy jakiejkolwiek zmianie i dodanie wartości do wszystkich inputów z tą samą klasą -->
<script type="text/javascript">

    $(document).ready(function e() {
        $(".filmtitle").on("input", function(){
            var value = $(this).val();
            $('.filmtitle').val(value);
        });

    });

</script>