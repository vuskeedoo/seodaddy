<?php

	require("RestAPI.php");

	function get_connection($filename) {
		$db = new SQLite3($filename);
		return $db;
	}

	function close_connection($database) {
		$database->close();
	}

	function insert($sql) {
		$db = get_connection("snowball.sqlite3");
		$ret = $db->exec($sql);
		if(!$ret) {
			echo $db->lastErrorMsg();
		} else {
			echo $sql;
		}
		close_connection($db);
	}

	function output() {
		$db = get_connection("snowball.sqlite3");
		$results = $db->query('SELECT DISTINCT query, key, country_code, cpc, search_volume, competition FROM results');
		while($row = $results->fetchArray()) {
	    	echo("\t\t<tr>\n");	
	    	echo("\t\t\t<td>".$row["query"]."</td>\n");
	    	echo("\t\t\t<td>".$row["key"]."</td>\n");
	    	echo("\t\t\t<td>".$row["country_code"]."</td>\n");
	    	echo("\t\t\t<td>".$row["cpc"]."</td>\n");
	    	echo("\t\t\t<td>".$row["search_volume"]."</td>\n");
	    	echo("\t\t\t<td>".$row["competition"]."</td>\n");
	    	echo("\t\t</tr>\n");			
		}
		close_connection($db);
	}

	function output_for_chart() {
		$db = get_connection("snowball.sqlite3");
		$results = $db->query('SELECT DISTINCT query, key, country_code, cpc, search_volume, competition FROM results');
		$data = array()
		foreach($results as $row) {
			$data[] = $row;
		}
		close_connection($db);
		echo(json_encode($data));
	}

	function get_sql_statement($k, $c) {
		$data = searchKeywords($_POST["keyword"], $_POST["country"]);
		$json = json_decode($data,true);
		$results = $json["results"];
		$key = array_keys($results);
		$key = $key[0];
		$related = $results[$key]["related"];
		$qu = $results[$key]["meta"]["keyword"];
		$kw = $related[0]["key"];
		$cc = $related[0]["country_code"];
		$sv = $related[0]["search_volume"];
		$cp = $related[0]["cpc"];
		$cm = $related[0]["competition"];
		$sql = "INSERT INTO results VALUES (\"$qu\", \"$kw\", \"$cc\", $sv, $cp, $cm);";
		return $sql;
	}

?>