window.onload = ajaxInit;
function ajaxInit()
{
    var XHR = null;

    try
    {
        XHR = new XMLHttpRequest();
    }
    catch(e)
    {
        try
        {
            XHR = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e2)
        {
            try
            {
                XHR = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e3)
            {
                alert("Niestety Twoja przeglądarka nie obsługuje AJAXA");
            }
        }
    }

    return XHR;
}



function sugestshop(id)
{
    XHR = ajaxInit();
    //document.getElementById('showerrormasage').style.display = "none";

    // document.getElementById('errorcategoriescomment').style.display = "none";
    // document.getElementById('maincategoryselecthaserror').classList.remove('has-error');
    // document.getElementById('maincategoryselect_i').classList.remove('font-red');
    // document.getElementById('maincategoryselect_i').classList.add('font-grey-mint');
    // document.getElementById('maincategoryselect_span').classList.remove('font-red');
    // document.getElementById('maincategoryselect_span').classList.add('font-grey-mint');
    // document.getElementById('additionalsubcategorydiv').style.display = "none";





    if (XHR != null) // gdy jest równe null to znaczy, że przeglądarka nie obsługuje ajaxa i po prostu nie będziemy nic wykonywać
    {
        //XHR.open("GET", "showsubcategories.php?parent_category_id=" + id, true);
        XHR.open("GET", "showshops.php", true);
        //"URL+"?random="+Math.random(), true); //otwarcie metody. Open ma 3 parametry. Pierwszy (GET lub POST) pobiera coś z serwera. Drugi mówi skąd mamy to pobrać (u nas URL np.plik1.txt). Trzeci parametr - czy ma być asynchroniczne (true) czy synchroniczne (false). Poza tym w IE URL jest cachowany (pamięta co było, co nie jest dobre dla naszego ajaxa). Dlatego dodaliśmy tutaj losowo zmieniany adres.

        XHR.onreadystatechange = function()
        {
            if (XHR.readyState == 4) //4 oznacza, że nasze dane zostały już pobrane, jest sukces (wszystko jest OK, odpowiedź została odebrana). 0 -niezainicjowane, 1  -w trakcie pobierania, 2 -pobrano, 3 - interaktywne, 4 - gotowe.
            {
                if (XHR.status == 200)
                    document.getElementById('secondSelect').innerHTML = XHR.responseText;

                else
                    alert("Wystąpił błąd!");
            }
        }

        XHR.send(null);
    }
