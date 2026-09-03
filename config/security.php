<?php

return [
    'csrf' => [
        'token_name' => '_csrf_token',
        'header_name' => 'X-CSRF-TOKEN',
        'lifetime' => 7200, // 2 hours
    ],
    'session' => [
        'name' => 'UKDELIV_SESSID',
        'lifetime' => 86400, // 24 hours
        'path' => '/',
        'domain' => '',
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax',
    ],
    'rate_limiting' => [
        'login' => ['max_attempts' => 5, 'decay_seconds' => 300],
        'tracking' => ['max_attempts' => 30, 'decay_seconds' => 60],
        'quote' => ['max_attempts' => 20, 'decay_seconds' => 60],
        'contact' => ['max_attempts' => 5, 'decay_seconds' => 300],
    ],
    'allowed_upload_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'],
    'allowed_upload_mimes' => [
        'image/jpeg',
        'image/png',
        'image/gif',
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ],
    'max_upload_size' => 10 * 1024 * 1024, // 10MB
];
