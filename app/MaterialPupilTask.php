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
    /**
     * Get the pupil task's materials.
     *
     * @return Material
     */
    public function materials()
    {
        return $this->belongsToMany('App\Material');
    }
}
