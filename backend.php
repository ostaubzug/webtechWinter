<?php
//acces probleme, deshalb lasse ich alle Verbindungen zu, das Sicherheitsrisiko ist mir bewusst
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");


processRequest();


function processRequest()
{
    try {
        parse_str($_SERVER['QUERY_STRING'], $params);
        $postData = json_decode(file_get_contents('php://input'), true);
    } catch (e) {
        echo json_encode(['error' => "Fehler beim parsen des JSON"]);
    }


    if (validateInput($postData)) {
        sendpersonalisedOffer($postData);
        echo getJsonResponse($postData);
    }
}


function validateInput($postData)
{
    //überprüfen ob alle Parameter gesetzt sind
    if (!isset($postData['date'])) {
        $error = ['error' => "Parameter 'date' nicht gesetzt"];
    }
    if (!isset($postData['phonemodel'])) {
        $error = ['error' => "Parameter 'phonemodel' nicht gesetzt"];
    }
    if (!isset($postData['name'])) {
        $error = ['error' => "Parameter 'name' nicht gesetzt"];
    }
    if (!isset($postData['email'])) {
        $error = ['error' => "Parameter 'email' nicht gesetzt"];
    }

    //überprüfen ob Parameter korrekt gesetzt sind
    else if (getAgeInDays($postData['date']) <= 0 || !isRealDate($postData['date'])) {
        $error = ['error' => "Parameter 'date' ist nicht korrekt gesetzt"];
    } else if (
        $postData['phonemodel'] != 'iPhone 13' &&
        $postData['phonemodel'] != 'iPhone 12' &&
        $postData['phonemodel'] != 'iPhone 11' &&
        $postData['phonemodel'] != 'Samsung A4' &&
        $postData['phonemodel'] != 'Pixel 8' &&
        $postData['phonemodel'] != 'Pixel 8pro'
    ) {
        $error = ['error' => "Parameter 'phonemodel' ist nicht korrekt gesetzt"];
    } else if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
        $error = ['error' => "Parameter 'email' ist nicht korrekt gesetzt"];
    } else if (!preg_match('/^[a-zA-ZäöüÄÖÜ ]+$/', $postData['name']) || strlen($postData['name']) < 5 || strlen($postData['name']) > 20) {
        $error = ['error' => "Parameter 'name' ist nicht korrekt gesetzt"];
    }

    //abbrechen falls validierung fehlschlägt
    if (isset($error)) {
        echo json_encode($error);
        http_response_code(400);
        exit;
    }
    return true;

}

function sendpersonalisedOffer($postData)
{
    //personalisiertes Angebot an E-Mail Adresse senden
}


function getJsonResponse($postData)
{
    $email = $postData['email'];
    $value = getPhoneModelPriceChf($postData['phonemodel']) * getDeprecationFactor($postData['date']);

    $returnObject = [
        'email' => $email,
        'phoneValue' => $value,
        'numberOfRequests' => getNumberOfRequestsPerMail($email),
        'name' => $postData['name']];

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

function getDeprecationFactor($date)
{
    $age = getAgeInYears($date);
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
    //dots in the cookieName are making problems So I remove them
    $sanitizedEmail = str_replace(".", "", $email);
    $name = 'NumberOfRequestsCookie' . $sanitizedEmail;

    if (isset($_COOKIE[$name])) {
        $increasedValue = $_COOKIE[$name] + 1;
        setcookie($name, $increasedValue);
        return $increasedValue;
    }
    setcookie($name, 1);
    return 1;
}


function getAgeInYears($date)
{
    $birthDate = new DateTime($date);
    $currentDate = new DateTime('now');
    $age = $birthDate->diff($currentDate);
    return $age->y;
}

function getAgeInDays($date)
{
    $birthDate = new DateTime($date);
    $currentDate = new DateTime('now');
    $age = $birthDate->diff($currentDate);
    if ($birthDate > $currentDate) {
        return -$age->days;
    }
    return $age->days;
}


function isRealDate($date)
{
    if (false === strtotime($date)) {
        return false;
    }
    list($year, $month, $day) = explode('-', $date);
    return checkdate($month, $day, $year);
}

?>