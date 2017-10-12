<?php 

	$link = @mysql_connect("localhost", "root", "vertrigo") or die("nie udało się połączyć");
		
	@mysql_select_db("test") or die ("nie udało się wybrać bazy danych");
	mysql_query("SET NAMES 'utf8'");

	mysql_query("CREATE TABLE wojewodztwa (
					id tinyint unsigned AUTO_INCREMENT,
					nazwa varchar(30) NOT NULL,
					powierzchnia double NOT NULL,
					ludnosc mediumint UNSIGNED NOT NULL,
					PRIMARY KEY(id)
					) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_polish_ci" ) or die("nie udało się, prawdopodobnie istnieje już taka tabelka");
	
	
	
	mysql_query("INSERT INTO wojewodztwa (nazwa, powierzchnia, ludnosc)
				VALUES
				('dolnośląskie', 19946.77, 2878410),
				('kujawsko-pomorskie', 17971.69, 2066136),
				('lubelskie', 25122.50, 2166213),
				('lubuskie', 13987.88, 1008481),
				('łódzkie', 18218.96, 2555898),
				('małopolskie', 15182.79, 3279036),
				('mazowieckie', 35558.14, 5188488),
				('opolskie', 9411.67, 1037088),
				('podkarpackie', 17845.73, 2097338),
				('podlaskie', 20187.01, 1192660),
				('pomorskie', 18310.22, 2210920),
				('śląskie', 12333.51, 4654115),
				('świętokrzyskie', 11710.20, 1275550),
				('warmińsko-mazurskie', 24173.35, 1426155),
				('wielkopolskie', 29826.51, 3386882),
				('zachodniopomorskie', 22892.48, 1692271)") or die("nie udało się dodać rekordów");

	
	mysql_close($link);

?>