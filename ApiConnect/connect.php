<?php
define('host', 'localhost');
define('name', 'root');
define('pass', '');
define('db', 'db_goyan');

$conn = mysqli_connect(host, name, pass, db) or die('Error al conectar al servidor.');
