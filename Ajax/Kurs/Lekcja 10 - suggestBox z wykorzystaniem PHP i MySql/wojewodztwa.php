<?php

	$link = @mysql_connect("localhost", "root", "vertrigo") or die("nie udało się połączyć");
		
	@mysql_select_db("test") or die ("nie udało się wybrać bazy danych");
	mysql_query("SET NAMES 'utf8'");

	$result = mysql_query("SELECT nazwa, powierzchnia, ludnosc FROM wojewodztwa") or die("nie udało się pobrać danych");
	
	header("Content-type: text/xml");
	
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
	
	echo "<Województwa>";
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		echo "<Województwo>";
		foreach($row as $klucz => $wartosc)
		{
			if ($klucz == "nazwa")
			    echo "<Nazwa>".$wartosc."</Nazwa>";
			else if ($klucz == "powierzchnia")
				echo "<Powierzchnia>".$wartosc."</Powierzchnia>";
			else if ($klucz == "ludnosc")
				echo "<Ludność>".$wartosc."</Ludność>";		
		}	
		echo "</Województwo>";
	}
	
	echo "</Województwa>";
	
	mysql_close($link);
?>