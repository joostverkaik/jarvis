<?php
error_reporting(E_ALL);
require "vendor/autoload.php";

function format_error($errno, $errstr, $errfile, $errline)
{
    
    $trace = print_r(debug_backtrace(false), true);
    
    $content = "
    <table>
        <thead><th>Item</th><th>Description</th></thead>
        <tbody>
            <tr>
                <th>Error</th>
                <td><pre>$errstr</pre></td>
            </tr>
            <tr>
                <th>Errno</th>
                <td><pre>$errno</pre></td>
            </tr>
            <tr>
                <th>File</th>
                <td>$errfile</td>
            </tr>
            <tr>
                <th>Line</th>
                <td>$errline</td>
            </tr>
            <tr>
                <th>Trace</th>
                <td><pre>$trace</pre></td>
            </tr>
        </tbody>
    </table>";
    
    return $content;
}

register_shutdown_function("fatal_handler");

function fatal_handler()
{
    
    $errfile = "unknown file";
    $errstr  = "shutdown";
    $errno   = E_CORE_ERROR;
    $errline = 0;
    
    $error = error_get_last();
    
    if ($error !== null) {
        $errno   = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr  = $error["message"];
        
        file_put_contents('response.html', format_error($errno, $errstr, $errfile, $errline));
    }
}


try {
    $db = new PDO('sqlite:jarvis.db');
    
} catch (PDOException $e) {
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
        $decoded  = json_decode($response, true);
        file_put_contents('response.html', "<pre>" . print_r($response, 1) . "</pre>");
        
        // Prepare INSERT statement to SQLite3 file db
        $insert    = "INSERT INTO requests (intent, body) VALUES (:intent, :body)";
        $statement = $db->prepare($insert);
        
        // Bind parameters to statement variables
        $statement->bindValue(':intent', $decoded['result']['resolvedQuery']);
        $statement->bindValue(':body', print_r($decoded, 1));
        
        $statement->execute();
        
        $pb = new Pushbullet\Pushbullet('o.tSzshxX6RkL0wwac4F80PJ8hZAnXxfAQ');
        
        switch ($decoded['result']['resolvedQuery']) {
            
            case "go to weather":
                $response_array = [
                    'speech'      => "showing you the weather forecast",
                    "displayText" => "Opening weather",
                    'data'        => [],
                    'contextOut'  => [],
                    'source'      => "webhook"
                ];
                
                break;
            
            case "go collective":
                $response_array = [
                    'speech'      => "going to collective mode",
                    "displayText" => "Opening collective mode",
                    'data'        => [],
                    'contextOut'  => [],
                    'source'      => "webhook"
                ];
                
                break;
            
            case "go private":

                // So the array below should eventually result in a positive response, which does not happen yet
                $response_array = [
                    'speech'      => "Something went wrong",
                    "displayText" => "There is no response",
                    'data'        => [],
                    'contextOut'  => [],
                    'source'      => "webhook"
                ];
        
                \Ratchet\Client\connect('ws://b7a2c073.ngrok.io/')->then(function (\Ratchet\Client\WebSocket $conn) use
                (
                    $pb,
                    &$response_array
                ) {
            
                    /*$conn->on('message', function($msg) use ($conn) {
                        echo "Received: {$msg}\n";
                        $conn->close();
                    });*/
            
                    $conn->send('go private');
                    $conn->close();
            
                    try {
                        $pb->device("iPhone van Joost")->pushNote("Opening private mode", "From Jarvis");
                        $response_array = [
                            'speech'      => "going to private mode",
                            "displayText" => "Opening private mode (push + websocket)",
                            'data'        => [],
                            'contextOut'  => [],
                            'source'      => "webhook"
                        ];
                    } catch (Exception $ex) {
                        $response_array = [
                            'speech'      => "Something went wrong",
                            "displayText" => $ex->getMessage(),
                            'data'        => [],
                            'contextOut'  => [],
                            'source'      => "webhook"
                        ];
                    }
            
                }, function ($e) use (&$response_array) {
            
                    $response_array = [
                        'speech'      => "Something went wrong",
                        "displayText" => $e,
                        'data'        => [],
                        'contextOut'  => [],
                        'source'      => "webhook"
                    ];
                });
                
                break;
            
            case "I'm done":
                $response_array = [
                    'speech'      => "goodbye",
                    "displayText" => "Logging out",
                    'data'        => [],
                    'contextOut'  => [],
                    'source'      => "webhook"
                ];
                
                break;
            
            default:
                $response_array = [
                    'speech'      => "I'm not sure what you are asking",
                    'displayText' => "Unknown query",
                    'data'        => [],
                    'contextOut'  => [],
                    'source'      => "webhook"
                ];
                
                break;
        }
        
        file_put_contents('response.html', "<pre>" . print_r($response_array, 1) . "</pre>", FILE_APPEND);
        echo json_encode($response_array);
    
}
