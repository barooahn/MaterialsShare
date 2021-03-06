<?php

namespace App;

use App\Http\Controllers\MaterialBuilder;
use Illuminate\Database\Eloquent\Model;

class MaterialActivityUse extends Model
{
    protected $fillable = ['activity_use', 'slug'];

    protected $sluggable = [
        'build_from' => 'activity_use',
        'save_to'    => 'slug',
    ];

    protected $touches = ['materials'];
    /**
     * Get the activity use's material.
     *
     * @return Materials
     */
    public function materials()
    {
        return $this->belongsToMany('App\Material',
            'material_material_activity_use', 'activity_use_id', 'material_id');
    }
}
