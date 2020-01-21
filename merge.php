<?php

$url = 'http://api.doxey.io/merge';

$model = array(
    "name" => "John Doe",
    "company" => "ACME",
    "address" => "1234 Market Street, San Francisco, CA 94103, United States",
    "date" => "2019-09-23T18:25:00.000Z",
    "invoiceNumber" => "INV-12345678",
    "signer" => "Cora Nilson",
    "signature" => "https://www.doxey.io/images/signature.png",
    "subtotal" => 1301,
    "vatRate" => 19,
    "vat" => 247.19,
    "total" => 1548.19,
    "items" => array(
        array(
            "name" => "Project Setup",
            "description" => "Create github repo, setup timetracker and Slack channels",
            "amount" => 90
        ),
        array(
            "name" => "Optimize Photos",
            "description" => "Scan, crop and scale images to reduce loading times",
            "amount" => 340.50
        ),
        array(
            "name" => "Website structure",
            "description" => "Copy blank boostrap template. Setup pages and adjust links",
            "amount" => 250.50
        ),
        array(
            "name" => "CSS theme",
            "description" => "Create CSS styles according to CI",
            "amount" => 620
        )
    )
);

$data = array(
    "template" => "https://docs.google.com/document/d/1urL-JV2m85jry1_tatbjSFBjUZgGiMmwwNR9X8UTUTg/edit",
    "locale" => "de_DE",
    "timezone" => "GMT+01:00",
    "currency" => "EUR",
    "format" => "PDF",
    "apiKey" => "",
    "model" => $model
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) {
    echo "Request failed";
    exit;
}

file_put_contents("invoice-sample.pdf", $result);
?>