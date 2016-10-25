<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Folder;
use App\File;
use Redirect;

class FoldersController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:folders'
        ]);

        $folder = New Folder;
        $folder->name        = $request->input('name');
        $folder->description = $request->input('description');
        $folder->created_at  = date('Y-m-d h:i:s',time());
        $folder->parent_id   = (int)$request->input('parent_id');
        if($folder->save()){
            if($folder->parent_id){
                return Redirect::to('files/folder/'.$folder->parent_id);
            }else{
                return Redirect::to('files');
            }
        }else{
            return Redirect::back()->withInput()->withErrors('更新失败');
        }
    }

    public function delete($id)
    {
        $folder = Folder::find($id);
        $parent_id = $folder->parent_id;
        $folder->delete();

        Folder::where('parent_id', $id)->delete();
        File::where('folders_id',$id)->update(['folders_id'=>0]);
        if($parent_id){
            return Redirect::to('files/folder/'.$folder->parent_id);
        }else{
            return Redirect::to('files');
        }
    }
}
