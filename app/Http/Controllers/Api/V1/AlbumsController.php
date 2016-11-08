<?php

namespace App\Http\Controllers\Api\V1;

use App\Album;
use App\Picture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlbumsController extends Controller{

    public function index(){
        $albums = Album::all();
        return $this->response->array($albums);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:albums'
        ]);

        $message = '';
        $status = 0;
        $album = New Album;
        $album->name        = $request->input('name');
        $album->description = $request->input('description');
        $album->created_at  = date('Y-m-d h:i:s',time());
        if($album->save()){
            $status = 1;
            $message = 'Success Add New Album';
        }else{
            $status = 0;
            $message = 'Failed Add New Album';
        }
        return $this->response->array(array('status' => $status, 'message' => $message));
    }

    public function destroy($id)
    {
        Album::find($id)->delete();
        Picture::where('album_id',$id)->update(['album_id'=>0]);
        return $this->response->array(array('status' => 1, 'message' => 'Success Delete Album'));
    }

    public function show($id){
        $album = Album::find($id);
        return $this->response->array($album);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:albums'
        ]);

        $message = '';
        $status = 0;
        $album = Album::find($id);
        $album->name        = $request->input('name');
        $album->description = $request->input('description');
        if($album->save()){
            $status = 1;
            $message = 'Success Update Album';
        }else{
            $status = 0;
            $message = 'Failed Update Album';
        }
        $status = 1;
        $message = 'Success Update Album';
        return $this->response->array(array('status' => $status, 'message' => $message));
    }
}