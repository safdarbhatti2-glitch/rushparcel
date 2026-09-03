<?php

return [
    'name' => $_ENV['APP_NAME'] ?? 'Rush Parcel',
    'env' => $_ENV['APP_ENV'] ?? 'production',
    'debug' => filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN),
    'url' => $_ENV['APP_URL'] ?? 'http://localhost:8000',
    'timezone' => $_ENV['APP_TIMEZONE'] ?? 'Europe/London',
    'key' => $_ENV['APP_KEY'] ?? 'default_secret_key_please_change',
    'vat_rate' => (float)($_ENV['DEFAULT_VAT_RATE'] ?? 20.0),
    'currency' => 'GBP',
    'currency_symbol' => '£',
];
