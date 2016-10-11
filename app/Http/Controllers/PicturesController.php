<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Picture;
use Redirect;

class PicturesController extends Controller
{
    public function index(){
        $pictures = Picture::all();
        return view('picture')->with('pictures',$pictures);
    }

    public function upload(Request $request){
        $result = array();
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
            $status = 'ok';
            $message = 'success upload';

            $picture = New Picture;
            $picture->album_id = 0;
            $picture->src = $destinationPath.$fileName;
            $picture->save();

        }catch (\Exception $e){
            $message = 'Some error occurs when uploading file';
            $status = 'nok';
        }

        $result['message'] = $message;
        $result['status'] = $status;
        return json_encode($result);
    }
}
