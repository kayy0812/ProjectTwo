<?php
ob_start("minify");
require_once './Systems/AutoLoad.php';

use Systems\Database;
use Systems\System;
use Systems\Data;
use Systems\Sender\DataCallback;
use Systems\ParseData;
use Systems\Plugins\AltoRouter;
use Systems\Assets;
use Systems\Libraries\PHPMailer\PHPMailer;
use Systems\Libraries\PHPMailer\SMTP;

System::Initialize();

$database = new Database(DB_HOST, DB_USER, DB_PASS, DB_TABLE);
$parse    = new ParseData();
$data     = new Data();
$callback = new DataCallback();
$router   = new AltoRouter();
$htm      = new Assets();

$mailer             = new PHPMailer();
$mailer->SMTPDebug  = SMTP::DEBUG_SERVER;
$mailer->isSMTP();
$mailer->Host       = HOST_MAILER;
$mailer->SMTPAuth   = AUTH_MAILER;
$mailer->Username   = USERNAME_MAILER;
$mailer->Password   = PASSWORD_MAILER;
$mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mailer->Port       = PORT_MAILER;
$mailer->setLanguage('vi', SYSTEMPATH . 'Libraries/PHPMailer/language/');

/**
 * Minify Given HTML String
 * @param  string $buffer
 * @return string
 */
function minify($buffer)
{
    $search  = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');
    $replace = array('>', '<', '\\1');
    $buffer  = preg_replace($search, $replace, $buffer);
    return $buffer;
}
