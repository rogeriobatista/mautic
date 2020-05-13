<?php

$redirect_url = '';
$groups = json_decode(file_get_contents('./groups.json'));

foreach($groups as $group) {
    if (($group->seats > $group->occuped_seats && $group->status) || $group->seats == 0) {
        $group->occuped_seats += 1;
        file_put_contents('./groups.json', json_encode($groups));
        header('Location: ' . $group->url);
        break;
    }
}
