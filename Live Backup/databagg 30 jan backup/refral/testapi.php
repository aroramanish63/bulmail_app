<?php
$client = new SoapClient(
"https://secure.avangate.com/api/merchant/?wsdl"
);
$merchantCode = "CC1234"; //dummy code
$key = "SECRET_KEY"; //dummy key
$now = date('Y-m-d H:i:s');
$string = strlen($merchantCode) . $merchantCode . strlen($now) . $now;
$hash = hmac($key, $string);
try {
$sessionID = $client->login($merchantCode, $now, $Hash);
} catch (SoapFault $e) {
echo "Authentication error " . $e->getMessage();
}

echo echo$sessionID;
?>