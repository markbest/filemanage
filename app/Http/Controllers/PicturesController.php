<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Picture;
use App\Album;
use Redirect;
use Illuminate\Support\Facades\Response;

class PicturesController extends Controller
{
    public function index(){
        $albums = Album::all();
        $pictures = Picture::where('album_id','0')->get();
        return view('pictures',['pictures'=>$pictures, 'albums'=>$albums]);
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

    public function move(Request $request){
        $album = $request->input('album');
        $pictures = $request->input('pic');

        if($album && is_array($pictures) && count($pictures)){
            foreach($pictures as $picture){
                $object = Picture::find($picture);
                $object->album_id = $album;
                $object->save();
            }
        }
        return Redirect::to('pictures');
    }

    public function delete(Request $request){
        $ids = $request->input('del-pic-ids');
        $ids_array = explode(',',$ids);
        foreach($ids_array as $id){
            $picture = Picture::find($id);
            unlink($picture->src);
            $picture->delete();
        }
        return Redirect::to('pictures');
    }

    public function download($id){
        $picture = Picture::find($id)->src;
        $picture_type_array = explode('.',$picture);
        $picture_name_array = explode('/',$picture);

        $picture_type = end($picture_type_array);
        $picture_name = end($picture_name_array);
        $file = public_path(). '/'. $picture;

        $headers = array(
            'Content-Type: application/'.$picture_type,
        );

        return Response::download($file, $picture_name, $headers);
    }
}
