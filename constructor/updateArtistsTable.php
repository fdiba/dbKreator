<?php require("access/connexion.php"); ?>
<?php

$firstName = $_POST['firstName'];
$name = $_POST['name'];
$country = $_POST['country'];


//--- search id country ---//


$arr = array();

$sth = $dbh->query("SELECT * from country
					WHERE c_name ='" . $country . "' LIMIT 1");

$sth->setFetchMode(PDO::FETCH_ASSOC);

while($row = $sth->fetch()) {
	array_push($arr, $row['id']);
}

$id_country = $arr[0];

//--- add new row ---//

$dbh->exec("INSERT INTO artist (firstName, name, id_country)
			SELECT * FROM (SELECT '" . $firstName . "',
								  '" . $name . "',
								  '" . $id_country . "')AS tmp
			WHERE NOT EXISTS (
				SELECT name FROM artist WHERE firstName ='" . $firstName ."'
				AND name = '" . $name . "') LIMIT 1;")

			or die(print_r($dbh->errorInfo()[2] . "\n" . 
				"already in =====> " . $firstName . " " . $name, true));

echo $firstName . " " . $name;

$dbh=null;

?>