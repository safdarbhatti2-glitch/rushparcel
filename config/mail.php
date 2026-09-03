<?php

return [
    'host' => $_ENV['MAIL_HOST'] ?? '127.0.0.1',
    'port' => (int)($_ENV['MAIL_PORT'] ?? 25),
    'username' => $_ENV['MAIL_USERNAME'] ?? '',
    'password' => $_ENV['MAIL_PASSWORD'] ?? '',
    'encryption' => $_ENV['MAIL_ENCRYPTION'] ?? 'tls',
    'from' => [
        'address' => $_ENV['MAIL_FROM_ADDRESS'] ?? 'noreply@rushparcel.co.uk',
        'name' => $_ENV['MAIL_FROM_NAME'] ?? 'Rush Parcel',
    ],
];
