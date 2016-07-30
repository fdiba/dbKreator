<?php require("access/connexion.php"); ?>
<?php

$firstName = $_POST['firstName'];
$name = $_POST['name'];
$ed_year = 'ed_' . $_POST['year'];

//--- search artist id ---//


$arr = array();

$sth = $dbh->query("SELECT * from artist
					WHERE firstName ='" . $firstName . "'
					AND name = '" . $name . "'
					LIMIT 1");


$sth->setFetchMode(PDO::FETCH_ASSOC);

while($row = $sth->fetch()) {
	array_push($arr, $row['id']);
}

$id_artist = $arr[0];

//--- add new row ---//

$dbh->exec("INSERT INTO edition (artist_id, " .$ed_year. ")
			VALUES('" . $id_artist . "', 1)
			ON DUPLICATE KEY UPDATE
			artist_id= '" . $id_artist . "', " .$ed_year. "=1")

	or die(print_r($dbh->errorInfo()[2] . "\n" .
		"already in =====> " . $id_artist . " " . $firstName . " " . $name, true));

echo $id_artist . " " . $firstName . " " . $name;

$dbh=null;

?>