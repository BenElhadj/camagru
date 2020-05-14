<?php

//get the form values from the POST Request and test it if it's Not empty

$username = (! empty($_POST['username'])) ? $_POST['username'] : '';
$email = (! empty($_POST['email'])) ? $_POST['email'] : '';
$password = (! empty($_POST['password'])) ? $_POST['password'] : '';

//give the value to every variable 

$user->username=$username;
$user->email=$email;
$user->password=$password;

//finaly we call the create function to save our user to database

$user->create();

//redirect user to dashbord

header('Location: '.$appUrl.'index.php?page=users');