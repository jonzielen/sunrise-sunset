<?php
    include_once 'dependencies/phoneNumbers.php';

    $textProvider['verizon'] = '@vtext.com';
    $textMessage = [
        'day' => 'The morning sun has vanquished the horrible night',
        'night' => 'What a horrible night to have a curse'
    ];

    function buildTextArray($phoneNumbers, $textProvider) {
        $fullAddress = [];
        foreach ($phoneNumbers as $person) {
            $fullAddress[] = $person['phoneNumber'].$textProvider[$person['provider']];

        }
        return $fullAddress;
    }

    $fullAddress = buildTextArray($phoneNumbers, $textProvider);

    echo '<pre>';
    print_r($fullAddress);
    print_r($textMessage);
    echo '</pre>';

    echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
    echo date('g:i:s:a');

    function sendText($fullTextAddres) {
        foreach ($fullTextAddres as $text) {
          mail($address, $email['subject'], $email['template'], $email['headers']);
        }
    }



?>
