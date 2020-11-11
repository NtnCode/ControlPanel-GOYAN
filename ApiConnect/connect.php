<?php
define('host', 'localhost');
define('user', 'root');
define('pass', '');
define('db', 'db_goyan');

$conn = mysqli_connect(host, user, pass, db) or die('Error al conectar al servidor.');
