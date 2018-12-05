<?php

/* If the status is not 200 OK, stop the script */

function checkStatusRequest($status)
{
    if (strcmp($status, "HTTP/1.1 200 OK") != 0) {
        include('login_error.php');
        exit(84);
    }
}

/* Get the file that the server give after a good authentication (with the credential) */

function getAuthenticateFile()
{
    $username = 'adminC5';//$_POST['username'];
    $password = 'admin@5C5';//$_POST['password'];
    $server = 'https://o2g-instance1.ale-aapp.com/api/rest/authenticate?version=1.0';

    $opts = array(
        'http' => array(
            'method' => "GET",
            'header' => "Authorization: Basic " . base64_encode("$username:$password")
        )
    );
    $context = stream_context_create($opts);
    $header = get_headers($server, 0, $context);
    //print_r($header[0][9]);
    print_r($header);
    checkStatusRequest($header[0]);
    $file_credential = file_get_contents($server, false, $context);
    return ($file_credential);
}

/* Parsing of the authentication file to get only the credential value */

function getCredential()
{

    $file = getAuthenticateFile();
    $credential;

    $jsonIterator = new RecursiveIteratorIterator(
        new RecursiveArrayIterator(json_decode($file, TRUE)),
        RecursiveIteratorIterator::SELF_FIRST);

    foreach ($jsonIterator as $key => $val) {
        if ($key === "credential")
            $credential = $val;
    }
    if ($credential == "");
        //printf("Cookie vide --> il y a un soucis quelque part\n");
    return ($credential);
}

$credential = getCredential();

/* imperatif : set cookie avant le moindre code HTML */
setcookie('AlcUserId', $credential, time() + 365 * 24 * 3600, null, null, false, true);
/*****************************************************/
print($credential);

function postSession($credential)
{
    $server = 'https://o2g-instance1.ale-aapp.com/api/rest/1.0/sessions';
    $applicationName = array('applicationName' => 'PBXsManagementTests');
    $username = "adminC5";
    $password = "admin@5C5";
    json_encode($applicationName);

    $opts = array(
        'http' => array(
            'method' => "POST",
            'header' => "Content-type: application/json\r\n " .
                        "Cookie: AlcUserId=" . $credential . "\r\n" .
                        "Authorization: Basic " . base64_encode($username .':'. $password),
            'content' => http_build_query($applicationName)
        )
    );
    $context = stream_context_create($opts);
    $header = get_headers($server, 0, $context);
    //print_r($header);
    $file = file_get_contents($server, false, $context);
    print($file);

    return;
}

postSession($credential);

?>