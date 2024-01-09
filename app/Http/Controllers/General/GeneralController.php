<?php

namespace ProjectManagement\Http\Controllers\General;

use Illuminate\Http\Request;
use ProjectManagement\Http\Controllers\Controller;

class GeneralController extends Controller
{
    //displaying alerts
    public static function alertMaker($heading,$body){
        return array("heading"=>"$heading","body"=>"$body");
    }
    //uploading files
    public  static function UploadFile($file,$type,$place){
        $maximum=9000000;
        $rand = rand(1, 999999999).rand(1000,9999);
        if ($file->move("assets/uploads/$place", $rand . "." . $file->getClientOriginalExtension())) {
            return $rand . "." . $file->getClientOriginalExtension();

        }else{
            return false;
        }

    }
}
