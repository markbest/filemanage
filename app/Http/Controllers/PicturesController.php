<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Picture;
use App\Album;
use Redirect;
use Illuminate\Support\Facades\DB;

class PicturesController extends Controller
{
    public function index(){
        $albums = Album::all();
        $collection = DB::table('albums_pictures')
                    ->leftjoin('albums', 'albums_pictures.album_id', '=', 'albums.id')
                    ->select('albums_pictures.*', 'albums.name as album_name')
                    ->orderBy('albums_pictures.id','desc')
                    ->get()
                    ->toArray();
        $pictures = array();
        foreach($collection as $data){
            $pictures[$data->album_id]['src'][$data->id] = $data->src;
            $pictures[$data->album_id]['name'] = $data->album_name ? $data->album_name : '尚未排入相册的图片';
        }
        krsort($pictures);
        return view('picture',['pictures'=>$pictures,'albums'=>$albums]);
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
}
