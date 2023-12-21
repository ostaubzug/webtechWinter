<?php
header("Access-Control-Allow-Origin: *"); // Allows all origins
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

parse_str($_SERVER['QUERY_STRING'], $params);

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = file_get_contents('php://input');
    $postData = json_decode($postData, true);
    //todo Validierung
    returnMessage($postData);


} else {
    $result['error'] = 'Invalid request method';
    http_response_code(405);
}

function returnMessage($postData)
{
    $phonemodel = $postData['phonemodel'];
    $datetime = $postData['datetime'];
    $email = $postData['email'];

    $price = calculatePrice($phonemodel, $datetime);
    $message = "Gratulation! Ihr Handy ist noch $price CHF wert. \n Wir werden Sie unter $email kontaktieren, um Ihnen ein persönliches Angebot zu unterbreiten.";

    echo json_encode($message);
}

function calculatePrice($phonemodel, $datetime)
{
    return getPhoneModelValueChf($phonemodel) * getDeprecationFactor($datetime);
}

function getPhoneModelValueChf($phonemodel)
{
    $value = [
        1 => 500,
        2 => 400,
        3 => 300,
        4 => 200,
        5 => 600,
    ];
}

function getDeprecationFactor($datetime)
{
    $age = getAge($datetime);
    if ($age >= 0 && $age <= 3) {
        return 0.9;
    } elseif ($age > 3 && $age <= 5) {
        return 0.8;
    } else {
        return 0.3;
    }

}

function getAge($datetime)
{
    $birthDate = new DateTime($datetime);
    $currentDate = new DateTime('now');
    return $birthDate->diff($currentDate);
}

function validateInput()
{
    // TODO: Implement the function logic here
}


?>