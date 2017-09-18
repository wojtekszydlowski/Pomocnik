window.onload = ajaxInit;
function ajaxInit() 
{
	document.getElementById('tekst').onmouseover = function(evt)
	{
		/*if (evt)
		  evt.target.style.cursor='pointer';
		else
		  window.event.srcElement.style.cursor='pointer';
		  */
		var obj = (evt) ? evt.target : window.event.srcElement;
		
		obj.style.cursor = 'pointer';
	}
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

function fileToDiv(id, URL)
{
	XHR = ajaxInit();
	
	if (XHR != null)
	{
		XHR.open("GET", URL+"?random="+Math.random(), true);
		
		XHR.onreadystatechange = function()
		{
			if (XHR.readyState == 1 || XHR.readyState == 2 || XHR.readyState == 3)
			{
				document.getElementById('tekst').innerHTML = "<img src='ajax-loader.gif' alt='Wczytują się dane' />";
			}
		    else if (XHR.readyState == 4)
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
