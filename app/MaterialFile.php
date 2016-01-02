<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialFile extends Model
{
    //
    protected $fillable = ['file_path', 'filename', 'thumb_path'];

    /**
     * Get the activity use's material.
     *
     * @return Materials
     */
    public function materials()
    {
        return $this->belongsTo('App\Material');
    }

}
