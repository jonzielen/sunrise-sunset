<?php
    // load dependencies
    include_once 'dependencies/phoneNumbers.php';
    include_once 'dependencies/phoneProviders.php';

    $textMessages = [
        'am' => 'The morning sun has vanquished the horrible night',
        'pm' => 'What a horrible night to have a curse'
    ];

    $sunriseSunsetTimesFile = 'assets/suntimes.txt';
    $apiUrl = 'https://api.forecast.io/forecast/f3b43b35596ee505aa491e1c52130e5a/40.7127,-74.0059';

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

    function sendText($fullAddress, $message) {
        foreach ($fullAddress as $text) {
          mail('jonzielen@gmail.com', 'subject', $message);
        }
    }

    function curlLiveData($apiUrl) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        $result = curl_exec($ch);
        curl_close($ch);

        $jsonObject = json_decode($result);
        return $jsonObject->daily->data;
    }

    $jsonAllData = curlLiveData($apiUrl);

    function loopTimes($jsonAllData) {
        $jsonData = [];
        foreach ($jsonAllData as $date) {
            $jsonData[] = $date->sunriseTime;
            $jsonData[] = $date->sunsetTime;
        }
        return json_encode($jsonData);
    }

    $jsonData = loopTimes($jsonAllData);

    function addDateToFile($jsonData, $sunriseSunsetTimesFile) {
        $fileDates = fopen($sunriseSunsetTimesFile, 'a+');
        fwrite($fileDates, $jsonData."\n");
        fclose($fileDates);
    }

    addDateToFile($jsonData, $sunriseSunsetTimesFile);

    echo '<pre>';
    var_dump(loopTimes($jsonAllData));
    echo '</pre>';


?>
