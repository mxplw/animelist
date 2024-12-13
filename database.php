<?php

$host       = '127.0.0.1';
$username   = 'root';
$password   = '';
$database   = 'anime_list';

$db = mysqli_connect($host, $username, $password, $database)
or die('Error: '.mysqli_connect_error());
