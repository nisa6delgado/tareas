<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\File;
use App\Models\Task;

class Servers extends Controller
{
    public function backup()
    {
        $this->clear();
        
        date_default_timezone_set('America/Caracas');
        
        $host = config('database', 'host');
        $username = config('database', 'username');
        $password = config('database', 'password');
        $database = config('database', 'database');;
        $tables = '*';
        
        $connection = new \mysqli($host, $username, $password, $database);
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
        
        $filename = $_SERVER['DOCUMENT_ROOT'] . '/vendor/nisadelgado/framework/backups/database.sql';
        $fopen = fopen($filename, 'w+');
        fwrite($fopen, $return);
        fclose($fopen);
        
        unlink($_SERVER['DOCUMENT_ROOT'] . '/vendor/nisadelgado/framework/backups/backup.zip');
        
        $zip = new \ZipArchive();
        
        $opendir = opendir($_SERVER['DOCUMENT_ROOT'] . '/resources/assets/files');
        
        if ($zip->open($_SERVER['DOCUMENT_ROOT'] . '/vendor/nisadelgado/framework/backups/backup.zip', \ZIPARCHIVE::CREATE) === true) {
            while ($readdir = readdir($opendir)) {
                if ($readdir != '.' && $readdir != '..') {
                    $zip->addFile($_SERVER['DOCUMENT_ROOT'] . '/resources/assets/files/' . $readdir, $readdir);
                }
            }
            
            $zip->addFile($_SERVER['DOCUMENT_ROOT'] . '/vendor/nisadelgado/framework/backups/database.sql' . $readdir, 'database.sql');
        }
        
        $zip->close();
        
        \File::download('vendor/nisadelgado/framework/backups/backup.zip', 'backup ' . date('d-m-Y h.ia') . '.zip');
    }
    
    public function clear()
    {
        $files = File::doesntHave('task')->get();

        foreach ($files as $file) {
            if (file_exists('resources/assets/files/' . $file->file)) {
                unlink('resources/assets/files/' . $file->file);
            }
        }

        File::doesntHave('task')->delete();

        Comment::doesntHave('task')->delete();

        Task::doesntHave('project')->delete();
    }
}
