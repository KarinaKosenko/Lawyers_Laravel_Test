<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Uploader;
use App\Upload;

class UploadsController extends Controller
{
    public function upload()
    {
        return view('layouts.single', [
            'page' => 'pages.uploadImagePage',
            'title' => 'Uploading Image',
        ]);
    }

    public function uploadPost(Request $request, Uploader $uploader, Upload $uploadModel, $user_id)
    {
        if ($uploader->validate($request, 'file', config('imagerules'))) {
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



        /*if ($uploader->validate($request, 'file', config ('imagerules'))) {
            $uploadedPath = $uploader->upload( config ('project.imageUploadSection'));

            if ($uploadedPath !== false) {
                $uploadsModel = $uploader->register($uploadModel, $user_id);
                $uploadedProps = $uploader->getProps();
            }

            //return $request->file;
        }
        else {
            return view('layouts.single', [
                'page' => 'errors.uploadError',
                'title' => 'Add Image',
                'message' => implode($uploader->getErrors(), '. '),
            ]);
        }*/
    }
}
