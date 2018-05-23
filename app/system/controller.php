<?php

/**
	Berfungsi untuk Controller
	
	@author : Mufid Jamaluddin	
**/

namespace MufidF\Controller;

use MufidF\DB\Dbmysqli as Dbmysqli;

class Controller
{
	// database
	public $db;
	
	public function loadDb($dbname)
	{
		switch($dbname)
		{
			case 'mysqli':
		
				require_once BASEDIR.'/system/dbmysqli.php';
			
				$this->db = new Dbmysqli();
			
				break;
				
			default:
				
				throw new Exception("DB Name false");
				
				break;
		}	
	}
	
	public function loadTApp($classname)
	{
		$load_path = realpath($this->route->module_uri.'third_party/'.$classname.'.php');
		
		if($load_path)
		{
			include $load_path;
				
			$this->{$classname} = new $classname;
		}
		else
			throw new Exception("ThirdParty $classname Class Didnot Found");
	}
	
	public function loadModel($classname)
	{
		$load_path = realpath($this->route->module_uri.'models/'.$classname.'.php');
		
		if($load_path)
		{
			include $load_path;
			
			$this->{$classname} = new $classname;
			$this->{$classname}->con = &$this;
		}
	}
	
	public function loadView($filename, $data = null)
	{
		$load_path = realpath($this->route->module_uri.'views/'.$filename.'.php');
		
		if($load_path)
		{
			if(isset($data))
			{
				foreach($data as $key => &$val)
				{
					${$key} = $val;
				}
			}
			
			include $load_path;
		}
		else
			throw new Exception("File View $filename Didnot Found");
	}
	
}


?>