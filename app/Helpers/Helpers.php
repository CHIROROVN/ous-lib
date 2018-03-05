<?php
use Illuminate\Routing\Route;
use Illuminate\Http\Request;

if (!function_exists('curr_page')) {

    function curr_page()
    {
    	$name_page = \Request::route()->getName();
    	$arr_page = explode('.', $name_page);
    	return $arr_page[1];
    }
}

if (!function_exists('dt_format')) {

    function dt_format($date_time, $comma='-')
    {
    	if(!empty($date_time)){
    		return date('Y'.$comma.'m'.$comma.'d H:i', strtotime($date_time));
    	}
    	return $date_time;
    }
}
