<?php

/** MySQL */                            
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_TABLE", "vanloc");

/** Mailer */
define("HOST_MAILER", "smtp.gmail.com");
define("AUTH_MAILER", true);
define("USERNAME_MAILER", "kayuu081@gmail.com");
define("PASSWORD_MAILER", "");
define("PORT_MAILER", "587");

/** Main */
define("MAIN", true);
ini_set('display_errors', true);

if (!defined('HOSTPATH')) {
    define('HOSTPATH', dirname(__FILE__) . '/');
}
if (!defined('VANLOCPATH')) {
    define('SYSTEMPATH', HOSTPATH . '/Systems/');
}
if (!defined('TEMPATH')) {
    define('TEMPATH', HOSTPATH . '/Templates/');
}

require_once './Systems/Init.php';
