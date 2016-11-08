<?php

namespace App\Http\Controllers\Api\V1;

use App\File;
use App\Http\Controllers\Controller;

class FilesController extends Controller{

    public function index(){
        $files = File::all();
        return $this->response->array($files);
    }

    public function show($id){
        $file = File::find($id);
        return $this->response->array($file);
    }
}