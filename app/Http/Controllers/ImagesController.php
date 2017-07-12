<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Upload;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ImagesController extends Controller
{
    public function index($id_user)
    {
        $user = User::findOrFail($id_user);
        $uploads = $user->uploads;

        return view('layouts.single', [
            'page' => 'pages.imagesListPage',
            'uploads' => $uploads,
            'user' => $user,
        ]);
    }


    public function delete($id_user, $id_upload)
    {
        $upload = Upload::findOrFail($id_upload)
            ->delete();

        return redirect('/images/index/' . $id_user);
    }


    public function show($path)
    {
        list($imgFile, $ext) = $this->getImagePath($path);
        $img = Image::make($imgFile);

        return $this->createResponse($img, $ext, 100);
    }

    protected function getImagePath($path)
    {
        $nameArray = explode('.', $path);
        $ext = array_pop($nameArray);
        $file = str_replace('.', '/', implode('.', $nameArray));
        //"5/5d8/5d8a1e5b371dd90c0b9064c6c859603d9e640994"
        $filePath = config('project.uploadPath') . config('project.imageUploadSection') . '/' . $file;

        if (!File::isFile($filePath)) {
            $filePath = config('project.imageDefaultPath');
            $ext = 'jpg';
        }

        return [$filePath, $ext];
    }

    protected function createResponse($imgObj, $ext = 'jpg', $quality = 75)
    {
        return $imgObj->response($ext, $quality)
            ->header('Cache-Control', 'public, max-age=86400');
    }
}
