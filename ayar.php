<?php

$configPath = '/home3/tekliftopla/private/tekliftopla-secrets/config.php';

if (file_exists($configPath)) {
    $cfg = require $configPath;
} else {
    die('Missing private config file.');
}

$host = $cfg['DB_HOST'] ?? 'localhost';
$db   = $cfg['DB_NAME'] ?? 'teklifto_teklif_topla';
$user = $cfg['DB_USER'] ?? 'teklifto_teklift';
$password = $cfg['DB_PASSWORD'] ?? '';

$infopass = $cfg['INFO_PASS'] ?? '';
$asg_google_secret = $cfg['ASG_GOOGLE_SECRET'] ?? '';
$asg_google_developer_key = $cfg['ASG_GOOGLE_DEVELOPER_KEY'] ?? '';
