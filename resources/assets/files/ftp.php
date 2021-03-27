<?php

$local_file = 'local.txt';
$remote_file = 'remote.txt';

// Set a basic connection
$connection = ftp_connect('ftp.rasth.com', 21);

// Login with username and password
$login = ftp_login($connection, 'rasthcom', 'zuliacampeoncopavenezuela2018');
ftp_pasv($connection, true);

// Upload a file
if (ftp_put($connection, $remote_file, $local_file, FTP_ASCII)) {
	echo 'Carga satisfactoria';
} else {
	echo 'Error';
}

ftp_close($connection);
