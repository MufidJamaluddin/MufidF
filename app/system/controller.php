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
	protected $db;
	
	// load third party app
	protected $inst_app;
	
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
		$load_path = BASEDIR.'/third_party/'.$classname.'.php';
		
		if(file_exists($load_path))
		{
			include $load_path;
			
			$class = 'MufidF/ThirdParty/'.$classname;
				
			$inst_app[$classname] = new $class;
		}
		else
			throw new Exception("ThirdParty $classname Class Didnot Found");
	}
	
	public function loadView($filename, $data = null)
	{
		$load_path = BASEDIR.'/views/'.$filename.'.php';
		
		if(file_exists($load_path))
		{
			if(isset($data))
			{
				foreach($data as $key => $val)
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