<?php

namespace App\Http\Controllers\Api\V1;

use App\Picture;
use App\Http\Controllers\Controller;

class PicturesController extends Controller{

    public function index(){
        $pictures = Picture::all();
        return $this->response->array($pictures);
    }

    public function show($id){
        $picture = Picture::find($id);
        return $this->response->array($picture);
    }
}