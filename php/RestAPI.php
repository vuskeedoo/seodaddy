<?php 

require('RestClient.php');
//You can download this file from here https://api.dataforseo.com/_examples/php/_php_RestClient.zip

function searchKeywords($keyword, $country) {
	try {
	    //Instead of 'login' and 'password' use your credentials from https://my.dataforseo.com/login
	    $client = new RestClient('https://api.dataforseo.com/', null, 'vu.kevin@csu.fullerton.edu', 'LD87rm8Od9dfWnVn');

	    $post_array = array();
	    $my_unq_id = mt_rand(0,30000000); //your unique ID. we will return it with all results. you can set your database ID, string, etc.

	    $post_array[$my_unq_id] = array(
	        "keyword" => $keyword,
	        "country_code" => $country,
	        "language" => "en",
	        "depth" => 1,
	        "limit" => 3,
	        "offset" => 0,
	        "orderby" => "cpc,desc",
	        "filters" => array(
	            array("cpc", ">", 0),
	            "or",
	            array(
	                array("search_volume", ">", 0),
	                "and",
	                array("search_volume", "<=", 1000)
	            )
	        )
	    );

	    $get_result = $client->post("v2/kwrd_finder_related_keywords_get", array('data' => $post_array));
	    //print_r($get_result);

	    //echo gettype($get_result), "\n";
	    return json_encode($get_result);

	    //do something with result

	} catch (RestClientException $e) {
	    echo "\n";
	    print "HTTP code: {$e->getHttpCode()}\n";
	    print "Error code: {$e->getCode()}\n";
	    print "Message: {$e->getMessage()}\n";
	    print  $e->getTraceAsString();
	    echo "\n";
	    exit();
	}

	$client = null;
}

function searchKeyword2($keyword, $country) {
	$username = "vu.kevin@csu.fullerton.edu";
	$password = "LD87rm8Od9dfWnVn";

	$request_url = "https://api.dataforseo.com/v2/kwrd_finder_related_keywords_get";

	$request_date = array(
	        "keyword" => $keyword,
	        "country_code" => $country,
	        "language" => "en",
	        "depth" => 1,
	        "limit" => 1,
	        "offset" => 0,
	        "orderby" => "cpc,desc",
	        "filters" => array(
	            array("cpc", ">", 0),
	            "or",
	            array(
	                array("search_volume", ">", 0),
	                "and",
	                array("search_volume", "<=", 1000)
	            )
	        )
	    );

	// Creating a request
	$request_rest = new RestRequest();
	$request_rest->setRequestURL($request_url);
	$request_rest->setAPIKey($apikey);
	$request_rest->setRequestBody(json_encode($request_data));
	$request_rest->setMethod("POST");
	$result = $request_rest->execute();
	$response_status = $result[0];
	$json_response_data = $result[1];
}

function sendEmail($emailAddress, $messageSubject, $messageBody) {
	
	// Account information
	$apikey = "7f5a72d074cff3222bfa0b079af236fc";
	$username = "vuskeedoo";

	$request_url = "http://api.trumpia.com/rest/v1/" . $username . "/email";
	
	// Request variables
	$request_data = array(
		"from" => "apisupport@mytrum.com",
		"to" => $emailAddress,
		"subject" => $messageSubject
		);

	// Creating a request
	$request_rest = new RestRequest();
	$request_rest->setRequestURL($request_url);
	$request_rest->setAPIKey($apikey);
	$request_rest->setRequestBody(json_encode($request_data));
	$request_rest->setMethod("PUT");
	$result = $request_rest->execute();
	$response_status = $result[0];
	$json_response_data = $result[1];
	
	// Decode the JSON response into a string
	$json_data = json_decode($json_response_data, true);
	// Store the request_id value. The request_id is used to check the status of the API request with GET Report.
	$request_id = $json_data['request_id'];
	
	// Send the request_id to the GET Report function.
	getReport($request_id);
	
	return;
}

?>