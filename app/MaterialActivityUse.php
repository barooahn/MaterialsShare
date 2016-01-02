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
    /**
     * Get the activity use's material.
     *
     * @return Materials
     */
    public function materials()
    {
        return $this->belongsToMany('App\Material');
    }
}
