<?php
    include_once 'dependencies/phoneNumbers.php';

    $textProvider['verizon'] = '@vtext.com';
    $textMessages = [
        'am' => 'The morning sun has vanquished the horrible night',
        'pm' => 'What a horrible night to have a curse'
    ];

    function buildTextArray($phoneNumbers, $textProvider) {
        $fullAddress = [];
        foreach ($phoneNumbers as $person) {
            $fullAddress[] = $person['phoneNumber'].$textProvider[$person['provider']];

        }
        return $fullAddress;
    }

    $fullAddress = buildTextArray($phoneNumbers, $textProvider);

    function setMessage($textMessages) {
        return $textMessages[date('a')];

    }

    $message = setMessage($textMessages);


    echo '<pre>';
    print_r($fullAddress);
    print_r($message);
    echo '</pre>';

    echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
    echo date('g:i:s:a');

    function sendText($fullAddress, $message) {
        foreach ($fullAddress as $text) {
          mail('jonzielen@gmail.com', 'subject', $message);
        }
    }

    //sendText($fullAddress, $message);
mail('jonzielen@gmail.com', 'subject', $message);


?>
