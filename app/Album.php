<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Picture;

class Album extends Model
{
    public $timestamps = false;
    public function getPictureList(){
        $pictures = Picture::where('album_id',$this->id)->get();
        return $pictures;
    }
}
