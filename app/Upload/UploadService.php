<?php

namespace App\Upload;

use Illuminate\Support\Facades\Storage;
use Image;
use Validator;

/**
 * Interface UploadService
 * @package namespace App\Upload;
 */
class UploadService implements UploadServiceInterface
{
    protected $disk;

    public function __construct()
    {
        $this->disk = Storage::disk(config('filesystems.default'));
    }

    /**
     * Delete a file
     */
    public function deleteFile($path)
    {
        if (!$this->disk->exists($path)) {
            return false;
        }

        return $this->disk->delete($path);
    }

    /**
     * Save a file
     * @param string $folder : path to folder which store
     * @param string $fileName : name to store
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string filename if save success
     */
    public function saveFile($folder, $fileName, $file)
    {
        if (!$this->validateImage($file)) {
            return false;
        }

        $fileExtention = $file->getClientOriginalExtension();

        if (!empty($fileName)) {
            $fileName = implode('.', [$fileName, $fileExtention]);
        } else {
            $fileName = $file->getClientOriginalName();
        }

        $content = Image::make($file);
        $content = $content->encode($fileExtention);

        $path = str_finish($folder, '/') . $fileName;
        $path = $this->cleanFolder($path);
        $path = 'public/' . $path;

        try {
            if ($this->disk->exists($path)) {
                $this->deleteFile($path);
            }

            $this->disk->put($path, $content);

            return $this->getFileURL($path);
        } catch (\Exception $ex) {
            \Logs::error('Error while upload file.', $ex, '3000');
        }

        return false;
    }

    /**
     * Move file to $oldPath -> $newPath
     * @param string $oldPath
     * @param string $newPath
     * @return string
     */
    public function moveFile($oldPath, $newPath)
    {
        try {
            if($this->disk->exists($oldPath)) {
                if ($this->disk->exists($newPath)) {
                    $this->deleteFile($newPath);
                }
                $this->disk->move($oldPath, $newPath);
            }
            return $this->getFileURL($newPath);
        } catch(\Exception $ex) {
            \Logs::error('', $ex, '3000');
        }
    }

    /**
     * @param $path
     * @param $fileName
     * @return string
     */
    public function getFileURL($path, $fileName = null)
    {
        if (!empty($fileName)) {
            $path .= $fileName;
        }

        if ($this->disk->exists($path)) {
            return asset($this->disk->url($path));
        }

        return asset('/image/no-image.png');
    }

    /**
     * Render image from file path
     * @param string $filePath
     * @return \Intervention\Image\Image
     */
    public function makeImage($filePath)
    {
        $content = Storage::get($filePath);

        return Image::make($content);
    }

    /**
     * Sanitize the folder name
     */
    public function cleanFolder($folder)
    {
        return trim(str_replace('..', '', $folder), '/');
    }

    /**
     * @param $file image file
     * @return bool validation result
     */
    protected function validateImage($file)
    {
        $validator = Validator::make([
            'image' => $file,
        ], [
            'image' => 'required|image|max:10240',
        ]);

        return !$validator->fails();
    }

    /**
     * Delete a folder
     */
    public function deleteFolder($path)
    {
        if (!$this->disk->exists($path)) {
            return false;
        }
        return $this->disk->deleteDirectory($path);
    }
}
