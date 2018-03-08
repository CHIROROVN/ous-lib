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
	   $infos = $clsInfo->getInfoHomepage();	      
	   return view('frontend.homepage.index',compact('infos'));
	}

	public function guide()
	{         
	   return view('frontend.homepage.guide');
	}	
	public function guideDetail($id)
	{	     
	         
	   return view('frontend.homepage.guidedetail',compact('id'));
	}
	public function guidebooks()
	{         
	   return view('frontend.homepage.guidebooks');
	}	
	public function links()
	{         
	   return view('frontend.homepage.links');
	}	
	public function inquire()
	{         
	   return view('frontend.homepage.inquire');
	}	
	public function zousyo()
	{         
	   return view('frontend.homepage.zousyo');
	}	
	public function db()
	{         
	   return view('frontend.homepage.db');
	}
	

}
