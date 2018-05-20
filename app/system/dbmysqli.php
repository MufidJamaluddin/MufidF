<?php

/**
	Namespace ini bertujuan untuk akses database
	
	@author : Mufid Jamaluddin	
**/

namespace MufidF\DB;

require_once BASEDIR.'/config/dbconfig.php';

use MufidF\Config\DbConfig as DbConfig;

class Dbmysqli
{
	/**
		Koneksi Database
	**/
	private $conn;
	
	/**
		Destruktor
	**/
	function __destruct()
	{
		if(isset($this->conn)) 
			$this->conn->close(); // Tutup Koneksi
	}
	
	/**
		Mendapatkan Koneksi
	**/
	public function getConnection()
	{
		if(isset($this->conn))
			return $this->conn;
		// Buka Koneksi
		$this->conn = new \mysqli(DbConfig::servername, DbConfig::username, DbConfig::password, DbConfig::dbname);
		
		if($this->conn->connect_error)
		{
			die($this->dbconf::$conn_failed . $conn->connect_error);
		}
		
		return $this->conn;
	}
	
	/**
		Eksekusi Raw Query
		Hasilnya object
	**/
	public function execRawQ($query, $iterateFunc)
	{
		$count = 0;
		$result = $this->getConnection()->query($query);
		
		while($obj = $result->fetch_object())
		{
			$count++;
			$iterateFunc($count, $obj);
		}
		
		$result->close();
	}
	
	/**
		Eksekusi Bind Parameter dg PreparedStatement
	**/
	public function execBindQ($query, $values, $iterateFunc)
	{
		$stmt = $this->getConnection()->prepare($query);
		
		foreach($values as $key => $value)
		{
			$stmt->bindValue($key, $value);
		}
		
		$result = $stmt->get_result();
		
		while($obj = $result->fetch_object())
		{
			$count++;
			$iterateFunc($count, $obj);
		}
		
		$stmt->close();
		
		$result->close();
	}
	
	/**
		Mendapatkan hasil raw query
		bentuk array
	**/
	public function getArrRawQ($query)
	{
		$result = $this->getConnection()->query($query);
		
		while($obj = $result->fetch_object())
		{
			$arr_obj[] = $obj;
		}
		
		$result->close();
		
		if(isset($arr_obj))
			return $arr_obj; 
		else
			return array();
	}
	
	/**
		Mendapatkan Hasil Query dg PreparedStatement
	**/
	public function getArrBindQ($query, $values)
	{	
		$stmt = $this->getConnection()->prepare($query);
		
		foreach($values as $key => $value)
		{
			$stmt->bindValue($key, $value);
		}
		
		$result = $stmt->get_result();
		
		while($obj = $result->fetch_object())
		{
			$arr_obj[] = $obj;
		}
		
		$result->close();
		
		$stmt->close();
		
		if(isset($arr_obj))
			return $arr_obj; 
		else
			return array();
	}
	
	/**
		Mendapatkan Affected Rows dari Query
	**/
	public function getRawAffRows($query)
	{
		$this->getConnection()->query($query);
		return $this->conn->affected_rows;
	}
	
	/**
		Mendapatkan Affected Rows dg PreparedStatement
	**/
	public function getBindAffRows($query, $values)
	{
		$stmt = $this->getConnection()->prepare($query);
		
		foreach($values as $key => $value)
		{
			$stmt->bindValue($key, $value);
		}
		
		$stmt->execute();
		
		$affected_rows = $stmt->affected_rows;
		
		$stmt->close;
		
		return $affected_rows;
	}
	
}

?>