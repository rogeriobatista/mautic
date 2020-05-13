<?php

parse_str(file_get_contents('php://input'), $data);

$form_id = $data->form->id;

$form_data = [];

$form_data['mauticform[return]'] = '';

$fields = $data["fields"];

$ip = "";

foreach ($fields as $key => $value) {
    $value = (object)$value;
    
    if ($value->id == "client_ip") {
        $ips = explode(',', $value->value);
        $ip = trim($ips[0]);
    } else {
        if ($value->id != 'formId')
            $form_data["mauticform[f_$value->id]"] = $value->value;
        else
            $form_data["mauticform[$value->id]"] = $value->value;
    }
}

$content = http_build_query($form_data);

$context = stream_context_create(array(
    'http' => array(
        'header' => "Content-Type: application/x-www-form-urlencoded\r\nX-Forwarded-For: $ip\r\n",
        'method' => 'POST',
        'content' => $content
    ))
);

$server = $_SERVER['SERVER_NAME'];

if (file_get_contents('https://'.$server.'/form/submit?formId=' . $formId, null, $context)) {
} else {
    file_get_contents('http://'.$server.'/form/submit?formId=' . $formId, null, $context);
}
