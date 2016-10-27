<?php
namespace App\Http\Controllers\Api\V1;

use App\Album;
use App\Http\Controllers\Controller;

class AlbumsController extends Controller{
    public function listAll(){
        $result = array();

        $data = array();
        $index = 0;
        $albums = Album::all();
        foreach($albums as $album){
            $data[$index]['name'] = $album->name;
            $data[$index]['description'] = $album->description;
            $data[$index]['created_at'] = $album->created_at;
            $index++;
        }

        $result['status'] = '1';
        $result['content'] = $data;
        return json_encode($result);
    }
}