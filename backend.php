<?php
//acces probleme, deshalb lasse ich alle Verbindungen zu, das Sicherheitsrisiko ist mir bewusst
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

parse_str($_SERVER['QUERY_STRING'], $params);
$postData = file_get_contents('php://input');
$postData = json_decode($postData, true);

//todo Validierung

//todo refactoring vom Code


sendMessageToFrontend($postData);


function sendMessageToFrontend($postData)
{
    $message = getMessage($postData);
    echo json_encode($message, JSON_UNESCAPED_UNICODE);
}

function getMessage($postData)
{
    $email = $postData['email'];
    $value = getPhoneModelPriceChf($postData['phonemodel']) * getDeprecationFactor($postData['datetime']);
    $numberOfRequests = getNumberOfRequests();
    $message = 'Gratulation! Ihr Handy ist noch ' . $value . ' CHF wert.<br>Wir werden Sie unter ' . $email . ' kontaktieren, um Ihnen ein persönliches Angebot zu unterbreiten.<br> Sie haben heute ' . $numberOfRequests . ' Anfragen gestellt.';
    return $message;
}

function getPhoneModelPriceChf($phonemodel)
{
    $value = [
        'iPhone 13' => 500,
        'iPhone 12' => 400,
        'iPhone 11' => 300,
        'Samsung A4' => 200,
        'Pixel 8' => 320,
        'Pixel 8pro' => 600,
    ];
    return $value[$phonemodel];
}

function getDeprecationFactor($datetime)
{
    $age = getAgeInYears($datetime);
    if ($age >= 0 && $age <= 3) {
        return 0.9;
    } elseif ($age > 3 && $age <= 5) {
        return 0.8;
    } else {
        return 0.3;
    }
}


function getNumberOfRequests()
{
    if (isset($_COOKIE['phoneCalculatorCookie'])) {
        setcookie('phoneCalculatorCookie', $_COOKIE['phoneCalculatorCookie'] + 1);
        return $_COOKIE['phoneCalculatorCookie'];
    }
    setcookie('phoneCalculatorCookie', 1);
    return 1;
}


function getAgeInYears($datetime)
{
    $birthDate = new DateTime($datetime);
    $currentDate = new DateTime('now');
    $age = $birthDate->diff($currentDate);
    return $age->y;
}

function validateInput()
{
    // TODO: Implement the function logic here
}


?>