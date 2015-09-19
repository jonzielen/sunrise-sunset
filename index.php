<?php
    $phoneNumbers[] = [
        'phoneNumber' => '9082087183',
        'provider' => 'verizon'
    ];

    $textProvider['verizon'] = '@vtext.com';

    function buildTextArray($phoneNumbers, $textProvider) {
        $fullTextAddres = [];
        foreach ($phoneNumbers as $person) {
            $fullTextAddres[] = $person['phoneNumber'].$textProvider[$person['provider']];

        }
        return $fullTextAddres;
    }


    echo '<pre>';
    print_r(buildTextArray($phoneNumbers, $textProvider));
    echo '</pre>';
?>
