<?php

namespace App\Models;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    use HasFactory;
    /*
    // Informar o nome do input
    // A extensão
    // E o tamanho maximo permitido
    */
    public function execute(Request $request, $inputname, $extension, $maxsize){
        $newNameFile = null;

        if($request->hasFile("$inputname") && $request->file("$inputname")->isValid()) {
            if( $request->file("$inputname")->extension() === $extension && $request->file("$inputname")->getSize() <= $maxsize ) {
                $name = uniqid(date('YmdHis'));

                $extension = $request->file("$inputname")->extension();

                $newNameFile = "$name.$extension";

                $upload = $request->file("$inputname")->storeAs('upload', $newNameFile, 'public');

                return $upload;
            }
        }
    }
}
