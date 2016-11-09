<?php

namespace App\Http\Controllers\Api\V1;

use App\Picture;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PicturesController extends Controller{

    public function index(){
        $pictures = Picture::all();
        return $this->response->array($pictures);
    }

    public function show($id){
        $picture = Picture::find($id);
        return $this->response->array($picture);
    }

    public function store(Request $request){
        $status = 0;
        $message = '';
        $file = $request->file('file');
        $allowed_extensions = ["png", "jpg", "gif"];
        if($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)){
            $message = 'You may only upload png, jpg or gif.';
        }

        try{
            $destinationPath = 'uploads/images/'.date('Y-m',time()).'/';
            $extension = $file->getClientOriginalExtension();
            $fileName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $fileName);
            $status = 1;
            $message = 'success upload';

            $picture = New Picture;
            $picture->album_id = $request->input('album_id');
            $picture->src = $destinationPath.$fileName;
            $picture->save();

        }catch (\Exception $e){
            $message = 'Some error occurs when uploading file';
            $status = 0;
        }

        return $this->response->array(array('status' => $status, 'message' => $message));
    }

    public function destroy($id)
    {
        $picture = Picture::find($id);
        unlink($picture->src);
        $picture->delete();
        return $this->response->array(array('status' => 1, 'message' => 'Success Delete Picture'));
    }

    public function move(Request $request)
    {
        $picture_id = $request->input('picture_id');
        $album = $request->input('album_id');
        $object = Picture::find($picture_id);
        $object->album_id = $album;
        $object->save();
        return $this->response->array(array('status' => 1, 'message' => 'Success Move Picture'));
    }
}