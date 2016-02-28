<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\MaterialRequest;
use App\Material;
use App\MaterialActivityUse;
use App\MaterialBook;
use App\MaterialCategory;
use App\MaterialFile;
use App\MaterialLanguageFocus;
use App\MaterialLevel;
use App\MaterialPupilTask;
use App\Options;
use Conner\Likeable\LikeableTrait;
use DB;
use Ghanem\Rating\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Response;
use Session;
use Validator;
use Illuminate\Pagination\Paginator;

class MaterialsController extends Controller
{

    use LikeableTrait;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'search', 'postFilter']]);
        $this->middleware('activated', ['except' => ['index', 'show', 'search', 'postFilter']]);
    }

    public function index($materials = null)
    {
        if ($materials == null) {

            $materials = Material::where('private', 0)
                ->orderBy('updated_at', 'desc')
                ->paginate(Material::$paginate);
        }

        $categories = MaterialCategory::lists('category', 'category');
        $levels = MaterialLevel::lists('level', 'level');
        $language_focuses = MaterialLanguageFocus::lists('language_focus', 'language_focus');
        $activity_uses = MaterialActivityUse::lists('activity_use', 'activity_use');
        $pupil_tasks = MaterialPupilTask::lists('pupil_task', 'pupil_task');
        $books = ['' => ''] + MaterialBook::lists('book', 'book')->all();


        return view('material.index',
            compact('materials', 'categories', 'levels',
                'language_focuses', 'activity_uses', 'pupil_tasks', 'books'));

    }

    public function show($slug)
    {

        $material = Material::findBySlugOrIdOrFail($slug);
        $stars = $this->showStars($material->id);

        if (!Auth::user()) {
            Session::flash('warning', 'You are not logged in.  Login to download, edit and save materials');
        }
        return view('material.view', compact('material', 'stars'));
    }

    public function showStars($id)
    {
        $material = Material::findBySlugOrIdOrFail($id);
        return $material->averageRating();
    }

    public function getEditOptions($id)
    {
        $material = Material::findBySlugOrIdOrFail($id);
        $options_empty = [];
        $options_complete = [];
        $options = Options::all();

        $levels = $material->levels()->get();
        $option = Options::where('option', '=', 'level')->first();
        if ($levels->count()) {
            $options_complete['level'] = $option->description;
        } else {
            $options_empty['level'] = $option->description;
        }

        $language_focuses = $material->languageFocuses()->get();
        $option = Options::where('option', '=', 'language_focus')->first();
        if ($language_focuses->count()) {
            $options_complete['language_focus'] = $option->description;
        } else {
            $options_empty['language_focus'] = $option->description;
        }

        $files = $material->files()->get();
        $option = Options::where('option', '=', 'files')->first();
        if ($files->count()) {
            $options_complete['files'] = $option->description;
        } else {
            $options_empty['files'] = $option->description;
        }

        $activity_uses = $material->activityUses()->get();
        $option = Options::where('option', '=', 'activity_use')->first();
        if ($activity_uses->count()) {
            $options_complete['activity_use'] = $option->description;
        } else {
            $options_empty['activity_use'] = $option->description;
        }

        $pupil_tasks = $material->pupilTasks()->get();
        $option = Options::where('option', '=', 'pupil_task')->first();
        if ($pupil_tasks->count()) {
            $options_complete['pupil_task'] = $option->description;
        } else {
            $options_empty['pupil_task'] = $option->description;
        }

        $categories = $material->categories()->get();
        $option = Options::where('option', '=', 'category')->first();
        if ($categories->count()) {
            $options_complete['category'] = $option->description;
        } else {
            $options_empty['category'] = $option->description;
        }

        $books = $material->book()->get();
        $option = Options::where('option', '=', 'book')->first();

        if ($books->count()) {
            $options_complete['book'] = $option->description;
        } else {
            $options_empty['book'] = $option->description;
        }

        $material = $material->getAttributes();
        foreach ($material as $key => $value) {
            $option = Options::where('option', '=', $key)->first();
            if ($value == null) {
                if ($option) {
                    $options_empty[$option->option] = $option->description;
                }
            } else {
                if ($option) {
                    $options_complete[$option->option] = $option->description;
                }
            }
        }

        return view('material.edit_options',
            compact('material', 'options_empty', 'options_complete', 'options'));
    }

    // Material edit page
    public function postEditOptions($id, Request $request)
    {
        $options = $request->all();
        $material = Material::findBySlugOrIdOrFail($id);
        $categories = MaterialCategory::lists('category', 'category');
        $levels = MaterialLevel::lists('level', 'level');
        $language_focuses = MaterialLanguageFocus::lists('language_focus', 'language_focus');
        $activity_uses = MaterialActivityUse::lists('activity_use', 'activity_use');
        $pupil_tasks = MaterialPupilTask::lists('pupil_task', 'pupil_task');
        $books = MaterialBook::lists('book', 'book');

        return view('material.edit',
            compact('material', 'options', 'categories', 'levels',
                'language_focuses', 'activity_uses', 'pupil_tasks', 'books'));
    }

    public function store(MaterialRequest $request)
    {
        // make new material
        $material = Material::create();
        $material->user_id = Auth::user()->id;
        $material->private = 0;

        if (isset($request->title)) {
            $material->title = trim(ucwords($request->title));
            $material->slug = str_slug($request->title, '-');
        }
        if (isset($request->objective)) {
            $material->objective = trim(ucfirst(strtolower($request->objective)));
        }
        if (isset($request->target_language)) {
            $material->target_language = trim(ucfirst(strtolower($request->target_language)));
        }
        if (isset($request->time_needed_prep)) {
            $material->time_needed_prep = $request->time_needed_prep;
        } else {
            $material->time_needed_prep = 0;
        }
        if (isset($request->time_needed_class)) {
            $material->time_needed_class = $request->time_needed_class;
        } else {
            $material->time_needed_class = 0;
        }
        if (isset($request->materials)) {
            $material->materials = trim(ucfirst(strtolower($request->materials)));
        }
        if (isset($request->procedure_before)) {
            $material->procedure_before = trim(ucfirst($request->procedure_before));
        }
        if (isset($request->procedure_in)) {
            $material->procedure_in = trim(ucfirst($request->procedure_in));
        }

        // store files
        $dir = Auth::user()->username;
        $path = public_path() . '/users/' . $dir;

        $empty = (count(glob("$path/*")) === 0) ? true : false;

        if (!$empty) {
            $files = [];
            foreach (glob("$path/*") as $filename) {
                array_push($files, $filename);
            }

            MaterialFile::store($files, $material);
        }

        if (isset($request->category_list)) {
            // add category to categories table
            foreach ($request->Input('category_list') as $category) {


                $material_category = Auth::user()->material_category()->firstOrCreate([
                    'category' => title_case($category),
                    'slug' => str_slug($category, '-')
                ]);

                // add category to users pivot
                $material_category->users()->attach($request->input('id'));

                // add category to materials pivot table category / material
                //$material_category->materials()->attach($material->id);
                $material->categories()->attach($material_category->id);
            }
        }
        if (isset($request->level)) {
            foreach ($request->level as $level) {

                $material_level = MaterialLevel::firstOrCreate([
                    'level' => title_case($level),
                    'slug' => str_slug($level, '-')
                ]);

                // add level to materials pivot
                $material->levels()->attach($material_level->id);
            }
        }

        if (isset($request->language_focus)) {
            //add language focuses to material_language_focuses database
            foreach ($request->language_focus as $lf) {
                $material_language_focus = MaterialLanguageFocus::firstOrCreate([
                    'language_focus' => title_case($lf),
                    'slug' => str_slug($lf, '-')
                ]);

                // add language focus to materials pivot
                $material->languageFocuses()->attach($material_language_focus->id);
            }
        }

        if (isset($request->activity_use)) {
            //add activity use to material_activity_uses database
            foreach ($request->activity_use as $au) {
                $material_activity_use = MaterialActivityUse::firstOrCreate([
                    'activity_use' => title_case($au),
                    'slug' => str_slug($au, '-')
                ]);

                // add activity use to materials pivot
                $material->activityUses()->attach($material_activity_use->id);

            }
        }

        if (isset($request->pupil_task)) {
            //add pupil task to material_pupil_tasks database
            foreach ($request->pupil_task as $pt) {
                $material_pupil_task = MaterialPupilTask::firstOrCreate([
                    'pupil_task' => title_case($pt),
                    'slug' => str_slug($pt, '-')
                ]);


                // add pupil task use to materials pivot
                $material->pupilTasks()->attach($material_pupil_task->id);
            }
        }
        if (isset($request->book)) {
            $book = MaterialBook::firstOrCreate([
                'book' => $request->book[0],
                'slug' => str_slug($request->book[0], '-')
            ]);
            $material->book_id = $book->id;
        }

        if (isset($request->page)) {
            $material->page = trim($request->page);
        }

        if (isset($request->follow_up)) {
            //update material
            $material->follow_up = trim(ucfirst($request->follow_up));
        }
        if (isset($request->variations)) {
            $material->variations = trim(ucfirst($request->variations));
        }
        if (isset($request->tips)) {
            $material->tips = trim(ucfirst($request->tips));
        }
        if (isset($request->notes)) {
            $material->notes = trim(ucfirst($request->notes));
        }
        $material->update();

        return redirect()->action('Admin\UserController@home');
    }

    public function update(MaterialRequest $request, Material $material)
    {
        // Update material

        if (isset($request->title)) {
            $material->title = ucwords($request->title);
            $material->slug = str_slug($request->title, '-');
        }
        if (isset($request->objective)) {
            $material->objective = ucfirst(strtolower($request->objective));
        }
        if (isset($request->target_language)) {
            $material->target_language = ucfirst(strtolower($request->target_language));
        }
        if (isset($request->time_needed_prep)) {
            $material->time_needed_prep = $request->time_needed_prep;
        }
        if (isset($request->time_needed_class)) {
            $material->time_needed_class = $request->time_needed_class;
        }
        if (isset($request->materials)) {
            $material->materials = ucfirst(strtolower($request->materials));
        }
        if (isset($request->procedure_before)) {
            $material->procedure_before = ucfirst($request->procedure_before);
        }
        if (isset($request->procedure_in)) {
            $material->procedure_in = ucfirst($request->procedure_in);
        }

        // store files
        $dir = Auth::user()->username;
        $path = public_path() . '/users/' . $dir;

        $empty = (count(glob("$path/*")) === 0) ? true : false;

        if (!$empty) {
            $files = [];
            foreach (glob("$path/*") as $filename) {
                array_push($files, $filename);
            }

            MaterialFile::store($files, $material);
        }

        if (isset($request->category_list)) {
            // add category to categories table
            $categoryIds = [];
            //find or create new categories on material_category table
            foreach ($request->Input('category_list') as $category) {
                $material_category = Auth::user()->material_category()->firstOrCreate([
                    'category' => title_case($category),
                    'slug' => str_slug($category, '-')
                ]);
                array_push($categoryIds, $material_category->id);
                // update category to materials pivot table category / material

            }
            $material->categories()->sync($categoryIds);
        }
        if (isset($request->level)) {
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
        }

        if (isset($request->language_focus)) {
            //add language focuses to material_language_focuses database
            $language_focusIds = [];
            foreach ($request->language_focus as $lf) {
                $material_language_focus = MaterialLanguageFocus::firstOrCreate([
                    'language_focus' => title_case($lf),
                    'slug' => str_slug($lf, '-')
                ]);
                array_push($language_focusIds, $material_language_focus->id);
            }
            // update language focus to materials pivot
            $material->languageFocuses()->sync($language_focusIds);
        }

        if (isset($request->activity_use)) {
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
        }

        if (isset($request->pupil_task)) {
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
        }

        if (isset($request->book)) {
            $book = MaterialBook::firstOrCreate([
                'book' => $request->book[0],
                'slug' => str_slug($request->book[0], '-')
            ]);
            $material->book_id = $book->id;
        }

        if (isset($request->page)) {
            $material->page = $request->page;
        }

        if (isset($request->follow_up)) {
            //update material
            $material->follow_up = ucfirst($request->follow_up);
        }
        if (isset($request->variations)) {
            $material->variations = ucfirst($request->variations);
        }
        if (isset($request->tips)) {
            $material->tips = ucfirst($request->tips);
        }
        if (isset($request->notes)) {
            $material->notes = ucfirst($request->notes);
        }
        $material->update();

        return redirect()->action('Admin\UserController@home');
    }

    public function destroy(Material $material, $id)
    {
        $material = Material::findOrFail($id);
        if (count($material->files) > 0) {
            foreach ($material->files as $file) {

                MaterialFileController::destroyFile($file->filename);
                $thumb = 'thumbs/' . pathinfo($file->filename, PATHINFO_FILENAME) . '.jpg';
                MaterialFileController::destroyFile($thumb);
            }
        }

        $material->delete();

        Session::flash('success', $material->slug . ' successfully deleted!');

        return redirect()->action('Admin\UserController@home');

    }

    public function addLike($id)
    {

        $material = Material::findOrFail($id);

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

    public function getDownload($file)
    {
        return MaterialFile::download($file);
    }

    public function addStars(Request $request)
    {
        $user = Auth::User();
        $material = Material::findBySlugOrIdOrFail($request->id);


        if ($rating = Rating::where('author_id', '=', $user->id)
            ->where('ratingable_id', '=', $material->id)->first()
        ) {
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
        if ($material->private == 0) {
            $material->private = 1;
            Session::flash('success', $material->title . ' made private!');
        } else {
            $material->private = 0;
            Session::flash('success', $material->title . ' made public!');
        }
        $material->update();
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $materials = Material::where('private', 0)->search($request->material_search)
            ->paginate(Material::$paginate);

        $categories = MaterialCategory::lists('category', 'category');
        $levels = MaterialLevel::lists('level', 'level');
        $language_focuses = MaterialLanguageFocus::lists('language_focus', 'language_focus');
        $activity_uses = MaterialActivityUse::lists('activity_use', 'activity_use');
        $pupil_tasks = MaterialPupilTask::lists('pupil_task', 'pupil_task');
        $books = ['' => ''] + MaterialBook::lists('book', 'book')->all();

        return view('material.index',
            compact('materials', 'options', 'categories', 'levels',
                'language_focuses', 'activity_uses', 'pupil_tasks', 'books'));

    }

    public function feedback(Request $request)
    {

        Mail::queue('emails.feedback', [
            'topic' => $request->get('topic'),
            'feedback' => $request->get('feedback'),
            'username' => Auth::user()->name,
            'email' => Auth::user()->email,
        ], function ($message) {
            $message->from(Auth::user()->email, "Materials Share");
            $message->subject("Materials Share - feedback");
            $message->to('barooahn@gmail.com');
        });

        Session::flash('success', "Your feed back has been sent thanks.
                If you require a response please give us up to 48 hours to reply.");
        return \Redirect::route('contact');
    }

    protected function getModelValueAttribute($name)
    {
        $value = parent::getModelValueAttribute($name);

        return ($value instanceof Collection) ? $value->modelKeys() : $value;
    }

    protected function getOptions()
    {
        $options = Options::all();
        return view('material.options', compact('options'));
    }

    protected function postOptions(Request $request)
    {

        $categories = '';
        $levels = '';
        $language_focuses = '';
        $activity_uses = '';
        $pupil_tasks = '';
        $books = '';

        $options = $request->all();

        foreach ($options as $option => $value) {

            switch ($option) {
                case 'category':
                    $categories = MaterialCategory::lists('category', 'category');
                    break;
                case 'level':
                    $levels = MaterialLevel::lists('level', 'level');
                    break;
                case 'language_focus':
                    $language_focuses = MaterialLanguageFocus::lists('language_focus', 'language_focus');
                    break;
                case 'activity_use':
                    $activity_uses = MaterialActivityUse::lists('activity_use', 'activity_use');
                    break;
                case 'pupil_task':
                    $pupil_tasks = MaterialPupilTask::lists('pupil_task', 'pupil_task');
                    break;
                case 'book':
                    $books = MaterialBook::lists('book', 'book');
                    break;

            }
        }
        return view('material.create_form',
            compact('options', 'categories', 'levels',
                'language_focuses', 'activity_uses', 'pupil_tasks', 'books'));
    }

    public function postFilter(Request $request)
    {

        $query = Material::with('categories', 'levels', 'languageFocuses', 'activityUses',
            'pupilTasks', 'book'); //names of eager


        if ($request->book)
            $query = $query->whereHas('book', function ($bookQuery) use ($request) {
                $bookQuery->where('book', $request->book);
            });


        if ($request->level) {
            for ($i = 0; $i < count($request->level); $i++) {
                $query = $query->whereHas('levels', function ($levelQuery) use ($request, $i) {
                    $levelQuery->where('level', $request->level[$i]);
                });
            }
        }

        if ($request->category_list) {
            for ($i = 0; $i < count($request->category_list); $i++) {
                $query = $query->whereHas('categories', function ($categoryQuery) use ($request, $i) {
                    $categoryQuery->where('category', $request->category_list[$i]);
                });
            }
        }

        if ($request->language_focus) {
            for ($i = 0; $i < count($request->language_focus); $i++) {
                $query = $query->whereHas('languageFocuses', function ($focusQuery) use ($request, $i) {
                    $focusQuery->where('language_focus', $request->language_focus[$i]);
                });
            }
        }

        if ($request->activity_use) {
            for ($i = 0; $i < count($request->activity_use); $i++) {
                $query = $query->whereHas('activityUses', function ($activityQuery) use ($request, $i) {
                    $activityQuery->where('activity_use', $request->activity_use[$i]);
                });
            }
        }

        if ($request->pupil_task) {
            for ($i = 0; $i < count($request->pupil_task); $i++) {
                $query = $query->whereHas('pupilTasks', function ($pupilQuery) use ($request, $i) {
                    $pupilQuery->where('pupil_task', $request->pupil_task[$i]);
                });
            }
        }

        if ($request->time_needed_class) {
            $class = explode(',', $request->time_needed_class);

            $query = $query->whereBetween('time_needed_class', $class);
        }

        if ($request->time_needed_prep) {
            $prep = explode(',', $request->time_needed_prep);

            $query = $query->whereBetween('time_needed_prep', $prep);
        }

        $materials = $query->paginate(Material::$paginate);// make the query and load the data

        $categories = MaterialCategory::lists('category', 'category');
        $levels = MaterialLevel::lists('level', 'level');
        $language_focuses = MaterialLanguageFocus::lists('language_focus', 'language_focus');
        $activity_uses = MaterialActivityUse::lists('activity_use', 'activity_use');
        $pupil_tasks = MaterialPupilTask::lists('pupil_task', 'pupil_task');
        $books = ['' => ''] + MaterialBook::lists('book', 'book')->all();

        return view('material.index',
            compact('materials', 'categories', 'levels',
                'language_focuses', 'activity_uses', 'pupil_tasks', 'books'));
    }

}
