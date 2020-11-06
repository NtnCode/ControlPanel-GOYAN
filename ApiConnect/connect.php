<?php
define('host', 'localhost');
define('user', 'root');
define('pass', '');
define('db', 'system_greciastore');

$conn = mysqli_connect(host, user, pass, db) or die('Sin conexion al servidor');
