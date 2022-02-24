<?php

namespace App\Controllers;

use Redirect;
use Storage;
use ZipArchive;

class Backups extends Controller
{
    /**
     * Generate a backup and force download.
     *
     * @return void
     */
    public function generate(): void
    {
        $files = scandir(server('DOCUMENT_ROOT') . '/resources/assets/files');

        if (!file_exists(server('DOCUMENT_ROOT') . '/resources/assets/files/backups/backup.zip')) {
            $fopen = fopen(server('DOCUMENT_ROOT') . '/resources/assets/files/backups/backup.zip', 'w+');
            fclose($fopen);
        }

        $zip = new ZipArchive();
        $zip->open(server('DOCUMENT_ROOT') . '/resources/assets/files/backups/backup.zip', ZipArchive::OVERWRITE);

        foreach ($files as $file) {
            if (filetype(server('DOCUMENT_ROOT') . '/resources/assets/files/' . $file) == 'file') {
                $zip->addFile(server('DOCUMENT_ROOT') . '/resources/assets/files/' . $file, $file);
            }
        }

        $zip->addFile(server('DOCUMENT_ROOT') . '/database/database.sqlite', 'database.sqlite');

        $zip->close();

        Storage::download('resources/assets/files/backups/backup.zip', 'backup.zip');
    }
}
