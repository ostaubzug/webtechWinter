<?php

parse_str($_SERVER['QUERY_STRING'], $params);

//wenn Name gesetzt wurde schicke 
if (isset($params['name']) && $params['name'] != '') {
    // produce result
    $result['message'] = 'Backend funktioniert ' . $params['name'];
} else {
    $result['error'] = 'Parameter <name> is not set or empty';
    http_response_code(400);
}

echo json_encode($result);
?>