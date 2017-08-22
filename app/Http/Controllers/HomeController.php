<?php

namespace App\Http\Controllers;

use App\Article;
use App\PhotoAlbum;
use DB;

class HomeController extends Controller {

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$materials = null;
		$liked = null;
		$articles = null;
		$photoAlbums = null;

		return view('pages.home', compact('articles', 'photoAlbums'));
	}
}