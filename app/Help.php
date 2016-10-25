<?php
use App\Folder;

function getAllFolderSelectList(){
    $result = '';
    $parent_folders = Folder::where('parent_id','0')->get();
    $result .= '<select name="folder" class="form-control" required="required">';
    $result .= '<option value=""></option>';
    foreach($parent_folders as $folder){
        $result .= '<option value="'.$folder->id.'">'.$folder->name.'</option>';
        $child_folders = Folder::where('parent_id',$folder->id)->get();
        if($child_folders->count()){
            foreach($child_folders as $child){
                $result .= '<option value="'.$child->id.'">&nbsp;'.$child->name.'</option>';
            }
        }
    }
    $result .= '</select>';
    return $result;
}