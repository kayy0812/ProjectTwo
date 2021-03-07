<?php
$page = $parse->get['page'];
$javascripts = array();
$stylesheets = array();
switch ($page) {
	case 'home':
		$javascripts = [

		];
		$stylesheets = [

		];
		break;
	
	default:
		# code...
		break;
}

$htm->AddStylesheet($stylesheets);
$htm->AddJavascript($javascripts);
$htm->GetHeader();
