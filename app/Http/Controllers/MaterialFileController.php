<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\MaterialFile;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Storage;

class MaterialFileController extends Controller
{
    protected $image;

    public static function removeFile($id)
    {

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

    public function getUpload()
    {
        return view('pages.upload');
    }

    public function postUpload()
    {
        $file = Input::all();

        $dir = Auth::user()->username;
        $path = '/users/' . $dir;
        if (!is_dir(public_path() . $path)) {
            mkdir(public_path() . $path);
        }
        $filename = str_replace(' ', '_', $file['file']->getClientOriginalName());
        $file['file']->move(public_path() . $path . '/', $filename);

        $response = $filename;
        return $response;

    }

    public function deleteUpload()
    {

        $filename = Input::get('id');

        if (!$filename) {
            return 0;
        }

        $dir = Auth::user()->username;
        $path = '/users/' . $dir;
        $filename = str_replace(' ', '_', $filename);
//        dd(public_path().$path.'/'.$filename);
        $deleted = File::delete(public_path() . $path . '/' . $filename);
        $response = $deleted ? 'deleted' : 'Error can\'t delete';

        return $response;
    }


}
