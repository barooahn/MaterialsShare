<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialLanguageFocus extends Model
{
    protected $table = 'material_language_focuses';

    protected $fillable = ['language_focus', 'slug'];

    protected $sluggable = [
        'build_from' => 'language_focus',
        'save_to'    => 'slug',
    ];

    /**
     * Get the language focuses' materials.
     *
     * @return Materials
     */
    public function materials()
    {
        return $this->belongsToMany('App\Material');
    }
}
