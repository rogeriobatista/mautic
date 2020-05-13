<?php
$server = $_SERVER['SERVER_NAME'];
$data = json_decode(file_get_contents('php://input'));

if (isset($data->Type) && $data->Type == 'SubscriptionConfirmation') {

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $data->SubscribeURL);
    curl_setopt( $ch, CURLOPT_HEADER, 0 );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); 
    curl_setopt( $ch, CURLOPT_GET, 1 );

    curl_exec($ch);
    curl_close($ch);

} else {
    $message = json_decode($data->Message);

    $recipients = [];

    if ($message->notificationType == 'Bounce')
        $recipients = $message->bounce->bouncedRecipients;
    else if ($message->notificationType == 'Complaint')
        $recipients = $message->complaint->complainedRecipients;

    foreach($recipients as $recipient) {

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, 'https://'. $server . '/bounce_notificator/add-dnc.php?email=' . $recipient->emailAddress);
        curl_setopt( $ch, CURLOPT_HEADER, 0 );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_GET, 1 );

        curl_exec($ch);
        curl_close($ch);
    }
}

echo 'Processamento concluído';
