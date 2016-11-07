<?php

namespace App\Http\Controllers\Api\V1;

use App\File;
use App\Http\Controllers\Controller;

class FilesController extends Controller{

    public function listAll(){
        $files = File::all();
        return $this->response->array($files);
    }

    public function info($id){
        $file = File::find($id);
        return $this->response->array($file);
    }
}