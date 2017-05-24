<?php

namespace App\Upload;

interface UploadServiceInterface {
    public function deleteFile($path);

    public function saveFile($folder, $fileName, $file);

    public function moveFile($oldPath, $newPath);

    public function getFileURL($path, $fileName = null);

    public function makeImage($filePath);

    public function cleanFolder($folder);

    public function deleteFolder($path);
}
