<?php

/**
	Berfungsi untuk load system dan konfigurasi
	
	@author : Mufid Jamaluddin	
**/
define("BASEDIR", __DIR__);

require_once BASEDIR.'/system/fconstant.php';
require_once BASEDIR.'/config/routeconfig.php';
require_once BASEDIR.'/system/route.php';
require_once BASEDIR.'/system/controller.php';

$obj_route = new MufidF\Router\Route();

$obj_route->go();

?>