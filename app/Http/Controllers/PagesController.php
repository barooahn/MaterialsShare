<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {

    public function welcome()
    {
        return view('pages.welcome');
    }

    public function startHere()
    {
        return view('pages.start_here');
    }
    public function author()
    {
        return view('pages.author');
    }
    public function content()
    {
        return view('pages.content');
    }
    public function helpYou()
    {
        return view('pages.help_you');
    }
    public function services()
    {
        return view('pages.services');
    }
    public function why()
    {
        return view('pages.why');
    }

    public function contact()
    {
        return view('pages.contact');
    }

}