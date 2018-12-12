<?php
	session_set_cookie_params(0, '/', ".vuskeedo.heliohost.org",false, false);
	session_start();
	require_once("RestAPI.php");

	// If check if POST submit is true, insertKeyword() into SQL.
	if(isset($_POST['submit'])) {
		insertKeyword();
	}

	/***
	*
	* Function uses DataForSEO API to retrive JSON data for a related keyword.
	* JSON is parsed and SQL string is created.
	* SQL strings are added into an array
	*
	*/
	function get_sql($k, $c, &$ia, &$ha) {
		$search = searchKeywords($k, $c);
		$json = json_decode($search,true);

		$results = $json["results"];
		$key = array_keys($results);
		$key = $key[0];

		$related = array();
		$related = $results[$key]["related"];

		// If no data is available for search keyword
		if($related == "No data") {
			header("Refresh: 1; url=https://seo.vuskeedo.heliohost.org/index.html?keyword=nodata");
			exit;
		}
		
		$qu = $results[$key]["meta"]["keyword"];
		
		foreach($related as $r) {
			if($debug) {
				echo($r["key"]."<br/>");
			}
			$kw = $r["key"];
			$cc = $r["country_code"];
			$sv = $r["search_volume"];
			$cp = $r["cpc"];
			$cm = $r["competition"];
			$sql = "INSERT INTO results (query, key, country, sv, cpc, cmp) VALUES (\"$qu\", \"$kw\", \"$cc\", $sv, $cp, $cm);";
			//echo($sql."<br>");
			array_push($ia, $sql);
			
			foreach($r["history"] as $h) {
				$yr = $h["year"];
				$mo = $h["month"];
				$hv = $h["search_volume"];
				$his = "INSERT INTO history (query, key, year, month, h_sv) VALUES (\"$qu\", \"$kw\", $yr, $mo, $hv);";
				//echo($his."<br>");
				array_push($ha, $his);
			}
		}
	}

	/***
	*
	* Function uses DataForSEO API to retrive JSON data for a related keyword.
	* JSON is parsed and SQL string is created.
	* SQL strings are added into an array
	*
	*/
	function sql_insert($ia, $ha) {
		$db = new PDO("sqlite:/home1/vuskeedo/public_html/seo/php/dbtest.sqlite3");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		foreach($ia as $i) {
			$db->exec($i);
		}

		foreach($ha as $h) {
			$db->exec($h);
		}

		$db = null;
	}

	/***
	*
	* Function is called when a POST[submit] is made.
	* This calls get_sql and sql_insert to insert data into database.
	*
	*/
	function insertKeyword() {
		$inserts = array();
		$history = array();

		get_sql($_POST["searchKeyword"], $_POST["searchCountry"], $inserts, $history);
		sql_insert($inserts, $history);
		header("Refresh: 1; url=https://seo.vuskeedo.heliohost.org/results.html?keyword=".$_POST["searchKeyword"]."&country=".$_POST["searchCountry"]);
	}

	/***
	*
	* Function creates an array of the data used for
	* the past twelve months.  Used with three keywords.
	* Therefore, the SQL is LIMITed to 36.
	* Data is returned as an array.
	*
	*/
	function past_twelve_graph($keyword) {
		$searchKeyword = $keyword;
		$file_db = new PDO('sqlite:/home1/vuskeedo/public_html/seo/php/dbtest.sqlite3');
		// Set errormode to exceptions
		$file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $file_db->prepare("SELECT DISTINCT h.key, h.year, h.month, h.h_sv, r.cpc, r.cmp FROM history AS h, results AS r WHERE h.query = :searchKeyword ORDER BY r.key LIMIT 36");
		$stmt->bindParam(':searchKeyword', $searchKeyword, PDO::PARAM_STR);
		if($stmt->execute()) {
			$data = array();
			$count = 0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$data[$count]['key'] = $row['key'];
				$data[$count]['year'] = $row['year'];
				$data[$count]['month'] = $row['month'];
				$data[$count]['h_sv'] = $row['h_sv'];
				$data[$count]['cpc'] = $row['cpc'];
				$data[$count]['cmp'] = $row['cmp'];
				$count++;
			}
		}

			/*echo($data[0]['key']);
			echo($data[0]['year']);
			echo($data[0]['month']);
			echo($data[0]['h_sv']);
			echo($data[0]['cpc']);
			echo($data[0]['cmp']);*/
		$file_db = null;
		return $data;
	}

	/***
	*
	* Searches the database for given $keyword.
	* Uses $keyword to pull data for the month:
	* month, search volume, cost-per-click, and competition.
	*
	*/
	function past_twelve($keyword) {
		$searchKeyword = $keyword;
		$file_db = new PDO('sqlite:/Applications/AMPPS/www/php/dbtest.sqlite3');
    	// Set errormode to exceptions
    	$file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $file_db->prepare("SELECT DISTINCT h.month, h.h_sv, r.cpc, r.cmp FROM history AS h, results AS r WHERE h.query = :searchKeyword ORDER BY r.key");
		$stmt->bindParam(':searchKeyword', $searchKeyword, PDO::PARAM_STR);
		if($stmt->execute()) {
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				echo("<tr>");
				echo("<td>".$row["month"]."</td>");
				echo("<td>".$row["h_sv"]."</td>");
				echo("<td>".$row["cpc"]."</td>");
				echo("<td>".$row["cmp"]."</td>");
				echo("</tr>");
			}
		}

		$file_db = null;
	}

	function export_past_twelve($keyword) {
		$searchKeyword = $keyword;
		$file_db = new PDO('sqlite:/home1/vuskeedo/public_html/seo/php/dbtest.sqlite3');
    	// Set errormode to exceptions
	   	$file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $file_db->prepare("SELECT DISTINCT h.key, h.year, h.month, h.h_sv, r.cpc, r.cmp FROM history AS h, results AS r WHERE h.query = :searchKeyword ORDER BY r.key");
		$stmt->bindParam(':searchKeyword', $searchKeyword, PDO::PARAM_STR);
		if($stmt->execute()) {
			$delimiter = ",";
		    $filename = "search_volume_" . date('Y-m-d') . ".csv";
		    
		    //create a file pointer
		    $f = fopen('php://memory', 'w');
		    
		    //set column headers
		    $fields = array('key', 'year', 'month', 'h_sv', 'cpc', 'cmp');
		    fputcsv($f, $fields, $delimiter);

		    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			    $lineData = array($row['key'], $row['year'], $row['month'], $row['h_sv'], $row['cpc'], $row['cmp']);
			    fputcsv($f, $lineData, $delimiter);
			    $count++;
			}
			//move back to beginning of file
		    fseek($f, 0);
		    
		    //set headers to download file rather than displayed
		    header('Content-Type: text/csv');
		    header('Content-Disposition: attachment; filename="' . $filename . '";');
		    
		    //output all remaining data on a file pointer
		    fpassthru($f);
		    fclose($f);
		} else {

		}

	    $file_db = null;
		exit;
	}

	/***
	*
	* Creates a table for the results.html page.
	* Using data from the results table.
	* Data used is keyword, search volume, cost-per-click, and competition.
	*
	*/
	function recent_searches() {
		$file_db = new PDO('sqlite:/home1/vuskeedo/public_html/seo/php/dbtest.sqlite3');
    	// Set errormode to exceptions
    	$file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
    	$results = $file_db->query("SELECT key, sv, cpc, cmp FROM results AS r ORDER BY rowid DESC LIMIT 10");
		if(!$results)
		{
			echo "results empty";
		} else {
			foreach($results as $row) {
				echo("<tr>");
				echo("<td>".$row["key"]."</td>");
				echo("<td>".$row["sv"]."</td>");
				echo("<td>".$row["cpc"]."</td>");
				echo("<td>".$row["cmp"]."</td>");
				echo("</tr>");
			}
		}
		$file_db = null;
	}

	function export_recent_searches() {
		$file_db = new PDO('sqlite:/home1/vuskeedo/public_html/seo/php/dbtest.sqlite3');
    	// Set errormode to exceptions
	   	$file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$results = $file_db->query("SELECT key, sv, cpc, cmp FROM results AS r ORDER BY rowid DESC LIMIT 10");

		if($results) {
			$delimiter = ",";
		    $filename = "recent_searches_" . date('Y-m-d') . ".csv";
		    
		    //create a file pointer
		    $f = fopen('php://memory', 'w');
		    
		    //set column headers
		    $fields = array('key', 'sv', 'cpc', 'cmp');
		    fputcsv($f, $fields, $delimiter);

			while ($row = $results->fetch()) {
			    $lineData = array($row['key'], $row['sv'], $row['cpc'], $row['cmp']);
			    fputcsv($f, $lineData, $delimiter);
			}
			//move back to beginning of file
		    fseek($f, 0);
		    
		    //set headers to download file rather than displayed
		    header('Content-Type: text/csv');
		    header('Content-Disposition: attachment; filename="' . $filename . '";');
		    
		    //output all remaining data on a file pointer
		    fpassthru($f);
		}
		$file_db = null;
		exit;
	}
?>