<?php namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Frontend\FrontendController;
use Html;
use Input;
use Config;

class HomeController extends FrontendController {	

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{	             
	   return view('frontend.homepage.index');
	}
	

}
