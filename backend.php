<?php
//acces probleme, deshalb lasse ich alle Verbindungen zu, das Sicherheitsrisiko ist mir bewusst
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");


//todo Validierung

processRequest();


function processRequest()
{
    parse_str($_SERVER['QUERY_STRING'], $params);
    $postData = json_decode(file_get_contents('php://input'), true);

    sendpersonalisedOffer($postData);

    echo getResponseJson($postData);
}

function sendpersonalisedOffer($postData)
{
    //personalisiertes Angebot an Mail Adresse senden.
}


function getResponseJson($postData)
{
    $email = $postData['email'];
    $value = getPhoneModelPriceChf($postData['phonemodel']) * getDeprecationFactor($postData['datetime']);

    $returnObject = [
        'email' => $email,
        'phoneValue' => $value,
        'numberOfRequests' => getNumberOfRequestsPerMail($email)];

    return json_encode($returnObject, JSON_UNESCAPED_UNICODE);
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


function getNumberOfRequestsPerMail($email)
{
    if (isset($_COOKIE['NumberOfRequestsCookie' . $email])) {
        setcookie('NumberOfRequestsCookie' . $email, $_COOKIE['NumberOfRequestsCookie' . $email] + 1);
        return $_COOKIE['NumberOfRequestsCookie' . $email];
    }
    setcookie('NumberOfRequestsCookie' . $email, 1);
    return 1;
}


function getAgeInYears($datetime)
{
    $birthDate = new DateTime($datetime);
    $currentDate = new DateTime('now');
    $age = $birthDate->diff($currentDate);
    return $age->y;
}


?>