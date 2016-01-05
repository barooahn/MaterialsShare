<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Material;
use App\MaterialActivityUse;
use App\MaterialCategory;
use App\MaterialFile;
use App\MaterialLanguageFocus;
use App\MaterialLevel;
use App\MaterialPupilTask;
use Conner\Likeable\LikeableTrait;
use Ghanem\Rating\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use Session;
use Validator;


class MaterialsController extends Controller
{

    use LikeableTrait;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('activated', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $materials = Material::where('private', 0)
            ->orderBy('updated_at', 'desc')
            ->paginate(Material::$paginate );

        return view('material.index', compact('materials'));
    }

    public function show($slug)
    {
        $material = Material::findBySlugOrIdOrFail($slug);
        $stars = $this->showStars($material->id);
        return view('material.view', compact('material', 'stars'));
    }

    public function showStars($id)
    {
        $material = Material::findBySlugOrIdOrFail($id);
        return $material->averageRating();
    }


    // Material edit page

    public function create()
    {
        $categories = MaterialCategory::lists('category', 'category');
        return view('material.create', compact('categories'));
    }

    public function edit(Material $material)
    {
        return view('material.edit', compact('material'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_list' => 'required'
        ]);

        // make new material

        $material = Material::Create(['user_id' => Auth::user()->id]);

        // add category to categories table
        foreach ($request->Input('category_list') as $category) {


            $material_category = Auth::user()->material_category()->firstOrCreate([
                'category' => title_case($category),
                'slug' => str_slug($category, '-')
            ]);

            // add category to users pivot
            $material_category->users()->attach($request->input('id'));

            // add category to materials pivot table category / material
            $material->categories()->attach($material_category->id);
        }
        $request->session()->put('material', $material);
        //  go to next step

        return redirect()->action('MaterialsController@createTitle');
    }

    public function editCategory($id)
    {
        $material = Material::with(['categories'])->findOrFail($id);
        $categories = MaterialCategory::lists('category', 'category');
        return view('material.edit_category', compact('material', 'categories'));
    }

    public function updateCategory(Request $request, $id)
    {
        $this->validate($request, [
            'category_list' => 'required'
        ]);
        $material = Material::findBySlugOrId($id);

        $categoryIds = [];
        //find or create new categories on material_category table
        foreach ($request->Input('category_list') as $category) {

            $material_category = Auth::user()->material_category()->firstOrCreate([
                'category' => title_case($category),
                'slug' => str_slug($category, '-')
            ]);

            array_push($categoryIds, $material_category->id);

            // update category to materials pivot table category / material
            $material->categories()->sync($categoryIds);
        }
        $request->session()->put('material', $material);
        Session::flash('success', $material->slug . ' successfully updated!');


        return view('material.view', ['material' => $request->session()->get('material')]);

    }

    public function createTitle(Request $request)
    {
        return view('material.create_title', ['material' => $request->session()->get('material')]);
    }

    public function storeTitle(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:materials|max:255',
            'objective' => 'required'
        ]);

        $material = $request->session()->get('material');

        //update material
        $material->title = ucfirst($request->title);
        $material->slug = str_slug($request->title, '-');
        $material->objective = ucfirst($request->objective);

        $material->update();
        $request->session()->get('material')->update($material->toArray());

        return redirect()->action('MaterialsController@createLevel');
    }

    public function editTitle($id)
    {
        $material = Material::findBySlugOrId($id);
        return view('material.edit_title', compact('material'));
    }

    public function updateTitle(Request $request, $id)
    {

        $material = Material::findBySlugOrIdOrFail($request->id);

        //$material = $request->session()->get('material');

        //update material
        $material->title = ucfirst($request->title);
        $material->slug = str_slug($request->title, '-');
        $material->objective = ucfirst($request->objective);

        $material->update();
        Session::flash('success', $material->slug . ' successfully updated!');
        return view('material.view', compact('material'));
    }

    public function createTimes(Request $request)
    {
        return view('material.create_times', ['material' => $request->session()->get('material')]);
    }

    public function storeTimes(Request $request)
    {

        $this->validate($request, [
            'target_language' => 'required|max:200',
            'time_needed_prep' => 'required|numeric|max:200',
            'time_needed_class' => 'required|numeric|max:200',
            'materials' => 'required',
            'procedure_before' => 'required',
            'procedure_in' => 'required',
        ]);

        //find current material request->material
        $material = $request->session()->get('material');

        $material->target_language = ucfirst($request->target_language);
        $material->time_needed_prep = $request->time_needed_prep;
        $material->time_needed_class = $request->time_needed_class;
        $material->materials = ucfirst($request->materials);
        $material->procedure_before = ucfirst($request->procedure_before);
        $material->procedure_in = ucfirst($request->procedure_in);

        $material->update();

        // getting all of the post data
        if ($request->images) {
            $files = $request->images;
            // Making counting of uploaded images
            $file_count = count($files);
            // start count how many uploaded
            $uploadcount = 0;
            foreach ($files as $file) {
                $this->validate($request, [
                    'file' => 'mimes:png,gif,jpeg,txt,pdf,doc,docx,xls,xlsx,mp4,mov,ogg,qt,ppt,pptx,wmv
                    |max:60000|unique:material_files'
                ]);
                $destinationPath = 'uploads';
                $filename = $material->slug.str_replace(' ', '_', $file->getClientOriginalName());
                $file->move($destinationPath, $filename);
                $uploadcount++;

                //add pictuer for file and get path
                $thumbPath = Material::getExtensionType($file, $destinationPath, $filename);

                //add file path and thumb path to material_files database

                $material_file = MaterialFile::firstOrCreate([
                    'file_path' => $destinationPath,
                    'filename' => $material->updated_at.$filename,
                    'thumb_path' => $thumbPath
                ]);

                //add to material file table
                $material->files()->save($material_file);

            }
            if ($uploadcount == $file_count) {
                Session::flash('success', 'Upload(s) successfully');
            } else {
                return Redirect::to('material.create_times')->withInput();
            }
        }
        $request->session()->get('material')->update($material->toArray());
        return redirect()->action('MaterialsController@createOptional');

    }

    public function editTimes($id)
    {
        $material = Material::findBySlugOrId($id);
        return view('material.edit_times', compact('material'));
    }

    public function updateTimes(Request $request, $id)
    {
        $this->validate($request, [
            'target_language' => 'required|max:200',
            'time_needed_prep' => 'required|numeric|max:200',
            'time_needed_class' => 'required|numeric|max:200',
            'materials' => 'required',
            'procedure_before' => 'required',
            'procedure_in' => 'required',
        ]);

        //find current material request->material
        $material = $request->session()->get('material');

        $material->target_language = ucfirst($request->target_language);
        $material->time_needed_prep = $request->time_needed_prep;
        $material->time_needed_class = $request->time_needed_class;
        $material->materials = ucfirst($request->materials);
        $material->procedure_before = ucfirst($request->procedure_before);
        $material->procedure_in = ucfirst($request->procedure_in);

        $material->update();

        $request->session()->get('material')->update($material->toArray());
        return view('material.view', ['material' => $request->session()->get('material')]);
    }

    public function editFile($id)
    {
        $material = Material::findBySlugOrId($id);
        return view('material.edit_file', compact('material'));
    }

    public function updateFile(Request $request, $id)
    {

        $material = Material::findBySlugOrIdOrFail($id);
        // getting all of the post data
        if ($request->images) {
            $files = $request->images;
            // Making counting of uploaded images
            $file_count = count($files);
            // start count how many uploaded
            $uploadcount = 0;
            foreach ($files as $file) {
                $this->validate($request, [
                    'file' => 'mimes:png,gif,jpeg,txt,pdf,doc,docx,xls,xlsx,mp4,mov,ogg,qt,ppt,pptx,wmv | max:60000|unique:material_files'
                ]);
                $destinationPath = 'uploads';
                $filename = $material->slug.str_replace(' ', '_', $file->getClientOriginalName());
                $file->move($destinationPath, $filename);
                $uploadcount++;

                //add picture for file and get path
                $thumbPath = Material::getExtensionType($file, $destinationPath, $filename);

                //add file path and thumb path to material_files database

                $material_file = MaterialFile::firstOrCreate([
                    'file_path' => $destinationPath,
                    'filename' => $filename,
                    'thumb_path' => $thumbPath
                ]);

                //add to material file table
                $material->files()->save($material_file);

            }
            if ($uploadcount == $file_count) {
                Session::flash('success', 'Upload(s) successfully');
            } else {
                return Redirect::to('material.edit_file')->withInput()->with($id);
            }
        }
        return view('material.view', compact('material'));
    }

    public function destroyFile($file)
    {

        $file = MaterialFile::findorfail($file);
        $material = Material::findBySlugOrIdOrFail($file->material_id);
        $filename = $file->filename;
        $path = public_path() . '/' . $file->file_path;
        if (!$file->delete($path . $filename)) {
            Session::flash('success', 'ERROR deleted the File!');
        } else {
            $file->delete();
            Session::flash('success', 'Successfully deleted the File!');
        }
        return view('material.edit_file', compact('material'));
    }

    public function createLevel(Request $request)
    {
        //get models to send to view
        $levels = MaterialLevel::lists('level', 'level');
        $language_focuses = MaterialLanguageFocus::lists('language_focus', 'language_focus');
        $activity_uses = MaterialActivityUse::lists('activity_use', 'activity_use');
        $pupil_tasks = MaterialPupilTask::lists('pupil_task', 'pupil_task');

        return view('material.create_level', [
            'material' => $request->session()->get('material'),
            'levels' => $levels,
            'language_focuses' => $language_focuses,
            'activity_uses' => $activity_uses,
            'pupil_tasks' => $pupil_tasks
        ]);
    }

    public function storeLevel(Request $request)
    {

        $this->validate($request, [
            'level' => 'required|max:55',
            'language_focus' => 'required|max:55',
            'activity_use' => 'required|max:55',
            'pupil_task' => 'required|max:55',
        ]);
        //find current material = request->material
        $material = $request->session()->get('material');

        //add levels to material_levels database

        foreach ($request->level as $level) {

            $material_level = MaterialLevel::firstOrCreate([
                'level' => title_case($level),
                'slug' => str_slug($level, '-')
            ]);

            // add level to materials pivot
            $material->levels()->attach($material_level->id);
        }

        //add language focuses to material_language_focuses database
        foreach ($request->language_focus as $lf) {
            $material_language_focus = MaterialLanguageFocus::firstOrCreate([
                'language_focus' => title_case($lf),
                'slug' => str_slug($lf, '-')
            ]);


            // add language focus to materials pivot
            $material->languageFocuses()->attach($material_language_focus->id);
        }

        //add activity use to material_activity_uses database
        foreach ($request->activity_use as $au) {
            $material_activity_use = MaterialActivityUse::firstOrCreate([
                'activity_use' => title_case($au),
                'slug' => str_slug($au, '-')
            ]);


            // add activity use to materials pivot
            $material->activityUses()->attach($material_activity_use->id);

        }

        //add pupil task to material_pupil_tasks database
        foreach ($request->pupil_task as $pt) {
            $material_pupil_task = MaterialPupilTask::firstOrCreate([
                'pupil_task' => title_case($pt),
                'slug' => str_slug($pt, '-')
            ]);


            // add pupil task use to materials pivot
            $material->pupilTasks()->attach($material_pupil_task->id);
        }

        $material->private = 0;
        $material->update();
        $request->session()->get('material')->update($material->toArray());

        return redirect()->action('MaterialsController@createTimes');
    }

    public function editLevel($id)
    {
        $material = Material::with(['levels', 'languageFocuses', 'activityUses', 'pupilTasks'])->findOrFail($id);
        //get models to send to view
        $levels = MaterialLevel::lists('level', 'level');
        $language_focuses = MaterialLanguageFocus::lists('language_focus', 'language_focus');
        $activity_uses = MaterialActivityUse::lists('activity_use', 'activity_use');
        $pupil_tasks = MaterialPupilTask::lists('pupil_task', 'pupil_task');

        return view('material.edit_level', [
            'material' => $material,
            'levels' => $levels,
            'language_focuses' => $language_focuses,
            'activity_uses' => $activity_uses,
            'pupil_tasks' => $pupil_tasks
        ]);

    }

    public function updateLevel(Request $request, $id)
    {
        $this->validate($request, [
            'level' => 'required|max:55',
            'language_focus' => 'required|max:55',
            'activity_use' => 'required|max:55',
            'pupil_task' => 'required|max:55',
        ]);
        //find current material = request->material
        $material = Material::findBySlugOrId($id);

        //add levels to material_levels database

        $levelIds = [];

        foreach ($request->Input('level') as $level) {

            $material_level = MaterialLevel::firstOrCreate([
                'level' => title_case($level),
                'slug' => str_slug($level, '-')
            ]);

            array_push($levelIds, $material_level->id);
        }

        // update level on materials pivot


        $material->levels()->sync($levelIds);

        //add or find language focuses to material_language_focuses database
        $language_foucusIds = [];
        foreach ($request->language_focus as $lf) {
            $material_language_focus = MaterialLanguageFocus::firstOrCreate([
                'language_focus' => title_case($lf),
                'slug' => str_slug($lf, '-')
            ]);

            array_push($language_foucusIds, $material_language_focus->id);
        }

        // update language focus to materials pivot
        $material->languageFocuses()->sync($language_foucusIds);


        //add activity use to material_activity_uses database
        $activity_useIds = [];
        foreach ($request->activity_use as $au) {
            $material_activity_use = MaterialActivityUse::firstOrCreate([
                'activity_use' => title_case($au),
                'slug' => str_slug($au, '-')
            ]);

            array_push($activity_useIds, $material_activity_use->id);
        }
        // update activity use to materials pivot
        $material->activityUses()->sync($activity_useIds);

        //add pupil task to material_pupil_tasks database
        $pupil_taskIds = [];
        foreach ($request->pupil_task as $pt) {
            $material_pupil_task = MaterialPupilTask::firstOrCreate([
                'pupil_task' => title_case($pt),
                'slug' => str_slug($pt, '-')
            ]);

            array_push($pupil_taskIds, $material_pupil_task->id);

        }
        // add pupil task use to materials pivot
        $material->pupilTasks()->sync($pupil_taskIds);

        $request->session()->put('material', $material);
        Session::flash('success', $material->slug . ' successfully updated!');

        return view('material.view', ['material' => $request->session()->get('material')]);
    }

    public function createOptional(Request $request)
    {
        return view('material.create_optional', ['material' => $request->session()->get('material')]);
    }

    public function storeOptional(Request $request)
    {
        //find current material request->material
        $material = Material::findOrFail($request->material);

        //update material
        $material->follow_up = ucfirst($request->follow_up);
        $material->variations = ucfirst($request->variations);
        $material->tips = ucfirst($request->tips);
        $material->notes = ucfirst($request->notes);

        $material->update();

        return redirect()->action('MaterialsController@show', [$material->slug]);
    }

    public function editOptional($id)
    {
        $material = Material::findBySlugOrId($id);
        return view('material.edit_optional', compact('material'));
    }

    public function updateOptional(Request $request, $id)
    {
        $material = Material::findBySlugOrId($id);

        //$material = $request->session()->get('material');

        //update material
        $material->follow_up = ucfirst($request->follow_up);
        $material->variations = ucfirst($request->variations);
        $material->tips = ucfirst($request->tips);
        $material->notes = ucfirst($request->notes);

        $material->update();
        $request->session()->get('material')->update($material->toArray());
        Session::flash('success', $material->slug . ' successfully updated!');
        return view('material.view', ['material' => $request->session()->get('material')]);
    }

    public function destroy(Material $material)
    {

        $material->delete();

        Session::flash('success', $material->slug . ' successfully deleted!');

        return redirect()->route('material.index');
    }

    public function addLike(Request $request)
    {

        $material = Material::findOrFail($request->material);

        if ($material->liked()) {
            $material->unlike();
        } else {
            $material->like();
        }

        return redirect()->back();
    }

    public function getMaterialListsAttribute()
    {
        return $this->categories->lists('category')->toArray();
    }

    public function getDownload($path, $filename)
    {

        $download = public_path() . '/' . $path . '/' . $filename;
        return Response::download($download);
    }

    public function addStars(Request $request)
    {
        $user = Auth::User();
        $material = Material::findBySlugOrIdOrFail($request->id);



        if ($rating = Rating::where('author_id', '=', $user->id)
            ->where('ratingable_id', '=', $material->id)->first())
        {
            $material->ratingPercent(100);
            $material->updateRating($rating->id, [
                'rating' => $request->stars
            ]);
        } else {

            $material->ratingPercent(100);
            $material->rating([
                'rating' => $request->stars
            ], $user);
        }
        return redirect()->back();
    }

    public function togglePrivate(Request $request)
    {
        $material = Material::findBySlugOrIdOrFail($request->id);
        if($material->private ==0){
            $material->private = 1;
            Session::flash('success', $material->title . ' made private!');
        }else {
            $material->private = 0;
            Session::flash('success', $material->title . ' made public!');
        }
        $material->update();
        return redirect()->back();
    }

    public function search(Request $request){
        $materials = Material::where('private', 0)->search($request->material_search)
            ->paginate(Material::$paginate );

        return view('material.index', compact('materials'));

    }

    protected function getModelValueAttribute($name)
    {
        $value = parent::getModelValueAttribute($name);

        return ($value instanceof Collection) ? $value->modelKeys() : $value;
    }
}
