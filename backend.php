<?php
header("Access-Control-Allow-Origin: *"); // Allows all origins
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

parse_str($_SERVER['QUERY_STRING'], $params);

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo json_encode("post erkannt");
    // Get the POST data
    $postData = file_get_contents('php://input');
    $postData = json_decode($postData, true);

    // Check if the 'name' parameter is set in the POST data
    if (isset($postData['phonemodel']) && $postData['phonemodel'] != '') {
        // Produce result
        $result['message'] = 'Backend funktioniert mit post' . $postData['phonemodel'];
    } else {
        $result['error'] = 'Parameter <name> is not set or empty';
        http_response_code(400);
    }
} else {
    $result['error'] = 'Invalid request method';
    http_response_code(405);
}

echo json_encode($result);

function calculatePrice($postData)
{
    $phonemodel = $postData['phonemodel'];
    $datetime = $postData['datetime'];
    $email = $postData['email'];


    // TODO: Implement the function logic here
}

function getPhoneValueChf($phonemodel)
{
    $value = [
        1 => 500,
        2 => 400,
        3 => 300,
        4 => 200,
        5 => 600,
        //todo Validierung
    ];

    // Check if the key exists in the lookup array
    if (array_key_exists($value, $phonemodel)) {
        return $value[$phonemodel];
    } else {
        return 'Key not found'; // Or handle the error as appropriate
    }
}

function validateInput()
{
} {
    $name = $postData['name'];
    $datetime = $postData['datetime'];
    $email = $postData['email'];





    // TODO: Implement the function logic here
}


?>