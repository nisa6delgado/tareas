<?php

date_default_timezone_set('America/Caracas');

// Generate database backup
echo date('d/m/Y h:i:sa') . ": Generando respaldo de la base de datos...\n";

$host = 'localhost';
$username = 'nisadelg_root';
$password = 'zulia..2010';
$database = 'nisadelg_tareas';
$tables = '*';

$connection = new mysqli($host, $username, $password, $database);
if ($connection->connect_error) {
	die('La conexión falló: ' . $connection->connect_error);
}

if ($tables == '*') {
	$tables = [];
	$sql = 'SHOW TABLES';
	$query = $connection->query($sql);
	while ($row = $query->fetch_row()) {
		$tables[] = $row[0];
	}
} else {
	$tables = is_array($tables) ? $tables : explode(',', $tables);
}

$return = '';

foreach ($tables as $table) {
	$sql = "SHOW CREATE TABLE $table";
	$query = $connection->query($sql);
	$row = $query->fetch_row();

	$return .= "\n\n" . $row[1] . ";\n\n";

	$sql = "SELECT * FROM $table";
	$query = $connection->query($sql);

	$column_count = $query->field_count;
	
	
	for ($i = 0; $i < $column_count; $i++) {
		while ($row = $query->fetch_row()) {
			$return .= "INSERT INTO $table VALUES (";

			for ($j = 0; $j < $column_count; $j++) {
				$row[$j] = $row[$j];

				if (isset($row[$j])) {
					$return .= '"' . $row[$j] . '"';
				} else {
					$return .= '""';
				}

				if ($j < ($column_count - 1)) {
					$return .= ',';
				}
			}

			$return .= ");\n";
		}
	}

	$return .= ");\n";
}

$filename = 'backup/database.sql';
$fopen = fopen($filename, 'w+');
fwrite($fopen, $return);
fclose($fopen);

echo date('d/m/Y h:i:sa') . ": Respaldo de la base de datos generado...\n";


// Generate files backup
echo date('d/m/Y h:i:sa') . ": Generando respaldo de los archivos...\n";

unlink('backup/files.zip');

$zip = new ZipArchive();

$opendir = opendir($_SERVER['DOCUMENT_ROOT'] . '/resources/assets/files');

if ($zip->open($_SERVER['DOCUMENT_ROOT'] . '/vendor/nisadelgado/framework/backup/files.zip', ZIPARCHIVE::CREATE) === true) {
    while ($readdir = readdir($opendir)) {
        if ($readdir != '.' && $readdir != '..') {
            $zip->addFile($_SERVER['DOCUMENT_ROOT'] . '/resources/assets/files/' . $readdir, $readdir);
        }
    }
}

$zip->close();

echo date('d/m/Y h:i:sa') . ": Respaldo de los archivos generado...\n";