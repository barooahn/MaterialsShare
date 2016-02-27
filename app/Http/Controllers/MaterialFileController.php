<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\MaterialFile;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Storage;
use Session;

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
        Session::flash('warning', 'You have successfully deleted'. $file->filename);

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

        $name = MaterialFileController::sanitize( pathinfo($file['file']->getClientOriginalName(), PATHINFO_FILENAME));
        $extension = strtolower($file['file']->getClientOriginalExtension());
        $filename = $name.'.'.$extension;
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

    function sanitize($string, $force_lowercase = true, $anal = false) {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }


}
