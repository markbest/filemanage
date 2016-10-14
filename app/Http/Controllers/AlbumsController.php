<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Album;
use App\Picture;
use Redirect;

class AlbumsController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:albums'
        ]);

        $album = New Album;
        $album->name        = $request->input('name');
        $album->description = $request->input('description');
        $album->created_at  = date('Y-m-d h:i:s',time());
        if($album->save()){
            return Redirect::to('pictures');
        }else{
            return Redirect::back()->withInput()->withErrors('更新失败');
        }
    }

    public function destroy($id)
    {
        Album::find($id)->delete();
        Picture::where('album_id',$id)->update(['album_id'=>0]);
        return Redirect::to('pictures');
    }
}
