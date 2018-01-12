<?php
error_reporting(E_ALL);

try {
	$db = new PDO('sqlite:jarvis.db');

} catch(PDOException $e) {
    die($e->getMessage());
}

$action = filter_input(INPUT_GET, 'a', FILTER_SANITIZE_STRING);

switch ($action) {
	case "createdb":
		$db->exec(
			"CREATE TABLE IF NOT EXISTS requests (
			    id INTEGER PRIMARY KEY, 
			    intent TEXT, 
			    body TEXT)"
			);
		break;

	case "query":

		$response = file_get_contents('php://input');
		$decoded = json_decode($response, true);
		file_put_contents('response.html', "<pre>" . print_r($response, 1) . "</pre>");

		// Prepare INSERT statement to SQLite3 file db
		$insert = "INSERT INTO requests (intent, body) VALUES (:intent, :body)";
		$statement = $db->prepare($insert);

		// Bind parameters to statement variables
		$statement->bindParam(':intent', $decoded['result']['resolvedQuery']);
		$statement->bindParam(':body', print_r($decoded, 1));

		$statement->execute();

		$response_array = ['speech' => "hey guys, how is it going?", "displayText" => "Nice message", 'data' => [], 'contextOut' => [], 'source' => "webhook"];
		
		echo json_encode($response_array);

}
