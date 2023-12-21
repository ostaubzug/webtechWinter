<?php

parse_str($_SERVER['QUERY_STRING'], $params);



if (isset($params['name']) && $params['name'] != '') {
    // produce result
    $result['message'] = 'Hello ' . $params['name'];
} else {
    $result['error'] = 'Parameter <name> is not set or empty';
    http_response_code(400);
}

echo json_encode($result);

function myFunc($param1, $param2, $param3)
{
    return $param1;
}

?>