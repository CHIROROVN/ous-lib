<?php namespace App\Http\Models;

use DB;
use Hash;
use Auth;
use Validator;
use Carbon\Carbon;

class InfoModel
{
    protected $table   = 't_info';
    protected $primaryKey   = 'info_id';
    public $timestamps  = false;

    public function Rules()
    {
        return array(
            'info_title'                       => 'required',
            'info_year'                        => 'required',
            'info_month'                       => 'required',
            'info_day'                         => 'required',
            'info_type'                        => 'required',
            'info_list_img'                    => 'image|mimes:jpeg,jpg,png,gif|max:10000',            
            'info2_file'                       => 'mimes:doc,docx,pdf,txt,xls,xlsx|max:10000',
            'info3_img'                        => 'image|mimes:jpeg,jpg,png,gif|max:10000|nullable',            
            'info3_file'                       => 'mimes:doc,docx,pdf,txt,xls,xlsx,ppt,pptx|max:10000|nullable',
            'info1_url'                        => 'required',
            'info2_file'                       => 'required',
            'info3_contents'                   => 'required|max:900000',

        );
    }

    public function Messages()
    {
        return array(
            'info_title.required'              => trans('validation.error_info_title_required'),
            'info_year.required'               => trans('validation.error_info_year_required'),
            'info_month.required'              => trans('validation.error_info_month_required'),
            'info_day.required'                => trans('validation.error_info_day_required'),
            'info_type.required'               => trans('validation.error_info_type_required'),
            'info_list_img.mimes'              => trans('validation.error_info_list_img_mime'),
            'info_list_img.image'              => trans('validation.error_info_list_img_mime'),
            'info_list_img.max'                => trans('validation.error_info_list_img_max'),
            'info1_url.required'               => trans('validation.error_info1_url_required'),
            'info2_file.required'              => trans('validation.error_info2_file_required'),
            'info2_file.mimes'                 => trans('validation.error_info2_file_mime'),
            'info2_file.max'                   => trans('validation.error_info2_file_max'),
            'info3_img.image'                  => trans('validation.error_info3_img_mime'),
            'info3_img.mimes'                  => trans('validation.error_info3_img_mime'),
            'info3_img.max'                    => trans('validation.error_info3_img_max'),
            'info3_contents.required'          => trans('validation.error_info3_contents_required'),
            'info3_contents.max'               => trans('validation.error_info3_contents_max'),
            'info3_file.mimes'                 => trans('validation.error_info3_file_mime'),
            'info3_file.max'                   => trans('validation.error_info3_file_max'),
        );
    }

   //Manage All Info
    public function getAllInfo(){
        return DB::table($this->table)->where('last_kind', '<>', DELETE)->orderBy('info_date', 'DESC')->simplePaginate(LIMIT_PAGE);
    }

    //Info insert
    public function insert($data)
    {
        return DB::table($this->table)->insert($data);
    }

    //Info get by id
    public function get_by_id($id)
    {
        return DB::table($this->table)->where('info_id', $id)->first();
    }

    public function get_by_id_before($id)
    {
        return DB::table($this->table)->where('info_id','<',$id)->where('last_kind', '<>', DELETE)->where('info_type', '3')->orderBy('info_id', 'DESC')->first();
    }

    public function get_by_id_after($id)
    {
        return DB::table($this->table)->where('info_id','>',$id)->where('last_kind', '<>', DELETE)->where('info_type', '3')->orderBy('info_id', 'ASC')->first();
    }


    //Info update
    public function update($id, $data)
    {
        return DB::table($this->table)->where('info_id', $id)->update($data);
    }

    //get All Info for frontend
    public function getInfo(){
        $datetime = Carbon::now();
        $now = $datetime->toDateTimeString();
        return DB::table($this->table)
        ->where('info_dspl_flag')
        ->where('last_kind', '<>', DELETE)
        ->whereDate('info_start', '<=', $now)
        ->whereDate('info_end', '>=', $now)

        ->orWhereNull('info_dspl_flag')
        ->where('last_kind', '<>', DELETE)
        ->whereDate('info_end', '>=', $now)
        ->whereNull('info_start')
        ->where('last_kind', '<>', DELETE)

        ->orWhereNull('info_dspl_flag')
        ->where('last_kind', '<>', DELETE)
        ->whereNull('info_end')
        ->whereNull('info_start')

        ->orWhereNull('info_dspl_flag')
        ->where('last_kind', '<>', DELETE)
        ->whereNull('info_end')
        ->whereDate('info_start', '<=', $now)

        ->orWhereNull('info_dspl_flag')
        ->where('last_kind', '<>', DELETE)
        ->whereNull('info_start')
        ->whereDate('info_end', '>=', $now)
        
        ->orderBy('info_date', 'DESC')
        ->orderBy('info_top_flag', 'DESC')
        ->orderBy('last_date', 'DESC')
        ->paginate(LIMIT_PAGE);
    }
     public function getInfoHomepage(){
        $datetime = Carbon::now();
        $now = $datetime->toDateTimeString();
        return DB::table($this->table)
        ->where('info_dspl_flag')
        ->where('info_top_flag', '=', '1')
        ->where('last_kind', '<>', DELETE)
        ->whereDate('info_start', '<=', $now)
        ->whereDate('info_end', '>=', $now)

        ->orWhereNull('info_dspl_flag')
        ->where('info_top_flag', '=', '1')
        ->where('last_kind', '<>', DELETE)
        ->whereDate('info_end', '>=', $now)
        ->whereNull('info_start')
        ->where('last_kind', '<>', DELETE)

        ->orWhereNull('info_dspl_flag')
        ->where('info_top_flag', '=', '1')
        ->where('last_kind', '<>', DELETE)
        ->whereNull('info_end')
        ->whereNull('info_start')

        ->orWhereNull('info_dspl_flag')
        ->where('info_top_flag', '=', '1')
        ->where('last_kind', '<>', DELETE)
        ->whereNull('info_end')
        ->whereDate('info_start', '<=', $now)

        ->orWhereNull('info_dspl_flag')
        ->where('info_top_flag', '=', '1')
        ->where('last_kind', '<>', DELETE)
        ->whereNull('info_start')
        ->whereDate('info_end', '>=', $now)
        
        ->orderBy('info_date', 'DESC')
        ->orderBy('info_top_flag', 'DESC')
        ->orderBy('last_date', 'DESC')
        ->paginate(FRONT_LIMIT_PAGE);
    }

}