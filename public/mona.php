<?php
    $referenceId = "MG" . time();
    $merchantId = "1551";
    $productKey = "db8b594e2682dfb8c2b4b06249ec016305499391";
    $deviceUuid = "456789876543456796gvbndcvbnmnbv";
    $amount = 20000;
    $description = "Buy MaliyoToken5000 for 200 NGN";
    $redirectUrl = "http://example.com/return.aspx?q=blah";

    $data = array(
        "reference_id" => $referenceId,
        "merchant_id" => $merchantId,
        "product_key" => $productKey,
        "uuid" => $deviceUuid,
        "amount" => $amount,
        "description" => $description,
        "redirect_url" => $redirectUrl
    );

    $paymentUrl = "https://www.monapay.com/v1/merchant/pay?" . http_build_query($data);

    header("Location: $paymentUrl");