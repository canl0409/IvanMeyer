<?php

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        $PayPalClientId,     // ClientID
        $PayPalClientSecret      // ClientSecret
    )
);

$apiContext->setConfig([
    'mode' => $PayPalMode,
    'http.CURLOPT_SSLVERSION' => CURL_SSLVERSION_TLSv1
]);