<?php
/**
 * Email Builder
 * Config
 *
 * Product Homepage: http://getemailbuilder.com
 * Author: DigitalWheat
 * Author URI: http://digitalwheat.com
 *
 */


$protocol = 'http';

$host= $protocol . '://' . $_SERVER['SERVER_NAME'];

$CONFIG['uploads_folder'] = 'server/uploads';

$CONFIG['host'] = $host;
$CONFIG['smtp']['host'] = '';
$CONFIG['smtp']['username'] = '';
$CONFIG['smtp']['password'] = '';
$CONFIG['smtp']['secure'] = 'tls';
$CONFIG['smtp']['port'] = 587;
$CONFIG['smtp']['auth'] = true;

$CONFIG['mail']['subject'] = '';
$CONFIG['mail']['from_email'] = '';
$CONFIG['mail']['from_name'] = '';
$CONFIG['mail']['alt_body'] = 'The plain text for non-HTML mail clients';