<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Upload;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

/**
 * Class ImagesController - controller for working with images.
 */
class ImagesController extends Controller
{
    /**
     * Method for getting user' list of images.
     *
     * @param $id_user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * Method for images deleting.
     *
     * @param $id_user
     * @param $id_upload
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id_user, $id_upload)
    {
        $upload = Upload::findOrFail($id_upload)
            ->delete();

        return redirect('/images/index/' . $id_user);
    }

    /**
     * Method shows one image (using a path from the image link).
     *
     * @param $path
     * @return mixed
     */
    public function show($path)
    {
        list($imgFile, $ext) = $this->getImagePath($path);
        $img = Image::make($imgFile);

        return $this->createResponse($img, $ext, 100);
    }

    /**
     * Service method for getting image path.
     *
     * @param $path
     * @return array
     */
    protected function getImagePath($path)
    {
        $nameArray = explode('.', $path);
        $ext = array_pop($nameArray);
        $file = str_replace('.', '/', implode('.', $nameArray));
        $filePath = config('project.uploadPath') . config('project.imageUploadSection') . '/' . $file;

        if (!File::isFile($filePath)) {
            $filePath = config('project.imageDefaultPath');
            $ext = 'jpg';
        }

        return [$filePath, $ext];
    }

    /**
     * Service method returns image response.
     *
     * @param $imgObj
     * @param string $ext
     * @param int $quality
     * @return mixed
     */
    protected function createResponse($imgObj, $ext = 'jpg', $quality = 75)
    {
        return $imgObj->response($ext, $quality)
            ->header('Cache-Control', 'public, max-age=86400');
    }
}
