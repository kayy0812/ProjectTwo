<?php
require_once 'Config.php';

$router->setBasePath($data::BasePath(HOSTPATH));
$router->addRoutes(array(
    array('GET', '/', TEMPATH . '/Sites/Pages/Home.php', 'home')
));

$match = $router->match();
    if ($match) {
        if (is_readable($match["target"])) { 
            $parse->parse_get($match["params"]);
            $parse->parse_get(array("page" => $match["name"]));
            require_once TEMPATH . '/Sites/Head.php';         
            require_once $match["target"];
            require_once TEMPATH . '/Sites/Footer.php';
        } else {
            require_once TEMPATH . '/Sites/Pages/Errors/404.php';
        }
    } else {
        require_once TEMPATH . '/Sites/Pages/Errors/404.php';
    }
