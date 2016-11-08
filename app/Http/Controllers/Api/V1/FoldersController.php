<?php

namespace App\Http\Controllers\Api\V1;

use App\Folder;
use App\Http\Controllers\Controller;

class FoldersController extends Controller{

    public function index(){
        $folders = Folder::all();
        return $this->response->array($folders);
    }

    public function show($id){
        $folder = Folder::find($id);
        return $this->response->array($folder);
    }
}