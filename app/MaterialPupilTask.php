<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialPupilTask extends Model
{

    protected $fillable = ['pupil_task', 'slug'];

    protected $sluggable = [
        'build_from' => 'pupil_task',
        'save_to'    => 'slug',
    ];

    protected $touches = ['materials'];
    /**
     * Get the pupil task's materials.
     *
     * @return Material
     */
    public function materials()
    {
        return $this->belongsToMany('App\Material',
            'material_material_pupil_task', 'pupil_task_id', 'material_id');
    }
}
