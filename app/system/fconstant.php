<?php

/**
	Kelas menyimpan nilai konstan system
	
	@author : Mufid Jamaluddin
**/

namespace MufidF\Conf;

class FConstant
{
	const chempty = '';
	
	const uri_delim = '/';
	const ext = '.php';
	const req_method = 'REQUEST_METHOD';
	const req_pathinfo = 'PATH_INFO';
	const req_qsa = 'QUERY_STRING';
	
	const module = 1;
	const controller = 2;
	const method = 3;
	
	const notfound = 'Error 404 - Not Found';
	const loc = 'Location : ';
}

?>