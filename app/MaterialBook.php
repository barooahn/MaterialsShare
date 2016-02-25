<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialBook extends Model
{

    protected $table = 'material_books';

    protected $fillable = ['book', 'slug'];

    protected $sluggable = [
        'build_from' => 'book',
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
        return $this->hasMany('App\Material');
    }

}
