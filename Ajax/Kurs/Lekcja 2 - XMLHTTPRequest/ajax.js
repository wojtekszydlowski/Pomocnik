// Wywołanie XHR = new XMLHttpRequest(); działa we wszystkich przeglądarkach oprócz IE, dlatego musimy wyłapać wyjątek (catch(e)) i jeśli on wystąpi to wtedy próbujemy poprzez XHR = new ActiveXObject("Msxml2.XMLHTTP"); zainicjować zmienną dla IE itd.


var XHR = null; //ustawienie zmiennej XHR jako globalnej
function ajaxInit() 
{

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
