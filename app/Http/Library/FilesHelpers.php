<?php 

namespace App\Http\Library;
use Image;


trait FilesHelpers
{
    /** uploads image and returns the name and path */
    public function UploadImage($imageFile,$uploadPath,$height=128,$width=128){

        $image = $imageFile;
        $generated_name = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
        Image::make($image)->resize($height, $width)->save($uploadPath . $generated_name);
        $actual_image = $uploadPath . $generated_name;

        return $actual_image;
    }


}