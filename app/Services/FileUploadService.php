<?php

namespace App\Services;

class FileUploadService
{
    /**
     * Method: that store images in storage folder.
     *
     * @param $image
     * @param $path
     * @return mixed
     */
    public function upload($image, $path)
    {
        return $image->store($path);
    }
}
