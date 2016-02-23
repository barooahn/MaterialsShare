<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialCategory extends Model
{

	protected $table = 'material_categories';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $guarded  = array('id');

	protected $fillable = ['category', 'slug'];


	/**
	 * Get the categories' materials.
	 *
	 * @return Materials
	 */
	public function materials()
	{
		return $this->belongsToMany('App\Material');
	}

	/**
	 * Get the categories' builders.
	 *
	 * @return MaterialBuilder
	 */
	public function builders()
	{
		return $this->belongsToMany('App\MaterialBuilder');
	}

	/**
	 * Get the categories' users.
	 *
	 * @return Users
	 */
	public function users()
	{
		return $this->belongsToMany('App\User');
	}

	/**
	 * Get the category's language.
	 *
	 * @return Language
	 */
	public function language()
	{
		return $this->belongsTo('App\Language');
	}

	public function scopeCategories($query, $category)
	{
		return $query->where('category', $category);
	}

}
