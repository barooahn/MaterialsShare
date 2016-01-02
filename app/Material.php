<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Ghanem\Rating\Contracts\Ratingable;
use Ghanem\Rating\Traits\Ratingable as RatingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie;
use dompdf;
use Conner\Likeable\LikeableTrait;
use FFMpeg;
use Sofa\Eloquence\Eloquence;



class Material extends Model implements SluggableInterface, Ratingable {

	use SoftDeletes;
	use SluggableTrait;
	use LikeableTrait;
	use RatingTrait;
	use Eloquence;


	protected $dates = ['deleted_at'];

	protected $sluggable = [
		'build_from' => 'title',
		'save_to'    => 'slug',
	];

	protected $guarded  = array('id');

	protected $fillable = ['user_id', 'title', 'slug', 'target_language', 'objective',
							'time_needed_prep', 'time_needed_class', 'materials', 'procedure_before', 'procedure_in',
							'follow_up', 'variations', 'tips', 'notes'];

	protected $searchableColumns = [
		'title' => 50,
		'target_language' => 10,
		'objective' => 20,
		'time_needed_prep' => 10,
		'time_needed_class' => 10,
		'materials' => 5,
		'categories.category' => 30,
		'levels.level' => 10,
		'languageFocuses.language_focus' => 10,
		'activityUses.activity_use' => 10,
		'pupilTasks.pupil_task' => 10,
	];

	public static $paginate = 5;


	/**
	 * Get the materials's language.
	 *
	 * @return Language
	 */
	public function language()
	{
		return $this->belongsTo('App\Language');
	}

	/**
	 * Get the materials's categories.
	 *
	 * @return MaterialCategory
	 */
	public function categories()
	{
		return $this->belongsToMany('App\MaterialCategory');
	}

	/**
	 * Get the material's User.
	 *
	 * @return User
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * Get the material's levels.
	 *
	 * @return MaterialLevel
	 */
	public function levels()
	{
		return $this->belongsToMany('App\MaterialLevel');
	}

	/**
	 * Get the material's language focuses.
	 *
	 * @return MaterialLanguageFocus.
	 */
	public function languageFocuses()
	{
		return $this->belongsToMany('App\MaterialLanguageFocus',
			'material_material_language_focus', 'material_id', 'focus_id');
	}

	/**
	 * Get the material's activity uses.
	 *
	 * @return MaterialActivityUse
	 */
	public function activityUses()
	{
		return $this->belongsToMany('App\MaterialActivityUse',
			'material_material_activity_use','material_id', 'activity_use_id');
	}

	/**
	 * Get the material's Pupil tasks.
	 *
	 * @return MaterialPupilTask
	 */
	public function pupilTasks()
	{
		return $this->belongsToMany('App\MaterialPupilTask',
			'material_material_pupil_task','material_id', 'pupil_task_id');
	}

	/**
	 * Get the material's files.
	 *
	 * @return MaterialFile
	 */
	public function files()
	{
		return $this->hasMany('App\MaterialFile');
	}

	public static function getExtensionType($file, $destinationPath, $filename)
	{
		$extension = $file->getClientOriginalExtension();

		switch ($extension) {
			case 'pdf':
			case 'PDF':

				$pdf = new Spatie\PdfToImage\Pdf($destinationPath.'/'.$filename);
				$pdf->saveImage($destinationPath.'/thumbs/'. $filename.'.jpg');

				$pathToPicture = $destinationPath.'/thumbs/'. $filename.'.jpg';
				break;


			case 'doc':
			case 'DOC':
			case 'docx':
			case 'DOCX':
			case 'ppt':
			case 'PPT':
			case 'pptx':
			case 'PPTX':


				exec("cd $destinationPath && libreoffice --headless --convert-to pdf $filename");

				$name = pathinfo($filename, PATHINFO_FILENAME);
				$pdf = new Spatie\PdfToImage\Pdf($destinationPath . '/' . $name.'.pdf');
				$pdf->saveImage($destinationPath .'/thumbs/' . $name . '.jpg');

				unlink($destinationPath .'/'.$name . '.pdf');

				$pathToPicture = $destinationPath . '/thumbs/' . $name . '.jpg';
				break;

			case 'jpg':
			case 'JPG':
			case 'png':
			case 'PNG':
			case 'bmp':

				$file = $destinationPath.'/'.$filename;
				$newfile = $destinationPath.'/thumbs/'. $filename;

				if(copy($file, $newfile)) {
					$pathToPicture = $newfile;
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
				$name = pathinfo($filename, PATHINFO_FILENAME);
				exec("ffmpeg -i $destinationPath/$filename -ss 1 -vframes 1 $destinationPath/thumbs/$name.jpg");
				$pathToPicture = $destinationPath . '/thumbs/' . $name . '.jpg';
				break;

			default:
				$pathToPicture = 'img/file-icon.png';;
				break;
		}

		return $pathToPicture;
	}

}
