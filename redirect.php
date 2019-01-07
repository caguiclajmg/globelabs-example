<?php
    // This part should only be done once, you should store the access_token along with
    // its corresponding subscriber_number somewhere safe and then just use that
    // when performing SMS requests, but to keep this example simple we just
    // request it every time.
    $request = curl_init('https://developer.globelabs.com.ph/oauth/access_token?app_id=' . getenv('APP_ID') . '&app_secret=' . getenv('APP_SECRET') . '&code=' . $_GET['code']);
    curl_setopt($request, CURLOPT_POST, 1);
    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
    $response = json_decode(curl_exec($request), true);
    curl_close($request);

    $request = curl_init('https://devapi.globelabs.com.ph/smsmessaging/v1/outbound/' . getenv('SHORT_CODE') . '/requests?access_token=' . $response['access_token']);
    $body = json_encode(array(
        'address' => '0' . $response['subscriber_number'],
        'message' => 'Hello from globelabs-example!',
    ));
    curl_setopt($request, CURLOPT_POST, 1);
    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($request, CURLOPT_POSTFIELDS, $body);
    curl_setopt($request, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($body)
    ));
    $response = json_decode(curl_exec($request), true);
    curl_close($request);
