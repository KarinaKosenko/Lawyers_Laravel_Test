<?php

namespace App\Classes;

use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

/**
 * Custom class for files uploading.
 */
class Uploader
{
    protected $file,
        $request,
        $props,
        $uploadPath,
        $validationErrors = [];

    /**
     * Method for files validation.
     */
    public function validate(Request $request, $i, array $rules = [])
    {
        $this->clearState();
        $validationFailed = false;
        $this->request = $request;

        if (in_array($request->file[$i], $request->file) && $request->file[$i]->isValid()) {
            $this->file = $request->file[$i];
            $this->fillProps();

            if (is_array($rules) && count($rules) > 0) {

                if (isset($rules['minSize'])) {
                    if ($this->props['size'] < $rules['minSize']) {
                        $validationFailed = true;
                        $this->validationErrors['minSize'] = trans('custom.file_min_size') . $rules['minSize'];
                    }
                }

                if (isset($rules['maxSize'])) {
                    if ($this->props['size'] > $rules['maxSize']) {
                        $validationFailed = true;
                        $this->validationErrors['maxSize'] = trans('custom.file_max_size') . $rules['maxSize'];
                    }
                }

                if (isset($rules['allowedExt']) && is_array($rules['allowedExt']) && count($rules['allowedExt']) > 0) {
                    if (!in_array($this->props['ext'], $rules['allowedExt'])) {
                        $validationFailed = true;
                        $this->validationErrors['allowedExt'] = trans('custom.file_ext') . implode(', ', $rules['allowedExt']);
                    }
                }

                if (isset($rules['allowedMime']) && is_array($rules['allowedMime']) && count($rules['allowedMime']) > 0) {
                    if (!in_array($this->props['mime'], $rules['allowedMime'])) {
                        $validationFailed = true;
                        $this->validationErrors['allowedMime'] = trans('custom.file_mime') . implode(', ', $rules['allowedMime']);
                    }
                }
            }
        } else {
            $validationFailed = true;
            $this->validationErrors['invalidUpload'] = trans('custom.invalid_upload');
        }

        return !$validationFailed;
    }

    /**
     * Method for files uploading.
     */
    public function upload($section = null)
    {
        $basePath = !is_null($section) ?  config('project.uploadPath', storage_path()) . '/'. $section : config('blog.uploadPath', storage_path()) . '/' . config('blog.defaultUploadSection', 'files');
        $newName = sha1($this->props['oldname'] . microtime(true));
        $newDir = substr($newName, 0, 1) . '/' . substr($newName, 0, 3);
        $this->uploadPath = str_replace('/', '.', $newDir . '/' . $newName);
        $newPath = $basePath . '/' . $newDir;

        if (!File::exists($newPath)) {
            if (!File::makeDirectory($newPath, config('project.storagePermissions', 0755), true)) {
                throw new \ErrorException('Не могу создать директорию ' . $newPath);
            }
        }

        if (File::isDirectory($newPath) && File::isWritable($newPath)) {
            $this->file->move($newPath, $newName);
        } else {
            throw new \ErrorException('Директория ' . $newPath . ' недоступна для записи');
        }

        return File::exists($newPath . '/' . $newName) ? $this->uploadPath : false;
    }

    /**
     * Method for files registration in a database.
     */
    public function register(Upload $uploadModel, $user_id)
    {
        return $uploadModel->create([
            'path' => $this->uploadPath,
            'oldname' => $this->props['oldname'],
            'size' => $this->props['size'],
            'ext' => $this->props['ext'],
            'mime' => $this->props['mime'],
            'user_id' => $user_id,
        ]);
    }

    /**
     * Method for getting validation errors.
     */
    public function getErrors()
    {
        return $this->validationErrors;
    }

    /**
     * Method for getting file's properties.
     */
    public function getProps()
    {
        return $this->props;
    }

    /**
     * Method for clearing class' fields before the next uploading.
     */
    protected function clearState()
    {
        unset($this->file, $this->request, $this->props);
        $this->validationErrors = [];
    }

    /**
     * Method for setting file's properties.
     */
    protected function fillProps()
    {
        $this->props['size'] = $this->file->getSize();
        $this->props['oldname'] = $this->file->getClientOriginalName();
        $this->props['ext'] = mb_strtolower($this->file->getClientOriginalExtension());
        $this->props['mime'] = $this->file->getMimeType();
    }
}