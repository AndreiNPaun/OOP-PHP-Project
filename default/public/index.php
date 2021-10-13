<?php
session_start();
require '../app/autoload.php';

$routes = new \Job\Routes();

$entryPoint = new \CSY2028\EntryPoint($routes);

$entryPoint->run();
