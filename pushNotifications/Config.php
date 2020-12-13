<?php 
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','db_goyan');
define('DB_HOST','localhost');

define('FIREBASE_API_KEY', 'AAAAwX9dIlI:APA91bGEZb_a012QXu5iprtR1fB40199WnNiWwlrIZrfbokewp5PgsT1NyfW2jbIg2xAHZems6JxgBu-pNIEBU2HhtpOhEYrn2MuterK6lOSPvFtZ6kFt3v9G-fz3aLC-nwJvGDAnfSo');

$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        //Checking if any error occured while connecting
if (mysqli_connect_errno()) {
	echo "Fallo al conectar al servidor: " . mysqli_connect_error();
}


