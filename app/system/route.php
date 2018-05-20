<?php

/**
	Namespace ini bertujuan untuk route request uri ke path controller
	
	@author : Mufid Jamaluddin	
**/

namespace MufidF\Router;

use MufidF\Conf\FConstant as FConstant;
use MufidF\Config\RouteConfig as RouteConfig;

class Route
{
	/**
		Metode yang digunakan dalam akses request ke server
		GET, POST, PUT, DELETE
	**/
	public $method;
	
	/**
		Path yang diakses dimulai dari base index
	**/
	public $base_request_uri;
	
	/**
		Array dari path base index
	**/
	public $arr_path_uri;
	
	/**
		Controller yang sedang diakses
	**/
	public $controller;
	
	/**
		Konstruktor
	**/
	public function __construct()
	{
		$this->method = strtolower($_SERVER[FConstant::req_method]);
		$this->base_request_uri = isset($_SERVER[FConstant::req_pathinfo]) ? $_SERVER[FConstant::req_pathinfo] : $_SERVER[FConstant::req_qsa];
		$this->arr_path_uri = explode(FConstant::uri_delim, $this->base_request_uri);
	}
	
	/**
		aksi route
	**/
	private function startRoute($objname, $func)
	{
		$path = BASEDIR.'/route/'.$this->arr_path_uri[1].'/'.$this->arr_path_uri[2].'/'.$this->arr_path_uri[3].FConstant::ext;
		
		try
		{
			include $path;
						
			$obj = new $objname;
						
			$func($obj);
		}
		catch(Exception $e)
		{
			echo FConstant::notfound;
		}
	}
	
	/**
		Aksi Route ke path controller
	**/
	public function go()
	{
		switch(sizeof($this->arr_path_uri))
		{
			case 4 :
			
				$this->startRoute($this->arr_path_uri[3], function($object){
					call_user_func_array(array($object, $this->method.'_index'), $_GET);
				});
				
				break;
				
			case 5:
				
				$this->startRoute($this->arr_path_uri[3], function($object){
					$method_name = explode('&',$this->arr_path_uri[4]);
					call_user_func_array(array($object, $this->method.'_'.$method_name[0]), $_GET);
				});
				
				break;
				
			case 1:
				
				$path = RouteConfig::home_path.RouteConfig::home_class.FConstant::ext;
				$hmclass = RouteConfig::home_class;

				if(file_exists($path))
				{
					include $path;
							
					$object = new $hmclass;
							
					call_user_func_array(array($object, $this->method.'_index'), $_GET);
				}
				else
					echo FConstant::notfound;
				
				break;
				
			default:
				echo FConstant::notfound;
				break;
		}
	}
	
	/**
		Redirect Uri
	**/
	public static function redirect($path)
	{
		header(FConstant::loc.$path);
		die();
	}
	
}

?>