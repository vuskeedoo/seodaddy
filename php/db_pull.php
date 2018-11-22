<!DOCTYPE html>
<head>
	<style>
		table#t01 tr:nth-child(even) {
		    background-color: #eee;
		}
		table#t01 tr:nth-child(odd) {
		    background-color: #fff;
		}
		table#t01 th {
		    color: white;
		    background-color: black;
		}
</style>
</head>
<body>
	<table id="t01">
		<tr>
			<th>Query</th>
			<th>Keyword</th>
			<th>Country Code</th>
			<th>Cost-per-click</th>
			<th>Search Volume</th>
			<th>Competition</th>
		</tr>
		<?php
			//var_dump($_POST);
			$db = new SQLite3("snowball.sqlite3");
			$results = $db->query('SELECT DISTINCT query, key, country_code, cpc, search_volume, competition FROM results');
			while ($row = $results->fetchArray()) {
				//if($row["query"]==$_POST["keyword"]) {
			    	echo("\t\t<tr>\n");	
			    	echo("\t\t\t<td>".$row["query"]."</td>\n");
			    	echo("\t\t\t<td>".$row["key"]."</td>\n");
			    	echo("\t\t\t<td>".$row["country_code"]."</td>\n");
			    	echo("\t\t\t<td>".$row["cpc"]."</td>\n");
			    	echo("\t\t\t<td>".$row["search_volume"]."</td>\n");
			    	echo("\t\t\t<td>".$row["competition"]."</td>\n");
			    	echo("\t\t</tr>\n");
			    //}
			}
			$db->close();
		?>
	</table>
</body>
</html>
