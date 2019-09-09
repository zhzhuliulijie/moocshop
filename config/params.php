<?php

$alipay = require __DIR__ . '/alipay.php';

return [
    'adminEmail' => 'admin@example.com',
    'pageSize' => [
        'manage' => 10,
        'user' => 10,
        'product' => 10,
        'frontproduct' => 9,
        'order' => 10,
    ],
    'express' => [
        1 => '中通快递',
        2 => '顺丰快递',
    ],
    'expressPrice' => [
        1 => 15,
        2 => 20,
    ],
    'defaultValue' => [
        'avatar' => '/assets/admin/img/contact-img.png',
    ],
    'alipay' => $alipay,
];
