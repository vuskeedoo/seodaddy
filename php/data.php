<?php
	header('Content-Type: application/json');

	require('function.php');

	function chart() {
		$db = get_connection("snowball.sqlite3");
		
		$results = $db->query('SELECT DISTINCT * FROM results');

		$data = array();

		while ($row = $results->fetchArray()) {
		    $data[] = $row;
		}

		close_connection($db);

		echo(json_encode($data));
	}

	chart();
?>