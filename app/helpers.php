<?php
/**
 * Created by PhpStorm.
 * User: Chinjan Patel
 * Date: 8/11/17
 * Time: 12:40 PM
 */

function pr($array, $name = "Array")
{
    echo "<pre>";
    echo $name . " => ";
    print_r($array);
    echo "</pre>";
}

function div($class, $id = null, $next_element = [])
{
    pr($next_element);
    foreach ($next_element as $key => $value) {
        $string = "";
        $val_id = $value['id'];
        $val_class = $value['class'];
        if ($key == 'button') {
            $btn_value = $value['value'];
            $string = "<button type='button' id='$val_id' class='$val_class'>$btn_value</button>";
        }
    }
    $div = "<div class='$class' id='$id'>";
    $div .= "</div>";
    echo $div;
}

if (!function_exists('getClient')) {
    function getClient()
    {
        define('APPLICATION_NAME', 'Google Sheets API PHP Quickstart');
        define('CREDENTIALS_PATH', '~/.credentials/sheets.googleapis.com-php-quickstart.json');
        define('CLIENT_SECRET_PATH', base_path() . '/client_secret.json');
        // If modifying these scopes, delete your previously saved credentials
        // at ~/.credentials/sheets.googleapis.com-php-quickstart.json
        define('SCOPES', implode(' ', array(
                Google_Service_Sheets::SPREADSHEETS_READONLY)
        ));

        $client = new Google_Client();
        $client->setApplicationName(APPLICATION_NAME);
        $client->setScopes(SCOPES);
        $client->setAuthConfig(CLIENT_SECRET_PATH);
        $client->setAccessType('online');
        $client->setDeveloperKey('AIzaSyBdietu5zYQrqEKEQV6MM8iEG7HEQWwNtg');
        return $client;
    }
}

?>