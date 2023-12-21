<?php
//acces probleme, deshalb lasse ich alle Verbindungen zu, das Sicherheitsrisiko ist mir bewusst
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

parse_str($_SERVER['QUERY_STRING'], $params);
$postData = file_get_contents('php://input');
$postData = json_decode($postData, true);

//todo Validierung
returnMessage($postData);



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
    $age = getAge($datetime);
    echo $age->y;
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