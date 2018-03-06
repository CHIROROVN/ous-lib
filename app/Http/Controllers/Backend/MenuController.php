<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;

class MenuController extends BackendController
{
	public function index(){
		return view('backend.menu.index');
	}
}