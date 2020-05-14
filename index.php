<?php

error_reporting(E_ALL);


require('config/app.php');
require('config/database.php');
require('config/User.php');

// here our routes
$page = (! empty($_GET['page'])) ? $_GET['page'] : null ;


switch ($page) {
	case 'user':

		require('users/index.php');

		break;
    
	default:
		require('home.php');
		break;
}
