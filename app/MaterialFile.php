<?php

namespace App;

use App\Http\Controllers\MaterialFileController;
use FFMpeg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Request;
use Session;
use Spatie;


class MaterialFile extends Model
{
    //
    protected $fillable = ['mime', 'filename', 'original_filename'];

    public static function store($files, $material)
    {

        // Making counting of uploaded images
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;

        foreach ($files as $file) {
            if (!empty($file)) {
                $filename = $material->slug . '_' . str_replace(' ', '_', $file->getClientOriginalName());

                Storage::put($filename, file_get_contents($file));

                //add file path and thumb path to material_files database

                $material_file = MaterialFile::firstOrCreate([
                    'original_filename' => $file->getClientOriginalName(),
                    'filename' => $filename,
                    'mime' => $file->getClientMimeType(),
                ]);

                //add to material file table
                $material->files()->save($material_file);
                $uploadcount++;

                //create thumb

                MaterialFile::getExtensionType($file, $filename);
            }

        }

        if ($uploadcount == $file_count) {
            Session::flash('success', 'Upload(s) successfully');
        } else {
            return Redirect::to('material.edit')->withInput();
        }
    }

    public static function getExtensionType($file, $filename)
    {
        $extension = $file->getClientOriginalExtension();

        switch ($extension) {
            case 'pdf':
            case 'PDF':

                $name = pathinfo($filename, PATHINFO_FILENAME);
                $pdf = new Spatie\PdfToImage\Pdf(storage_path('app/' . $filename));

                $path = $name . '.jpg';
                $pdf->saveImage($path);

                $old_path = $name . '.jpg';
                $new_path = storage_path() . '/app/thumbs/' . $name . '.jpg';
                if (File::move($old_path, $new_path)) {
                    $pathToPicture = '/thumbs';
                    break;
                } else {
                    $pathToPicture = "failed to copy $file...\n";
                    break;
                }
                break;


            case 'doc':
            case 'DOC':
            case 'docx':
            case 'DOCX':
            case 'ppt':
            case 'PPT':
            case 'pptx':
            case 'PPTX':

                $path = storage_path() . '/app/';
                chdir($path);

                exec("export HOME=/tmp && libreoffice --headless --convert-to pdf $filename");

                $name = pathinfo($filename, PATHINFO_FILENAME);
                $pdf = new Spatie\PdfToImage\Pdf(storage_path('app/' . $name . '.pdf'));


                $path = $name . '.jpg';
                $pdf->saveImage($path);

                $old_path = $name . '.jpg';
                $new_path = storage_path() . '/app/thumbs/' . $name . '.jpg';
                if (File::move($old_path, $new_path)) {
                    $pathToPicture = '/thumbs';
                    $pdf = $name . '.pdf';
                    MaterialFileController::destroyFile($pdf);
                    break;
                } else {
                    $pathToPicture = "failed to copy $file...\n";
                    break;
                }
                break;

            case 'jpg':
            case 'JPG':
            case 'png':
            case 'PNG':
            case 'bmp':

                $file = Storage::get($filename);

                $img = Image::make($file)->encode('png', 75);
                if (Storage::put('thumbs/' . $filename, $img)) {

                    $pathToPicture = '/thumbs';
                    break;
                } else {
                    $pathToPicture = "failed to copy $file...\n";
                    break;
                }

            case 'mp3':
            case 'MP3':

                $pathToPicture = 'img/audio.png';
                break;

            case 'WMV':
            case 'wmv':
            case 'mp4':
            case 'MP4':
            case 'avi':
            case 'AVI':
                $path = storage_path() . '/app/';
                chdir($path);
                $name = pathinfo($filename, PATHINFO_FILENAME);
                exec("ffmpeg -i $filename -ss 1 -vframes 1 $name.jpg");
                $old_path = $name . '.jpg';
                $new_path = storage_path() . '/app/thumbs/' . $name . '.jpg';
                if (File::move($old_path, $new_path)) {
                    $pathToPicture = '/thumbs';
                    break;
                } else {
                    $pathToPicture = "failed to copy $file...\n";
                    break;
                }
                break;

            default:
                $pathToPicture = 'img/file-icon.png';;
                break;
        }

        return $pathToPicture;
    }

    public static function download($file_id)
    {
        $file = MaterialFile::findorfail($file_id);

        $pathToFile = storage_path() . '/app/' . $file->filename;

        return response()->download($pathToFile);
    }

    public static function get($filename)
    {

        $material_file = MaterialFile::where('filename', '=', $filename)->firstOrFail();

        $file = Storage::get($material_file->filename);

        return (new Response($file, 200))
            ->header('Content-Type', $material_file->mime);
    }

    /**
     * Get the activity use's material.
     *
     * @return Materials
     */
    public function materials()
    {
        return $this->belongsTo('App\Material');
    }

}
