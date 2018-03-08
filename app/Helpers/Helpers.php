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
if (!function_exists('c2digit')) {
    /**
     * description
     *
     * @param
     * @return
     */
    function c2digit($num)
    {
        if(!empty($num)){
            //return sprintf("%02d", $num);
            return str_pad($num, 2,'0',STR_PAD_LEFT);
        }else{
            return $num;
        }
    }
}
if (!function_exists('check_date')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function check_date($start, $end)
    {
        $now = Carbon::now();
        if($start <= $now && ($end >= $now || empty($end)) || empty($start) && ($end >= $now || empty($end)) ){
            return '○';
        }else{
                return '-';
            }
        }
}
if (!function_exists('format_date')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function format_date($date, $comm='/')
    {
        if(!empty($date)){
            return date('Y'.$comm.'m'.$comm.'d', strtotime($date));
        }else{
            return '';
        }
    }
}
if (!function_exists('japan_date')) {
    /**
     * description
     *
     * @param
     * @return
     */
    function japan_date($date)
    {
        if(!empty($date)){
            $year = date('Y', strtotime($date));
            $month = (int) date('m', strtotime($date)) + 0;
            $day = (int) date('d', strtotime($date)) + 0;
           return $year .'年' . $month . '月' . $day . '日';
        }else{
            return '';
        }
    }
}
if (!function_exists('dateJp')) {
    /**
     * description
     *
     * @param
     * @return
     */
    function dateJp($date)
    {
        if(!empty($date)){
            $year = date('Y', strtotime($date));
            $month = (int) date('m', strtotime($date)) + 0;
            $day = (int) date('d', strtotime($date)) + 0;
            $hour = (int) date('H', strtotime($date)) + 0;
            $minute = (int) date('i', strtotime($date)) + 0;
           return $year .'年' . $month . '月' . $day . '日' . '  ' . $hour .'時' . $minute . '分';
        }else{
            return '';
        }
    }
}
if (!function_exists('split_date')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function split_date($date, $param)
    {
        if(!empty($date)){
            switch ($param) {
                case 'Y':
                    return date('Y', strtotime($date));
                    break;
                case 'm':
                    return date('m', strtotime($date));
                    break;
                case 'd':
                    return date('d', strtotime($date));
                    break;
                case 'H':
                    return date('H', strtotime($date));
                    break;
                case 'i':
                    return date('i', strtotime($date));
                    break;
                case 's':
                    return date('s', strtotime($date));
                    break;
                default:
                    return $date;
                    break;
            }
        }else{
            return '';
        }
    }
}