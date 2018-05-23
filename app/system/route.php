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
		Uri yang dimiliki oleh module tertentu
	**/
	public $module_uri;
	
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
		Object Controller yang sedang diakses
	**/
	public $obj_controller;
	
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
	private function startRoute($objname, $name_method)
	{
		$path = realpath($this->module_uri.'/controllers/'.$this->arr_path_uri[2].FConstant::ext);

		if($path)
		{
			include $path;
						
			$this->obj_controller = new $objname;
			$this->obj_controller->route = &$this;
			
			if(method_exists($this->obj_controller, $name_method))
			{
				call_user_func_array(array($this->obj_controller, $name_method), $_GET);
			}
			else
			{
				echo FConstant::notfound;
			}
		}
		else
		{
			echo FConstant::notfound;
		}
	}
	
	/**
	
	**/
	
	/**
		Aksi Route ke path controller
	**/
	public function go()
	{
		switch(sizeof($this->arr_path_uri))
		{
			case 3:
			
				$this->module_uri = BASEDIR.'/modules/'.$this->arr_path_uri[1].'/';
				
				if(isset($this->arr_path_uri[2]))
					$this->startRoute($this->arr_path_uri[2], $this->method.'_index');
				
				break;
				
			case 4:
			
				$this->module_uri = BASEDIR.'/modules/'.$this->arr_path_uri[1].'/';
				
				if(isset($this->arr_path_uri[3]))
				{
					$this->startRoute($this->arr_path_uri[2], $this->method .'_' . explode('&',$this->arr_path_uri[3])[0]);
				}
				else
				{
					$this->startRoute($this->arr_path_uri[2], $this->method . '_index');
				}
				break;
				
			case 5:
			
				$this->module_uri = BASEDIR.'/modules/'.$this->arr_path_uri[1].'/';
				
				$this->startRoute($this->arr_path_uri[2], $this->method .'_' . explode('&',$this->arr_path_uri[3])[0]);
				
				break;
				
			case 1:
			
				$this->module_uri = BASEDIR.RouteConfig::home_path;
				$this->startRoute(RouteConfig::home_class, $this->method.'_index');
			
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