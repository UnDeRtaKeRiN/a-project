<?php
error_reporting(E_ALL | E_NOTICE);
ini_set('display_errors', '1');
require_once(__DIR__.'/../vendor/autoload.php');

$route = new Route();

$route->add('/', function()
    {
        $indexController = new IndexController(); /*Camel case weil die Klasse mit jeweils dem ersten Buchstaben groß, die abstammende Variable dann mit Anfangsbuchstaben klein*/
        $indexController->ticketaction();
    });
/*$route->add('/validate', 'Ticket');*/

/*echo '<pre>';
print_r($route);*/

$route->submit();

      
