<?php
session_start();

require 'classes/DB.php';
require 'classes/user.php';

$userOBJ = new \MyApp\User;

define('BASE_URL', 'http://localhost/INPT_SM/vchat/');