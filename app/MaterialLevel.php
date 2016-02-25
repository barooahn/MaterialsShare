<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialLevel extends Model
{
    protected $fillable = ['level', 'slug'];

    protected $sluggable = [
        'build_from' => 'level',
        'save_to'    => 'slug',
    ];

    protected $touches = ['materials'];
    /**
     * Get the level's materials.
     *
     * @return Material
     */
    public function materials()
    {
        return $this->belongsToMany('App\Material');
    }
}
