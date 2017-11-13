<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
	<title>Hier koennte Ihre Werbung stehen</title>
	</head>
	<body>
	<?php
	
	$formularAufbauen= false;
	
	$db_host="";
	$db_user="";
	$db_password="";
	$db_database="";
	
	$name="";
	$passwort="";
	$geburtstag="";
	$eMail="";
	
	
	if(! isset($_POST['DatenUebernehmen']))
	{
		$formularAufbauen=true;
	}
	else
	{
		if(!empty($_POST['Name']))
		{
			$name=$_POST['Name'];
		}
		if(!empty($_POST['Passwort']))
		{
			$passwort=$_POST['Passwort'];
		}
		if(!empty($_POST['Geburtstag']))
		{
			$geburtstag=$_POST['Geburtstag'];
		}
		$eMail=$_POST['eMail'];
	if(empty($name)||empty($passwort)||empty($geburtstag))
	{
		echo 'Es wurde eines der Pflichtfelder nicht eingetragen(Name,Passwort und Geburtstag)!';
		formularAufbauen = true;
	}
		else
		{
			$verbindung =mysqli_connect($db_host,$db_user,$db_password,$db_database)
				or die("Keine Verbindung zur Datenbank moeglich".mysqli_connect_error());
			echo ("Verbindung wurde Erforlgreich hergestellt!");
			
			$abfrage = "SELCET * FROM nameDatenbank WHERE nameDatenbank.Name =$name";
			$ergebnis = mysqli_query($verbindung,$abfrage)
				or die ("SELECT Abfrage fehlgeschlagen".mysqli_error($verbindung));
				
			$abfrage ="SELECT nameDatenbank.Geburtstag FROM nameDatenbank 
				WHERE nameDatenbank.Geburtstag=$geburtstag";
			$ergebnis =mysqli_query($verbindung,$abfrage)
				or die("Die Abfrage ist fehlgeschlagen". mysqli_error($verbindung));
			$satz = mysqli_fetch_array($ergebnis,MYSQLI_ASSOC);
			 $geburtstag=$satz['Geburtstag'];
			
			//Freigeben des Speichers		
			mysqli_free_result($ergebnis);
			//Verbindung beenden
			mysqli_close($verbindung);
		}

    }
if($formularAufbauen == true)
{
	?>
 <form name ="" action="<?php echo $_SERVER['PHP_SELF'];?>"method="post">
 <fieldset>
 <legend>Test</legend>
 
	<div class="tabellenzeile">
	<label for="Name">Ihr Name: </label>
	<input type="text" name="Name"
		value <?php if(!empty($name)){echo $name;}?>
	</div>
	
	<div class="tabellenzeile">
	<label for="Passwort">Dein Passwort: </label>
	<input type="text" name="Geburtstag"
		value <?php if(!empty($passwort)){echo $passwort;}?>
	</div>
	
	<div class="tabellenzeile">
	<label for="Geburtstag">Dein Geburtstag: </label>
	<input type="text" name="Geburtstag"
		value <?php if(!empty($geburtstag)){echo $geburtstag;}?>
	</div>
	
	<div class="tabellenzeile">
	<label></label>
	<input type="submit" value="Daten akzeptieren" name="DatenUebernehmen">
	<input type="reset" value="Daten loeschen">
	</div>
	</fieldset>
	</form>
	
	<?php
	}
	?>
	</body>
	</html>