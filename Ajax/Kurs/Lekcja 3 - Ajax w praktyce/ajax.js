window.onload = ajaxInit; //żeby nie dawać w <body onload="ajaxInit();> to damy tutaj, że po załadowaniu się strony w przeglądarce ma się uruchomić funkcja ajaxInit
function ajaxInit() 
{
	document.getElementById('tekst').onmouseover = function(evt)
	{
		/*if (evt)
		  evt.target.style.cursor='pointer';
		else
		  window.event.srcElement.style.cursor='pointer';
		  */
		var obj = (evt) ? evt.target : window.event.srcElement; //jeśli istnieje evt to przypisz mi target, w innym przypadku daj window.event.srcElement (to jest dla przeglądarki IE)
		
		obj.style.cursor = 'pointer';
	}
	var XHR = null; //tutaj jako zmienną lokalną to definujemy
	
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

function fileToDiv(id, URL)
{
	XHR = ajaxInit();
	
	if (XHR != null) // gdy jest równe null to znaczy, że przeglądarka nie obsługuje ajaxa i po prostu nie będziemy nic wykonywać
	{
		XHR.open("GET", URL+"?random="+Math.random(), true); //otwarcie metody. Open ma 3 parametry. Pierwszy (GET lub POST) pobiera coś z serwera. Drugi mówi skąd mamy to pobrać (u nas URL np.plik1.txt). Trzeci parametr - czy ma być asynchroniczne (true) czy synchroniczne (false). Poza tym w IE URL jest cachowany (pamięta co było, co nie jest dobre dla naszego ajaxa). Dlatego dodaliśmy tutaj losowo zmieniany adres.
		
		XHR.onreadystatechange = function()
		{
			if (XHR.readyState == 4) //4 oznacza, że nasze dane zostały już pobrane, jest sukces (wszystko jest OK, odpowiedź została odebrana). 0 -niezainicjowane, 1  -w trakcie pobierania, 2 -pobrano, 3 - interaktywne, 4 - gotowe.
			{
				if (XHR.status == 200)
				  document.getElementById('tekst').innerHTML = XHR.responseText;
				else
				  alert("Wystąpił błąd "+XHR.status+ " proszę o kontakt na...");
			}
		}
		
		XHR.send(null);
	}
}
