<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $guarded;

    // protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public  function getFileType()
    {

        $path_info = pathinfo($this->path);

        return $path_info['extension'];
    }
    public function getFileName()
    {
        if (!$this->path) {
            return null;
        }
        if ($this->isImage()) {
            return 'image';
        }
        if ($this->isVideo()) {
            return 'video';
        }
        if ($this->isAudio()) {
            return 'audio';
        }
        if ($this->isFile()) {
            return 'file';
        }
        return null;
    }

    //check extension of file is image
    public function isImage()
    {
        $fileType = $this->getFileType();
        if ($fileType == 'jpg' || $fileType == 'png' || $fileType == 'jpeg' || $fileType == 'gif' || $fileType == 'svg' || $fileType == 'bmp'   || $fileType == 'webp'  || $fileType == 'ico') {
            return true;
        }
        return false;
    }

    //check extension of file is video
    public function isVideo()
    {
        $fileType = $this->getFileType();
        if ($fileType == 'mp4' || $fileType == 'avi' || $fileType == 'mov') {
            return true;
        }
        return false;
    }

    //check extension of file is audio
    public function isAudio()
    {
        $fileType = $this->getFileType();
        if ($fileType == 'mp3' || $fileType == 'wav' || $fileType == 'ogg') {
            return true;
        }
        return false;
    }

    //check extension of file
    public function isFile()
    {
        $fileType = $this->getFileType();
        if ($fileType == 'pdf' || $fileType == 'doc' || $fileType == 'docx' || $fileType == 'xls' || $fileType == 'xlsx' || $fileType == 'ppt' || $fileType == 'pptx' || $fileType == 'txt') {
            return true;
        }
        return false;
    }

    //create date casts for created_at and updated_at
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s a',
        'updated_at' => 'datetime:Y-m-d H:i:s a',
    ];


    //create function to get file size
    public function getFileSize()
    {

        $fileSize = $this->size;

        //check if file size is less than 1kb
        if ($fileSize < 1024) {
            $fileSize = $fileSize . ' B';
        }

        //check if file size is less than 1mb
        if ($fileSize > 1024 && $fileSize < 1048576) {
            $fileSize = round($fileSize / 1024, 2) . ' KB';
        }

        //check if file size is less than 1gb

        if ($fileSize > 1048576 && $fileSize < 1073741824) {
            $fileSize = round($fileSize / 1048576, 2) . ' MB';
        }

        //check if file size is less than 1tb

        if ($fileSize > 1073741824 && $fileSize < 1099511627776) {
            $fileSize = round($fileSize / 1073741824, 2) . ' GB';
        }

        //check if file size is less than 1pb


        return $fileSize;
    }


    //create new response variable

    //get duplicate files with hash
    public function getDuplicateFiles()
    {
        $files = FileReport::where('hash', $this->hash)->get();
        return $files;
    }
}
