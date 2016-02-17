<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\MaterialFile;
use Storage;

class MaterialFileController extends Controller
{
    public static function removeFile($id){

        $file = MaterialFile::findorfail($id);
        $material = $file->materials;
        MaterialFileController::destroyFile($file->filename);
        $thumb = 'thumbs/' . pathinfo($file->filename, PATHINFO_FILENAME) . '.jpg';
        MaterialFileController::destroyFile($thumb);
        $file->delete($id);

        return redirect()->back()->with('material', 'material');
    }

    public static function destroyFile($file)
    {

        if (Storage::has($file)) {
            Storage::delete($file);
        }

        // @to do - flash options to cookie return to edit_options with options
    }
}
