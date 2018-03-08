<?php namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Models\InfoModel;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Auth;
use Input;
use Validator;
use Session;
use Image;
use Html;
use File;
use Storage;

class InfoController extends BackendController
{
	public function index(){
		$clsInfo = new InfoModel();
		$infos = $clsInfo->getAllInfo();
		return view('backend.infos.index', compact('infos'));
	}

	public function regist(){
		$data['error']['error_info_title_required']    	= trans('validation.error_info_title_required');
		$data['error']['error_info_type_required']    	= trans('validation.error_info_type_required');
		$data['error']['error_info_year_required']    	= trans('validation.error_info_year_required');
		$data['error']['error_info1_url_required']    	= trans('validation.error_info1_url_required');
		$data['error']['error_info2_file_required']    	= trans('validation.error_info2_file_required');
		return view('backend.infos.regist',$data);
	}

	public function postRegist(Request $request){
		$clsInfo = new InfoModel();
		$rules = $clsInfo->Rules();
		if( empty(Input::get('info_year')) && empty(Input::get('info_month')) && empty(Input::get('info_day'))){
			unset($rules['info_month']);
			unset($rules['info_day']);
		}

		if( empty(Input::get('info_year'))){
			unset($rules['info_month']);
			unset($rules['info_day']);
		}elseif( empty(Input::get('info_day'))){
			unset($rules['info_year']);
			unset($rules['info_month']);
		}elseif( empty(Input::get('info_month'))){
			unset($rules['info_year']);
			unset($rules['info_day']);
		}

		if(!empty(Input::get('info_type'))){
			if(Input::get('info_type') == 1){
				unset($rules['info2_file']);
				unset($rules['info3_contents']);
			}elseif(Input::get('info_type') == 2){
				unset($rules['info1_url']);
				unset($rules['info3_contents']);
			}else{
				unset($rules['info1_url']);
				unset($rules['info2_file']);
			}

		}else{
			unset($rules['info1_url']);
			unset($rules['info2_file']);
			unset($rules['info3_contents']);
		}

		if(!empty(Input::get('info2_file_old'))) unset($rules['info2_file']);
		

		$validator = Validator::make(Input::all(), $rules, $clsInfo->Messages());

        ///echo "<pre>";print_r($validator);echo "</pre>";die; 
		if ($validator->fails()) {
			return redirect()->route('backend.infos.regist')->withErrors($validator)->withInput();
		}

		$data['info_title'] = Input::get('info_title');
		$data['info_year'] = Input::get('info_year');
		$data['info_month'] = Input::get('info_month');
		$data['info_day'] = Input::get('info_day');
		$data['info_hour'] = Input::get('info_hour');
		$data['info_minute'] = Input::get('info_minute');

		if(!empty($data['info_year']) && !empty($data['info_month']) && !empty($data['info_day'])){
			$data['info_date'] = date('Y-m-d H:i:s', strtotime($data['info_year'].'-'.$data['info_month'].'-'.$data['info_day'].' '.$data['info_hour'].'-'.$data['info_minute']));
		}		
		
		$data['info_type'] = Input::get('info_type');

		if($data['info_type'] == 1){
			$data['info1_url'] = Input::get('info1_url');
		}elseif($data['info_type'] == 2){
			if (Input::hasFile('info2_file')) {
				$info2_file = Input::file('info2_file');
				$info2_path_name= $info2_file->getPathName();
				$_info2_ext = $info2_file->extension();
				$name_info2 = $info2_file->getClientOriginalName();
				$arr_info2 = explode('.', $name_info2);
				$info2_txt_name = $arr_info2[0];
				$fn_info2_file = $info2_txt_name . '_' . rand(time(), '9999') . '.' . $_info2_ext;

				move_uploaded_file($info2_path_name, base_path() . '/public/upload/infos/files/' . $fn_info2_file);

				$data['info2_file'] = '/upload/infos/files/' . $fn_info2_file;
			}else{
				if(!empty(Input::get('info2_file_old'))){
					$data['info2_file'] = Input::get('info2_file_old');
				}
			}
		}else{			
			if (Input::hasFile('info3_imgfile')) {
				$info3_img = Input::file('info3_imgfile');
				$random = rand(time(), '9999');
				$fn_info3_img = $random . '_' . $info3_img->getClientOriginalName();
				Image::make($info3_img)->save(public_path('upload/infos/images/' . $fn_info3_img ));
				$data['info3_imgfile'] = '/upload/infos/images/' . $fn_info3_img;
			}else{
				if(!empty(Input::get('info3_imgfile_old'))){
					$data['info3_imgfile'] = Input::get('info3_imgfile_old');
				}
			}			

			if (Input::hasFile('info3_file')) {
				$info3_file = Input::file('info3_file');
				$info3_path_name= $info3_file->getPathName();
				$_info3_ext = $info3_file->extension();
				$name_info3 = $info3_file->getClientOriginalName();
				$arr_info3 = explode('.', $name_info3);
				$info3_txt_name = $arr_info3[0];
				$fn_info3_file = $info3_txt_name . '_' . rand(time(), '9999') . '.' . $_info3_ext;
				move_uploaded_file($info3_path_name, base_path() . '/public/upload/infos/files/' . $fn_info3_file);
				$data['info3_file'] = '/upload/infos/files/' . $fn_info3_file;
			}else{
				if(!empty(Input::get('info3_file_old'))){
					$data['info3_file'] = Input::get('info3_file_old');
				}
			}
			$data['info3_filename'] = Input::get('info3_filename');
			
		}
        $data['info3_contents'] = Input::get('info3_contents');
        $data['info3_url']      = Input::get('info3_url');
        $data['info3_mail']     = Input::get('info3_mail');
		$data['info_dspl_flag'] = Input::get('info_dspl_flag');
		$data['info_top_flag']  = Input::get('info_top_flag');

		if(!empty(Input::get('year_start'))) $data['year_start'] = Input::get('year_start');
		if(!empty(Input::get('month_start'))) $data['month_start'] = Input::get('month_start');
		if(!empty(Input::get('day_start'))) $data['day_start'] = Input::get('day_start');
		if(!empty(Input::get('hour_start'))) $data['hour_start'] = Input::get('hour_start');
		if(!empty(Input::get('minute_start'))) $data['minute_start'] = Input::get('minute_start');

		if(!empty(Input::get('year_end'))) $data['year_end'] = Input::get('year_end');
		if(!empty(Input::get('month_end'))) $data['month_end'] = Input::get('month_end');
		if(!empty(Input::get('day_end'))) $data['day_end'] = Input::get('day_end');
		if(!empty(Input::get('hour_end'))) $data['hour_end'] = Input::get('hour_end');
		if(!empty(Input::get('minute_end'))) $data['minute_end'] = Input::get('minute_end');

		if(!empty($data['year_start']) && !empty($data['month_start']) && !empty($data['day_start'])){
			if(!empty($data['hour_start']) && !empty($data['minute_start']) ){
				$time_start = c2digit($data['hour_start']) . ':' . c2digit($data['minute_start']) . ':' . '00';
			}else{
				$time_start = '00:00:00';
			}

			$data['info_start'] = date('Y-m-d H:i:s', strtotime($data['year_start'].'-'.$data['month_start'].'-'.$data['day_start'] . ' ' . $time_start));
		}else{
			$data['info_start'] = NULL;
		}

		if(!empty($data['year_end']) && !empty($data['month_end']) && !empty($data['day_end'])){
			if(!empty($data['hour_end']) && !empty($data['minute_end']) ){
				$time_end = c2digit($data['hour_end']) . ':' . c2digit($data['minute_end']) . ':' . '00';
			}else{
				$time_end = '00:00:00';
			}

			$data['info_end'] = date('Y-m-d H:i:s', strtotime($data['year_end'].'-'.$data['month_end'].'-'.$data['day_end'] . ' ' . $time_end));
		}else{
			$data['info_end'] = NULL;
		}

		$data['last_date'] = date('Y-m-d H:i:s');
		$data['last_kind'] = INSERT;
		$data['last_user'] = Auth::user()->u_id;
        
		Session::put('info_regist', $data);
		return redirect()->route('backend.infos.regist_cnf');
	}

	public function registCnf(){
		$info = array();
		if(Session::has('info_regist')){
			$info = (Object) Session::get('info_regist');
		}else{
			return redirect()->route('backend.infos.regist');
		}

		return view('backend.infos.regist_cnf', compact('info'));
	}

	public function registSave(){
		$clsInfo = new InfoModel();
		$data = array();
		if (Session::has('info_regist')) {
			$data = Session::get('info_regist');

			if(isset($data['info_year'])) unset($data['info_year']);
			if(isset($data['info_month'])) unset($data['info_month']);			
			if(isset($data['info_day'])) unset($data['info_day']);
			if(isset($data['info_hour'])) unset($data['info_hour']);
			if(isset($data['info_minute'])) unset($data['info_minute']);

			if(isset($data['year_start'])) unset($data['year_start']);
			if(isset($data['month_start'])) unset($data['month_start']);
			if(isset($data['day_start'])) unset($data['day_start']);
			if(isset($data['hour_start'])) unset($data['hour_start']);
			if(isset($data['minute_start'])) unset($data['minute_start']);

			if(isset($data['year_end'])) unset($data['year_end']);
			if(isset($data['month_end'])) unset($data['month_end']);
			if(isset($data['day_end'])) unset($data['day_end']);
			if(isset($data['hour_end'])) unset($data['hour_end']);
			if(isset($data['minute_end'])) unset($data['minute_end']);

			if($clsInfo->insert($data)){
				if(Session::has('info_regist')) Session::forget('info_regist');			    
				return view('backend.infos.regist_done');
			}else{
				Session::flash('danger', trans('common.msg_cts-adm_regist_danger'));
				return redirect()->route('backend.infos.regist');
			}
		}else{
			return redirect()->route('backend.infos.regist');
		}
	}

	public function registBack(){
		if (Session::has('info_regist')) {
			$info = Session::get('info_regist');
			return redirect()->route('backend.infos.regist')->withInput($info);
		}else{
			return redirect()->route('backend.infos.regist');
		}
	}

	public function edit($id){
		$clsInfo = new InfoModel();
		$data['info']= $clsInfo->get_by_id($id);		
		$data['info_id'] = $id;
		$data['error']['error_info_title_required']    	= trans('validation.error_info_title_required');
		$data['error']['error_info_type_required']    	= trans('validation.error_info_type_required');
		$data['error']['error_info_year_required']    	= trans('validation.error_info_year_required');
		$data['error']['error_info1_url_required']    	= trans('validation.error_info1_url_required');
		$data['error']['error_info2_file_required']    	= trans('validation.error_info2_file_required');
		return view('backend.infos.edit',$data);
	}

	public function postEdit($id){
		$clsInfo = new InfoModel();
		$rules = $clsInfo->Rules();
		if( empty(Input::get('info_year')) && empty(Input::get('info_month')) && empty(Input::get('info_day'))){
			unset($rules['info_month']);
			unset($rules['info_day']);
		}

		if( empty(Input::get('info_year'))){
			unset($rules['info_month']);
			unset($rules['info_day']);
		}elseif( empty(Input::get('info_day'))){
			unset($rules['info_year']);
			unset($rules['info_month']);
		}elseif( empty(Input::get('info_month'))){
			unset($rules['info_year']);
			unset($rules['info_day']);
		}

		if(!empty(Input::get('info_type'))){
			if(Input::get('info_type') == 1){
				unset($rules['info2_file']);
				unset($rules['info3_contents']);
			}elseif(Input::get('info_type') == 2){
				unset($rules['info1_url']);
				unset($rules['info3_contents']);
				if(!empty(Input::get('info2_file_old'))){
					unset($rules['info2_file']);
				}
			}else{
				unset($rules['info1_url']);
				unset($rules['info2_file']);
			}

		}else{
			unset($rules['info1_url']);
			unset($rules['info2_file']);
			unset($rules['info3_contents']);
		}

		if(!empty(Input::get('info2_file_old'))) unset($rules['info2_file']);
		// if(!empty(Input::get('info3_img_old'))) unset($rules['info3_img']);
		// if(!empty(Input::get('info3_file_old'))) unset($rules['info3_file']);

		$validator = Validator::make(Input::all(), $rules, $clsInfo->Messages());

		if ($validator->fails()) {
			return redirect()->route('backend.infos.edit', $id)->withErrors($validator)->withInput();
		}

		$data['info_title'] = Input::get('info_title');
		$data['info_year'] = Input::get('info_year');
		$data['info_month'] = Input::get('info_month');
		$data['info_day'] = Input::get('info_day');
		$data['info_hour'] = Input::get('info_hour');
		$data['info_minute'] = Input::get('info_minute');

		if(!empty($data['info_year']) && !empty($data['info_month']) && !empty($data['info_day'])){
			$data['info_date'] = date('Y-m-d H:i:s', strtotime($data['info_year'].'-'.$data['info_month'].'-'.$data['info_day'].' '.$data['info_hour'].':'.$data['info_minute']));
		}

		
		$data['info_type'] = Input::get('info_type');

		if($data['info_type'] == 1){
			$data['info1_url'] = Input::get('info1_url');
		}elseif($data['info_type'] == 2){
			if(!empty(Input::get('chk_info2_file'))){
				$data['info2_file'] = NULL;
			}else{
				if (Input::hasFile('info2_file')) {
					$info2_file = Input::file('info2_file');
					$info2_path_name= $info2_file->getPathName();
					$_info2_ext = $info2_file->getClientOriginalExtension();
					$name_info2 = $info2_file->getClientOriginalName();
					$arr_info2 = explode('.', $name_info2);
					$info2_txt_name = $arr_info2[0];
					$fn_info2_file = $info2_txt_name . '_' . rand(time(), '9999') . '.' . $_info2_ext;
					move_uploaded_file($info2_path_name, base_path() . '/public/upload/infos/files/' . $fn_info2_file);
					$data['info2_file'] = '/upload/infos/files/' . $fn_info2_file;
				}else{
					if(!empty(Input::get('info2_file_old'))){
						$data['info2_file'] = Input::get('info2_file_old');
					}
				}
			}			
		}else{
			$data['info3_contents'] = Input::get('info3_contents');
			//Image
			if(!empty(Input::get('info3_img1_radio')) && Input::get('info3_img1_radio') == 2){	
				if (Input::hasFile('info3_img1')) {
					$info3_img1 = Input::file('info3_img1');
					$random1 = rand(time(), '9999');
					$fn_info3_img1 = $random1. '_' . $info3_img1->getClientOriginalName();
					Image::make($info3_img1)->save(public_path('upload/infos/images/' . $fn_info3_img1 ));
					$data['info3_imgfile'] = '/upload/infos/images/' . $fn_info3_img1;
				}else{
					if(!empty(Input::get('info3_img1_old')) && Input::get('info3_img1_radio') == 1)
						$data['info3_imgfile'] = Input::get('info3_img1_old');
					elseif(empty(Input::get('info3_img1')) && Input::get('info3_img1_radio') == 2)
						$data['info3_imgfile'] = NULL;
				}
			}elseif(!empty(Input::get('info3_img1_radio')) && Input::get('info3_img1_radio') == 3){
				$data['info3_imgfile'] = NULL;
			}else{
				if(!empty(Input::get('info3_img1_old')))
					$data['info3_imgfile'] = Input::get('info3_img1_old');
			}
			

			//File
			if(!empty(Input::get('info3_file1_radio')) && Input::get('info3_file1_radio') == 2){
				if (Input::hasFile('info3_file')) {
					$info3_file1 = Input::file('info3_file');
					$info3_path_name1 = $info3_file1->getPathName();
					$info3_ext1 = $info3_file1->getClientOriginalExtension();
					$name_info31 = $info3_file1->getClientOriginalName();
					$arr_info31 = explode('.', $name_info31);
					$info3_txt_name1 = $arr_info31[0];
					$fn_info3_file1 = $info3_txt_name1 . '_' . rand(time(), '9999') . '.' . $info3_ext1;
					move_uploaded_file($info3_path_name1, base_path() . '/public/upload/infos/files/' . $fn_info3_file1);
					$data['info3_file1'] = '/upload/infos/files/' . $fn_info3_file1;
				}else{
					if(!empty(Input::get('info3_file1_old')) && Input::get('info3_file1_radio') == 1)
						$data['info3_file'] = Input::get('info3_file1_old');
					elseif(empty(Input::get('info3_file1')) && Input::get('info3_file1_radio') == 2)
						$data['info3_file'] = NULL;
				}
			}elseif(!empty(Input::get('info3_file1_radio')) && Input::get('info3_file1_radio') == 3){
				$data['info3_file'] = NULL;
			}else{
				if(!empty(Input::get('info3_file1_old')))
					$data['info3_file'] = Input::get('info3_file1_old');
			}
			$data['info3_filename'] = Input::get('info3_filename');	
			$data['info3_url'] = Input::get('info3_url');
			$data['info3_mail'] = Input::get('info3_mail');		

		}
         
		$data['info_dspl_flag'] = Input::get('info_dspl_flag');
		$data['info_top_flag'] = Input::get('info_top_flag');

		if(!empty(Input::get('year_start'))) $data['year_start'] = Input::get('year_start');
		if(!empty(Input::get('month_start'))) $data['month_start'] = Input::get('month_start');
		if(!empty(Input::get('day_start'))) $data['day_start'] = Input::get('day_start');
		if(!empty(Input::get('hour_start'))) $data['hour_start'] = Input::get('hour_start');
		if(!empty(Input::get('minute_start'))) $data['minute_start'] = Input::get('minute_start');

		if(!empty(Input::get('year_end'))) $data['year_end'] = Input::get('year_end');
		if(!empty(Input::get('month_end'))) $data['month_end'] = Input::get('month_end');
		if(!empty(Input::get('day_end'))) $data['day_end'] = Input::get('day_end');
		if(!empty(Input::get('hour_end'))) $data['hour_end'] = Input::get('hour_end');
		if(!empty(Input::get('minute_end'))) $data['minute_end'] = Input::get('minute_end');

		if(!empty($data['year_start']) && !empty($data['month_start']) && !empty($data['day_start'])){
			if(!empty($data['hour_start']) && !empty($data['minute_start']) ){
				$time_start = c2digit($data['hour_start']) . ':' . c2digit($data['minute_start']) . ':' . '00';
			}else{
				$time_start = '00:00:00';
			}

			$date_start = $data['year_start'].'-'.$data['month_start'].'-'.$data['day_start'] . ' ' . $time_start;

			$data['info_start'] = date('Y-m-d H:i:s', strtotime($date_start));
		}else{
			$data['info_start'] = NULL;
		}

		if(!empty($data['year_end']) && !empty($data['month_end']) && !empty($data['day_end'])){
			if(!empty($data['hour_end']) && !empty($data['minute_end']) ){
				$time_end = c2digit($data['hour_end']) . ':' . c2digit($data['minute_end']) . ':' . '00';
			}else{
				$time_end = '00:00:00';
			}

			$date_end = $data['year_end'].'-'.$data['month_end'].'-'.$data['day_end'] . ' ' . $time_end;

			$data['info_end'] = date('Y-m-d H:i:s', strtotime($date_end));
		}else{
			$data['info_end'] = NULL;
		}

		$data['last_date'] = date('Y-m-d H:i:s');
		$data['last_kind'] = UPDATE;
		$data['last_user'] = Auth::user()->u_id;
        
		Session::put('info_edit', $data);
		return redirect()->route('backend.infos.edit_cnf',$id);
	}

	public function editCnf($id){
		$info_id = $id;
		$info = array();
		if(Session::has('info_edit')){
			$info = (Object) Session::get('info_edit');
		}else{
			return redirect()->route('backend.infos.edit', $id);
		}
		return view('backend.infos.edit_cnf', compact('info', 'info_id'));
	}

	public function editSave($id){
		$clsInfo = new InfoModel();
		$data = array();
		if (Session::has('info_edit')) {
			$data = Session::get('info_edit');

			if(isset($data['info_year'])) unset($data['info_year']);
			if(isset($data['info_month'])) unset($data['info_month']);
			if(isset($data['info_day'])) unset($data['info_day']);
			if(isset($data['info_hour'])) unset($data['info_hour']);
			if(isset($data['info_minute'])) unset($data['info_minute']);

			if(isset($data['year_start'])) unset($data['year_start']);
			if(isset($data['month_start'])) unset($data['month_start']);
			if(isset($data['day_start'])) unset($data['day_start']);
			if(isset($data['hour_start'])) unset($data['hour_start']);
			if(isset($data['minute_start'])) unset($data['minute_start']);

			if(isset($data['year_end'])) unset($data['year_end']);
			if(isset($data['month_end'])) unset($data['month_end']);
			if(isset($data['day_end'])) unset($data['day_end']);
			if(isset($data['hour_end'])) unset($data['hour_end']);
			if(isset($data['minute_end'])) unset($data['minute_end']);

			if($clsInfo->update($id, $data)){
				if(Session::has('info_edit')) Session::forget('info_edit');				
			    return view('backend.infos.regist_done');
			}else{
				Session::flash('danger', trans('common.msg_cts-adm_regist_danger'));
				return redirect()->route('backend.infos.edit, $id');
			}
		}else{
			return redirect()->route('backend.infos.edit, $id');
		}
	}

	public function editBack($id){
		if (Session::has('info_edit')) {
			$info = Session::get('info_edit');
			return redirect()->route('backend.infos.edit', $id)->withInput($info);
		}else{
			return redirect()->route('backend.infos.edit', $id);
		}
	}

	public function detail($id){
		$clsInfo = new InfoModel();
		$info = $clsInfo->get_by_id($id);
		return view('backend.infos.detail', compact('info'));
	}

	public function delete($id){
		$clsInfo = new InfoModel();
		$info = $clsInfo->get_by_id($id);
		return view('backend.infos.delete', compact('info'));
	}

	public function deleteSave($id){
		$clsInfo = new InfoModel();
		$data['last_date'] = date('Y-m-d H:i:s');
		$data['last_kind'] = DELETE;
		$data['last_user'] = Auth::user()->u_id;

		if($clsInfo->update($id, $data)){			
			return view('backend.infos.regist_done');
		}else{
			Session::flash('danger', trans('common.msg_cts-adm_del_danger'));
			return redirect()->route('backend.infos.index');
		}
	}
}