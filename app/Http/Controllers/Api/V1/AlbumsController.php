<?php

namespace App\Http\Controllers\Api\V1;

use App\Album;
use App\Http\Controllers\Controller;

class AlbumsController extends Controller{

    public function listAll(){
        $albums = Album::all();
        return $this->response->array($albums);
    }

    public function info($id){
        $album = Album::find($id);
        return $this->response->array($album);
    }
}