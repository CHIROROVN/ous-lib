<?php namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Models\InfoModel;
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
	   $clsInfo = new InfoModel();		
	   $infos = $clsInfo->getInfo();        
	   return view('frontend.homepage.index',$infos);
	}
	

}
