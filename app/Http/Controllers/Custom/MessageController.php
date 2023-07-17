<?php

namespace App\Http\Controllers\Custom;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    //--------------------------- db error message print ---------------------//
    public static function getErrorMessage($error){
        $message = '';
        $clonePosition = strpos($error,":");
        $strToChar = str_split($error); 
        for($i = 0; $i < $clonePosition; $i++){
        $message = $message . $strToChar[$i];
        }
        return $message;
    }
}
