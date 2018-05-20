<?php

/**
	Class Utama Welcome
	
	@author : Mufid Jamaluddin	
**/

use MufidF\Controller\Controller as Controller;

class Welcome extends Controller
{
	
	/**
		Uri 	: http://localhost/mufidf/home/first/Welcome
		Method 	: GET
	**/
	public function get_index()
	{
		echo "Hello World! ";
	}
	
	/**
		Uri 		: http://localhost/mufidf/home/first/Welcome/do
		Method 		: GET
		Param GET	: id, name
	**/
	public function get_do($arg1 = 0, $id = 0, $name = 'Your Name')
	{		
		echo $id.". Welcome back, ".$name.'.</br>'.$arg1;
	}

	/**
		Uri		: http://localhost/mufidf/home/first/Welcome/listbrg
		Method	: GET
	**/
	public function get_listbrg()
	{
		$this->loadDb('mysqli');
	
		Controller::loadView('home/first/Table_header');
		
		$this->db->execRawQ('SELECT `id_brg`, `nama_brg`, `harga`, `keterangan` FROM `barang`', function($count,$obj){
			$data['count'] = $count;
			$data['obj'] = $obj;
			Controller::loadView('home/first/Table_bodyval', $data);
		});
		
		Controller::loadView('home/first/Table_footer');

	}
	
	/**
		Uri		: http://localhost/mufidf/home/first/Welcome/listbrg
		Method	: POST
	**/
	public function post_listbrg()
	{
		echo 'POST SUCCESS!';
	}
}

?>