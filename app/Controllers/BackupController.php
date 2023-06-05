<?php

namespace App\Controllers;

use Redirect;
use ZipArchive;

class BackupController extends Controller
{
    /**
     * Generate a backup and force download.
     *
     * @return void
     */
    public function index(): void
    {
        $files = storage()->dir('resources/assets/files');

        if (!storage()->exists('resources/assets/files/backups/backup.zip')) {
            storage()->file('resources/assets/files/backups/backup.zip');
        }

        $zip = new ZipArchive();
        $zip->open(server('root') . '/resources/assets/files/backups/backup.zip', ZipArchive::OVERWRITE);

        foreach ($files as $file) {
            if ($file['type'] != 'dir') {
                $filename = storage()->basename($file['path']) . '.' . storage()->extension($file['path']);
                $zip->addFile('/'.$file['path'], $filename);
            }
        }

        $zip->addFile(server('root') . '/database/database.sqlite', 'database.sqlite');

        $zip->close();

        storage()->download('resources/assets/files/backups/backup.zip', 'backup.zip');
    }
}
