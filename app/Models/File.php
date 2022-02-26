<?php

namespace App\Models;

class File extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'files';

     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_task', 'file', 'date_create', 'date_update'];

    /**
     * Get the ext file.
     *
     * @return string
     */
    public function getExtAttribute()
    {
        return storage()->extension($this->file);
    }

    /**
     * Get the icon file.
     *
     * @return string
     */
    public function getIconAttribute()
    {
        if (in_array($this->ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            return 'far fa-file-image';
        }

        if (in_array($this->ext, ['html', 'php', 'css', 'json', 'js', 'htaccess'])) {
            return 'far fa-file-code';
        }

        if (in_array($this->ext, ['doc', 'docx'])) {
            return 'far fa-file-word';
        }

        if (in_array($this->ext, ['ppt', 'pptx'])) {
            return 'far fa-file-powerpoint';
        }

        if (in_array($this->ext, ['xls', 'xlsx'])) {
            return 'far fa-file-excel';
        }

        if (in_array($this->ext, ['pdf'])) {
            return 'far fa-file-pdf';
        }

        if (in_array($this->ext, ['zip', 'rar'])) {
            return 'fas fa-file-archive';
        }

        return 'fa fa-file';
    }

    /**
     * Get the url file.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        if (in_array($this->ext, ['pptx', 'ppt', 'doc', 'docx', 'xls', 'xlsx'])) {
            $file = str()->replace(' ', '+', $this->file);
            return 'https://view.officeapps.live.com/op/embed.aspx?src=https://tareas.nisadelgado.com/resources/assets/files/' . $this->file;
        }

        return '/resources/assets/files/' . $this->file;
    }
}
