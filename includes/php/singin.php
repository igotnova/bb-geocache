<?php
require_once 'db_config.php';


	IF(isset($_POST["singinform"]))
	{
		IF ($_POST['wachtwoord1']==$_POST['wachtwoord2'])
		{
			try
			{
				$ww=password_hash($_POST['wachtwoord1'], PASSWORD_DEFAULT);
				$sQuery = "INSERT INTO klanten (Voornaam, Achternaam, Bedrijf, Email, Telefoonnummer, Postcode, Woonplaats, Adres, wachtwoord)
				VALUES (:Voornaam, :Achternaam, :Bedrijf, :Email, :Telefoonnummer, :Postcode, :Woonplaats, :Adres, :wachtwoord)";
				$oStmt = $db->prepare ($sQuery);
				$oStmt->bindValue(':Voornaam', $_POST['Voornaam'], PDO::PARAM_STR);
				$oStmt->bindValue(':Achternaam', $_POST['Achternaam'], PDO::PARAM_STR);
				$oStmt->bindValue(':Bedrijf', $_POST['Bedrijf'], PDO::PARAM_STR);
				$oStmt->bindValue(':Email', $_POST['Email'], PDO::PARAM_STR);
				$oStmt->bindValue(':Telefoonnummer', $_POST['Telefoonnummer'], PDO::PARAM_STR);
				$oStmt->bindValue(':Postcode', $_POST['Postcode'], PDO::PARAM_STR);
				$oStmt->bindValue(':Woonplaats', $_POST['Woonplaats'], PDO::PARAM_STR);
				$oStmt->bindValue(':Adres', $_POST['Adres'], PDO::PARAM_STR);
				$oStmt->bindValue(':wachtwoord', $ww, PDO::PARAM_STR);
				$oStmt->execute();
				echo "<P>Welkom ".$_POST['Voornaam']."</p>";
				echo "<p>regestratie is succesvol </p>";
				echo "<p>uw klantnummer is ".$db->lastInsertId()."</p>";
				
			}
			catch(PDOException $e)	
			{
				$sMsg = '<p>
						Regelnummer: '.$e->getLine().'<br />
						Bestannd: '.$e->getFile().'<br />
						Fotmelding: '.$e->getMessage().'
					</p>';
				trigger_error($sMsg);
			}
		}
			
		else
		{
			header('Refresh: 3; url=singinform.php');
			echo 'wachtwoord1 en wachtwoord2 zijn niet gelijk!';
		}			
	}
	?>
	<a href="singinform.php><input type ="button" value ="terug></a>