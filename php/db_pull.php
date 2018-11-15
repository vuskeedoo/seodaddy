<?php
	$db = new SQLite3("snowball.sqlite3");
	$results = $db->query('SELECT cpc FROM results');
	while ($row = $results->fetchArray()) {
    var_dump($row);
}
?>