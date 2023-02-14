<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Helper
{
   
    public static function compareToArrays(array $request , $id , $tableName){
        $oldData = DB::table($tableName)
            ->select(array_keys($request))
            ->find($id);
        $differences = collect($oldData)->diff($request);
        if($differences->isNotEmpty()){
            return true;
        } else{
            return false;
        }
    }
    public static function compareToArraysCustomId(array $request , $id , $tableName , $idTable){
        $oldData = DB::table($tableName)
            ->where($idTable , $id)
            ->select(array_keys($request))
            ->get()->toArray();
        $differences = collect($oldData[0])->diff($request);
        if($differences->isNotEmpty()){
            return true;
        } else{
            return false;
        }
    }

    public static function sendEmail(){
        
    }
}
