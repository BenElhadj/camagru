<?php

class database
{

	static function connection()
	{
		try {
			$conn = new PDO('mysql:host=127.0.0.1;dbname=testha', 'root', '');
	        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			 $conn = null;
		}
			return $conn;
	}
}