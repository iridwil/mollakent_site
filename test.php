<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$key = <<<EOD
-----BEGIN PRIVATE KEY-----
MIGHAgEAMBMGByqGSM49AgEGCCqGSM49AwEHBG0wawIBAQQgdi9gWh1yhM94uw7+
9joVxqAPWueatzqYA9ifgjwazSihRANCAAQY5l902pNGmzIh1SUy0NmxI7bUOnPL
TqnhwrvX6Oq9WB5xCJ3K29Q5qCu7AJKM7mQaY3/HCcUPbb3d96/hOAip
-----END PRIVATE KEY-----
EOD;

function encode($data) {
    $encoded = strtr(base64_encode($data), '+/', '-_');
    return rtrim($encoded, '=');
}

function generateJWT($kid, $iss, $sub, $key) {
    $header = [
        'alg' => 'ES256',
        'kid' => $kid
    ];
    $body = [
        'iss' => $iss,
        'iat' => time(),
        'exp' => time() + 3600,
        'aud' => 'https://appleid.apple.com',
        'sub' => $sub
    ];

    $privKey = openssl_pkey_get_private($key);
    if (!$privKey) return false;

    $payload = encode(json_encode($header)).'.'.encode(json_encode($body));
    $signature = '';
    $success = openssl_sign($payloads, $signature, $privKey, OPENSSL_ALGO_SHA256);
    if (!$success) return false;

    return $payload.'.'.encode($signature);
}

$kid = '58H4CVXNG7'; // identifier for private key
$iss = 'WGL33ABCD6'; // team identifier
$sub = 'ru.mollakent.serviceid'; // my app id

$jwt = generateJWT($kid, $iss, $sub, $key);

$data = [
    'client_id' => 'ru.mollakent.serviceid',
    'client_secret' => $jwt,
    //'code' => $_POST['code'],
    'grant_type' => 'authorization_code',
    'request_uri' => 'https://mollakent.ru/'
];
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://appleid.apple.com/auth/token');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/536.6 (KHTML, like Gecko) Chrome/20.0.1090.0 Safari/536.6');

$serverOutput = curl_exec($ch);

curl_close ($ch);
echo $serverOutput;

die;
$post = [
    //'state' => 'test', //идентификатор сессии доделать!
    'response_type' => 'code',
    'client_id'   => 'ru.mollakent.serviceid',
    'scope' => '',
    'response_mode' => 'form_post',
    'redirect_uri' => 'https://mollakent.ru/'
];
$url = 'https://appleid.apple.com/auth/authorize?'.http_build_query($post);
$ch = curl_init($url);
$response = curl_exec($ch);
//var_dump($response);
//$rezArr = json_decode($response, true);
if(curl_error($ch)) {
    var_dump(curl_error($ch));
}
//var_dump($rezArr);
?>
<?php
curl_close($ch);
?>
