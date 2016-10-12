<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Album;
use App\Picture;
use Redirect;

class AlbumsController extends Controller
{
    public function index(){
        $albums = Album::all();
        return view('albums')->with('albums',$albums);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:albums',
            'description' => 'required',
        ]);

        $album = New Album;
        $album->name        = $request->input('name');
        $album->description = $request->input('description');
        $album->created_at  = date('Y-m-d h:i:s',time());
        if($album->save()){
            return Redirect::to('albums');
        }else{
            return Redirect::back()->withInput()->withErrors('更新失败');
        }
    }

    public function destroy($id)
    {
        Album::find($id)->delete();
        Picture::where('album_id',$id)->update(['album_id'=>0]);
        return Redirect::to('albums');
    }
}
