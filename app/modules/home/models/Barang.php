<?php

/**
	Class Utama Welcome
	
	@author : Mufid Jamaluddin	
**/

use MufidF\Controller\Controller as Controller;

class Barang
{

	public function getListBarang()
	{
		$this->con->loadDb('mysqli');
		
		return $this->con->db->getArrRawQ('SELECT `id_brg`, `nama_brg`, `harga`, `keterangan` FROM `barang`');
	}
	
}

?>