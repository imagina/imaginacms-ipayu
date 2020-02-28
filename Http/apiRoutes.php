<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/ipayu/v1'], function (Router $router) {

  require ('ApiRoutes/queriesRoutes.php');

  require ('ApiRoutes/plansRoutes.php');

  require ('ApiRoutes/customerRoutes.php');

});