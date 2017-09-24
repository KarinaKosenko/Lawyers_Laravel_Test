<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Uploader;
use App\Upload;

/**
 * Class UploadsController - controller for working with files' uploading.
 */
class UploadsController extends Controller
{
    /**
     * Method returns file uploading form page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function upload()
    {
        return view('layouts.single', [
            'page' => 'pages.uploadImagePage',
            'title' => 'Uploading Image',
        ]);
    }

    /**
     * Method for file validation and uploading.
     *
     * @param Request $request
     * @param Uploader $uploader
     * @param Upload $uploadModel
     * @param $user_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploadPost(Request $request, Uploader $uploader, Upload $uploadModel, $user_id)
    {
        for ($i = 0; $i < count($request->file); $i++) {
            if ($uploader->validate($request, $i, config('imagerules'))) {
                $uploadedPath = $uploader->upload(config('project.imageUploadSection'));

                if ($uploadedPath !== false) {
                    $uploadsModel = $uploader->register($uploadModel, $user_id);
                    $uploadedProps = $uploader->getProps();
                }
            } else {
                return view('layouts.single', [
                    'page' => 'errors.uploadError',
                    'title' => 'Add Image',
                    'message' => implode($uploader->getErrors(), '. '),
                    'user_id' => $user_id,
                ]);
            }
        }

        return view('layouts.single', [
            'page' => 'pages.messagePage',
            'message' => trans('custom.pending_validation'),
        ]);
    }
}
