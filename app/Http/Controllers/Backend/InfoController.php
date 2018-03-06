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
		return view('backend.infos.regist');
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
		// if(!empty(Input::get('info3_img_old'))) unset($rules['info3_img']);
		// if(!empty(Input::get('info3_file_old'))) unset($rules['info3_file']);

		$validator = Validator::make(Input::all(), $rules, $clsInfo->Messages());

		if ($validator->fails()) {
			return redirect()->route('backend.infos.regist')->withErrors($validator)->withInput();
		}

		$data['info_title'] = Input::get('info_title');
		$data['info_year'] = Input::get('info_year');
		$data['info_month'] = Input::get('info_month');
		$data['info_day'] = Input::get('info_day');

		if(!empty($data['info_year']) && !empty($data['info_month']) && !empty($data['info_day'])){
			$data['info_date'] = date('Y-m-d H:i:s', strtotime($data['info_year'].'-'.$data['info_month'].'-'.$data['info_day']));
		}

		if (Input::hasFile('info_list_img')) {
			$info_list_img = Input::file('info_list_img');
			$random = rand(time(), '9999');
			$fn_info_list_img = $random . '_' . $info_list_img->getClientOriginalName();
			Image::make($info_list_img)->save(public_path('upload/infos/images/' . $fn_info_list_img ));
			$data['info_list_img'] = '/upload/infos/images/' . $fn_info_list_img;
		}else{
			if(!empty(Input::get('info_list_img_old'))){
				$data['info_list_img'] = Input::get('info_list_img_old');
			}
		}

		$data['info_list_txt'] = Input::get('info_list_txt');
		$data['info_cat'] = Input::get('info_cat');

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
			$data['info3_contents'] = Input::get('info3_contents');
			if (Input::hasFile('info3_img1')) {
				$info3_img1 = Input::file('info3_img1');
				$random1 = rand(time(), '9999');
				$fn_info3_img1 = $random1 . '_' . $info3_img1->getClientOriginalName();
				Image::make($info3_img1)->save(public_path('upload/infos/images/' . $fn_info3_img1 ));
				$data['info3_img1'] = '/upload/infos/images/' . $fn_info3_img1;
			}else{
				if(!empty(Input::get('info3_img1_old'))){
					$data['info3_img1'] = Input::get('info3_img1_old');
				}
			}

			if (Input::hasFile('info3_img2')) {
				$info3_img2 = Input::file('info3_img2');
				$random2 = rand(time(), '9999');
				$fn_info3_img2 = $random2 . '_' . $info3_img2->getClientOriginalName();
				Image::make($info3_img2)->save(public_path('upload/infos/images/' . $fn_info3_img2 ));
				$data['info3_img2'] = '/upload/infos/images/' . $fn_info3_img2;
			}else{
				if(!empty(Input::get('info3_img2_old'))){
					$data['info3_img2'] = Input::get('info3_img2_old');
				}
			}

			if (Input::hasFile('info3_img3')) {
				$info3_img3 = Input::file('info3_img3');
				$random3 = rand(time(), '9999');
				$fn_info3_img3 = $random3 . '_' . $info3_img3->getClientOriginalName();
				Image::make($info3_img3)->save(public_path('upload/infos/images/' . $fn_info3_img3 ));
				$data['info3_img3'] = '/upload/infos/images/' . $fn_info3_img3;
			}else{
				if(!empty(Input::get('info3_img3_old'))){
					$data['info3_img3'] = Input::get('info3_img3_old');
				}
			}

			if (Input::hasFile('info3_img4')) {
				$info3_img4 = Input::file('info3_img4');
				$random4 = rand(time(), '9999');
				$fn_info3_img4 = $random4 . '_' . $info3_img4->getClientOriginalName();
				Image::make($info3_img4)->save(public_path('upload/infos/images/' . $fn_info3_img4 ));
				$data['info3_img4'] = '/upload/infos/images/' . $fn_info3_img4;
			}else{
				if(!empty(Input::get('info3_img4_old'))){
					$data['info3_img4'] = Input::get('info3_img4_old');
				}
			}

			if (Input::hasFile('info3_img5')) {
				$info3_img5 = Input::file('info3_img5');
				$random5 = rand(time(), '9999');
				$fn_info3_img5 = $random5 . '_' . $info3_img5->getClientOriginalName();
				Image::make($info3_img5)->save(public_path('upload/infos/images/' . $fn_info3_img5 ));
				$data['info3_img5'] = '/upload/infos/images/' . $fn_info3_img5;
			}else{
				if(!empty(Input::get('info3_img5_old'))){
					$data['info3_img5'] = Input::get('info3_img5_old');
				}
			}

			if (Input::hasFile('info3_file1')) {
				$info3_file1 = Input::file('info3_file1');
				$info3_path_name1= $info3_file1->getPathName();
				$_info3_ext1 = $info3_file1->extension();
				$name_info31 = $info3_file1->getClientOriginalName();
				$arr_info3 = explode('.', $name_info31);
				$info3_txt_name1 = $arr_info3[0];
				$fn_info3_file1 = $info3_txt_name1 . '_' . rand(time(), '9999') . '.' . $_info3_ext1;
				move_uploaded_file($info3_path_name1, base_path() . '/public/upload/infos/files/' . $fn_info3_file1);
				$data['info3_file1'] = '/upload/infos/files/' . $fn_info3_file1;
			}else{
				if(!empty(Input::get('info3_file2_old'))){
					$data['info3_file1'] = Input::get('info3_file1_old');
				}
			}
			$data['info3_filename1'] = Input::get('info3_filename1');

			if (Input::hasFile('info3_file2')) {
				$info3_file2 = Input::file('info3_file2');
				$info3_path_name2= $info3_file2->getPathName();
				$_info3_ext2 = $info3_file2->extension();
				$name_info32 = $info3_file2->getClientOriginalName();
				$arr_info3 = explode('.', $name_info32);
				$info3_txt_name2 = $arr_info3[0];
				$fn_info3_file2 = $info3_txt_name2 . '_' . rand(time(), '9999') . '.' . $_info3_ext2;
				move_uploaded_file($info3_path_name2, base_path() . '/public/upload/infos/files/' . $fn_info3_file2);
				$data['info3_file2'] = '/upload/infos/files/' . $fn_info3_file2;
			}else{
				if(!empty(Input::get('info3_file2_old'))){
					$data['info3_file2'] = Input::get('info3_file2_old');
				}
			}
			$data['info3_filename2'] = Input::get('info3_filename2');

			if (Input::hasFile('info3_file3')) {
				$info3_file3 = Input::file('info3_file3');
				$info3_path_name3= $info3_file3->getPathName();
				$_info3_ext3 = $info3_file3->extension();
				$name_info33 = $info3_file3->getClientOriginalName();
				$arr_info3 = explode('.', $name_info33);
				$info3_txt_name3 = $arr_info3[0];
				$fn_info3_file3 = $info3_txt_name3 . '_' . rand(time(), '9999') . '.' . $_info3_ext3;
				move_uploaded_file($info3_path_name3, base_path() . '/public/upload/infos/files/' . $fn_info3_file3);
				$data['info3_file3'] = '/upload/infos/files/' . $fn_info3_file3;
			}else{
				if(!empty(Input::get('info3_file3_old'))){
					$data['info3_file3'] = Input::get('info3_file3_old');
				}
			}
			$data['info3_filename3'] = Input::get('info3_filename3');

			if (Input::hasFile('info3_file4')) {
				$info3_file4 = Input::file('info3_file4');
				$info3_path_name4= $info3_file4->getPathName();
				$_info3_ext4 = $info3_file4->extension();
				$name_info34 = $info3_file4->getClientOriginalName();
				$arr_info4 = explode('.', $name_info34);
				$info3_txt_name4 = $arr_info4[0];
				$fn_info3_file4 = $info3_txt_name4 . '_' . rand(time(), '9999') . '.' . $_info3_ext4;
				move_uploaded_file($info3_path_name4, base_path() . '/public/upload/infos/files/' . $fn_info3_file4);
				$data['info3_file4'] = '/upload/infos/files/' . $fn_info3_file4;
			}else{
				if(!empty(Input::get('info3_file4_old'))){
					$data['info3_file4'] = Input::get('info3_file4_old');
				}
			}
			$data['info3_filename4'] = Input::get('info3_filename4');

			if (Input::hasFile('info3_file5')) {
				$info3_file5 = Input::file('info3_file5');
				$info3_path_name5 = $info3_file5->getPathName();
				$_info3_ext5 = $info3_file5->extension();
				$name_info35 = $info3_file5->getClientOriginalName();
				$arr_info5 = explode('.', $name_info35);
				$info3_txt_name5 = $arr_info5[0];
				$fn_info3_file5 = $info3_txt_name5 . '_' . rand(time(), '9999') . '.' . $_info3_ext5;
				move_uploaded_file($info3_path_name5, base_path() . '/public/upload/infos/files/' . $fn_info3_file5);
				$data['info3_file5'] = '/upload/infos/files/' . $fn_info3_file5;
			}else{
				if(!empty(Input::get('info3_file5_old'))){
					$data['info3_file5'] = Input::get('info3_file5_old');
				}
			}
			$data['info3_filename5'] = Input::get('info3_filename5');
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
				Session::flash('success', trans('common.msg_cts-adm_regist_success'));
				return redirect()->route('backend.infos.index');
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
		$info = $clsInfo->get_by_id($id);
		$info_id = $id;
		return view('backend.infos.edit', compact('info_id', 'info'));
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

		if(!empty($data['info_year']) && !empty($data['info_month']) && !empty($data['info_day'])){
			$data['info_date'] = date('Y-m-d H:i:s', strtotime($data['info_year'].'-'.$data['info_month'].'-'.$data['info_day']));
		}

		if(!empty(Input::get('chk_info_list_img'))){
			$data['info_list_img'] = NULL;
		}else{
			if (Input::hasFile('info_list_img')) {
				$info_list_img = Input::file('info_list_img');
				$random = rand(time(), '9999');
				$fn_info_list_img = $random . '_' . $info_list_img->getClientOriginalName();
				Image::make($info_list_img)->save(public_path('upload/infos/images/' . $fn_info_list_img ));
				$data['info_list_img'] = '/upload/infos/images/' . $fn_info_list_img;
			}else{
				if(!empty(Input::get('info_list_img_old'))){
					$data['info_list_img'] = Input::get('info_list_img_old');
				}
			}
		}

		$data['info_list_txt'] = Input::get('info_list_txt');
		$data['info_cat'] = Input::get('info_cat');

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
					$data['info3_img1'] = '/upload/infos/images/' . $fn_info3_img1;
				}else{
					if(!empty(Input::get('info3_img1_old')) && Input::get('info3_img1_radio') == 1)
						$data['info3_img1'] = Input::get('info3_img1_old');
					elseif(empty(Input::get('info3_img1')) && Input::get('info3_img1_radio') == 2)
						$data['info3_img1'] = NULL;
				}
			}elseif(!empty(Input::get('info3_img1_radio')) && Input::get('info3_img1_radio') == 3){
				$data['info3_img1'] = NULL;
			}else{
				if(!empty(Input::get('info3_img1_old')))
					$data['info3_img1'] = Input::get('info3_img1_old');
			}

			if(!empty(Input::get('info3_img2_radio')) && Input::get('info3_img2_radio') == 2){	
				if (Input::hasFile('info3_img2')) {
					$info3_img2 = Input::file('info3_img2');
					$random2 = rand(time(), '9999');
					$fn_info3_img2 = $random2. '_' . $info3_img2->getClientOriginalName();
					Image::make($info3_img2)->save(public_path('upload/infos/images/' . $fn_info3_img2 ));
					$data['info3_img2'] = '/upload/infos/images/' . $fn_info3_img2;
				}else{
					if(!empty(Input::get('info3_img2_old')) && Input::get('info3_img2_radio') == 1)
						$data['info3_img2'] = Input::get('info3_img2_old');
					elseif(empty(Input::get('info3_img2')) && Input::get('info3_img2_radio') == 2)
						$data['info3_img2'] = NULL;
				}
			}elseif(!empty(Input::get('info3_img2_radio')) && Input::get('info3_img2_radio') == 3){
				$data['info3_img2'] = NULL;
			}else{
				if(!empty(Input::get('info3_img2_old')))
					$data['info3_img2'] = Input::get('info3_img2_old');
			}

			if(!empty(Input::get('info3_img3_radio')) && Input::get('info3_img3_radio') == 2){	
				if (Input::hasFile('info3_img3')) {
					$info3_img3 = Input::file('info3_img3');
					$random3 = rand(time(), '9999');
					$fn_info3_img3 = $random3. '_' . $info3_img3->getClientOriginalName();
					Image::make($info3_img3)->save(public_path('upload/infos/images/' . $fn_info3_img3 ));
					$data['info3_img3'] = '/upload/infos/images/' . $fn_info3_img3;
				}else{
					if(!empty(Input::get('info3_img3_old')) && Input::get('info3_img3_radio') == 1)
						$data['info3_img3'] = Input::get('info3_img3_old');
					elseif(empty(Input::get('info3_img3')) && Input::get('info3_img3_radio') == 2)
						$data['info3_img3'] = NULL;
				}
			}elseif(!empty(Input::get('info3_img3_radio')) && Input::get('info3_img3_radio') == 3){
				$data['info3_img3'] = NULL;
			}else{
				if(!empty(Input::get('info3_img3_old')))
					$data['info3_img3'] = Input::get('info3_img3_old');
			}

			if(!empty(Input::get('info3_img4_radio')) && Input::get('info3_img4_radio') == 2){	
				if (Input::hasFile('info3_img4')) {
					$info3_img4 = Input::file('info3_img4');
					$random4 = rand(time(), '9999');
					$fn_info3_img4 = $random4 . '_' . $info3_img4->getClientOriginalName();
					Image::make($info3_img4)->save(public_path('upload/infos/images/' . $fn_info3_img4 ));
					$data['info3_img4'] = '/upload/infos/images/' . $fn_info3_img4;
				}else{
					if(!empty(Input::get('info3_img4_old')) && Input::get('info3_img4_radio') == 1)
						$data['info3_img4'] = Input::get('info3_img4_old');
					elseif(empty(Input::get('info3_img4')) && Input::get('info3_img4_radio') == 2)
						$data['info3_img4'] = NULL;
				}
			}elseif(!empty(Input::get('info3_img4_radio')) && Input::get('info3_img4_radio') == 3){
				$data['info3_img4'] = NULL;
			}else{
				if(!empty(Input::get('info3_img4_old')))
					$data['info3_img4'] = Input::get('info3_img4_old');
			}

			if(!empty(Input::get('info3_img5_radio')) && Input::get('info3_img5_radio') == 2){	
				if (Input::hasFile('info3_img5')) {
					$info3_img5 = Input::file('info3_img5');
					$random5 = rand(time(), '9999');
					$fn_info3_img5 = $random5 . '_' . $info3_img5->getClientOriginalName();
					Image::make($info3_img5)->save(public_path('upload/infos/images/' . $fn_info3_img5 ));
					$data['info3_img5'] = '/upload/infos/images/' . $fn_info3_img5;
				}else{
					if(!empty(Input::get('info3_img5_old')) && Input::get('info3_img5_radio') == 1)
						$data['info3_img5'] = Input::get('info3_img5_old');
					elseif(empty(Input::get('info3_img5')) && Input::get('info3_img5_radio') == 2)
						$data['info3_img5'] = NULL;
				}
			}elseif(!empty(Input::get('info3_img5_radio')) && Input::get('info3_img5_radio') == 3){
				$data['info3_img5'] = NULL;
			}else{
				if(!empty(Input::get('info3_img5_old')))
					$data['info3_img5'] = Input::get('info3_img5_old');
			}

			//File
			if(!empty(Input::get('info3_file1_radio')) && Input::get('info3_file1_radio') == 2){
				if (Input::hasFile('info3_file1')) {
					$info3_file1 = Input::file('info3_file1');
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
						$data['info3_file1'] = Input::get('info3_file1_old');
					elseif(empty(Input::get('info3_file1')) && Input::get('info3_file1_radio') == 2)
						$data['info3_file1'] = NULL;
				}
			}elseif(!empty(Input::get('info3_file1_radio')) && Input::get('info3_file1_radio') == 3){
				$data['info3_file1'] = NULL;
			}else{
				if(!empty(Input::get('info3_file1_old')))
					$data['info3_file1'] = Input::get('info3_file1_old');
			}
			$data['info3_filename1'] = Input::get('info3_filename1');

			if(!empty(Input::get('info3_file2_radio')) && Input::get('info3_file2_radio') == 2){
				if (Input::hasFile('info3_file2')) {
					$info3_file2 = Input::file('info3_file2');
					$info3_path_name2 = $info3_file2->getPathName();
					$info3_ext2 = $info3_file2->getClientOriginalExtension();
					$name_info32 = $info3_file2->getClientOriginalName();
					$arr_info32 = explode('.', $name_info32);
					$info3_txt_name2 = $arr_info32[0];
					$fn_info3_file2 = $info3_txt_name2 . '_' . rand(time(), '9999') . '.' . $info3_ext2;
					move_uploaded_file($info3_path_name2, base_path() . '/public/upload/infos/files/' . $fn_info3_file2);
					$data['info3_file2'] = '/upload/infos/files/' . $fn_info3_file2;
				}else{
					if(!empty(Input::get('info3_file2_old')) && Input::get('info3_file2_radio') == 1)
						$data['info3_file2'] = Input::get('info3_file2_old');
					elseif(empty(Input::get('info3_file2')) && Input::get('info3_file2_radio') == 2)
						$data['info3_file2'] = NULL;
				}
			}elseif(!empty(Input::get('info3_file2_radio')) && Input::get('info3_file2_radio') == 3){
				$data['info3_file2'] = NULL;
			}else{
				if(!empty(Input::get('info3_file2_old')))
					$data['info3_file2'] = Input::get('info3_file2_old');
			}
			$data['info3_filename2'] = Input::get('info3_filename2');

			if(!empty(Input::get('info3_file3_radio')) && Input::get('info3_file3_radio') == 2){
				if (Input::hasFile('info3_file3')) {
					$info3_file3 = Input::file('info3_file3');
					$info3_path_name3 = $info3_file3->getPathName();
					$info3_ext3 = $info3_file3->getClientOriginalExtension();
					$name_info33 = $info3_file3->getClientOriginalName();
					$arr_info33 = explode('.', $name_info33);
					$info3_txt_name3 = $arr_info33[0];
					$fn_info3_file3 = $info3_txt_name3 . '_' . rand(time(), '9999') . '.' . $info3_ext3;
					move_uploaded_file($info3_path_name3, base_path() . '/public/upload/infos/files/' . $fn_info3_file3);
					$data['info3_file3'] = '/upload/infos/files/' . $fn_info3_file3;
				}else{
					if(!empty(Input::get('info3_file3_old')) && Input::get('info3_file3_radio') == 1)
						$data['info3_file3'] = Input::get('info3_file3_old');
					elseif(empty(Input::get('info3_file3')) && Input::get('info3_file3_radio') == 2)
						$data['info3_file3'] = NULL;
				}
			}elseif(!empty(Input::get('info3_file3_radio')) && Input::get('info3_file3_radio') == 3){
				$data['info3_file3'] = NULL;
			}else{
				if(!empty(Input::get('info3_file3_old')))
					$data['info3_file3'] = Input::get('info3_file3_old');
			}
			$data['info3_filename3'] = Input::get('info3_filename3');

			if(!empty(Input::get('info3_file4_radio')) && Input::get('info3_file4_radio') == 2){
				if (Input::hasFile('info3_file4')) {
					$info3_file4 = Input::file('info3_file4');
					$info3_path_name4 = $info3_file4->getPathName();
					$info3_ext4 = $info3_file4->getClientOriginalExtension();
					$name_info34 = $info3_file4->getClientOriginalName();
					$arr_info34 = explode('.', $name_info34);
					$info3_txt_name4 = $arr_info34[0];
					$fn_info3_file4 = $info3_txt_name4 . '_' . rand(time(), '9999') . '.' . $info3_ext4;
					move_uploaded_file($info3_path_name4, base_path() . '/public/upload/infos/files/' . $fn_info3_file4);
					$data['info3_file4'] = '/upload/infos/files/' . $fn_info3_file4;
				}else{
					if(!empty(Input::get('info3_file4_old')) && Input::get('info3_file4_radio') == 1)
						$data['info3_file4'] = Input::get('info3_file4_old');
					elseif(empty(Input::get('info3_file4')) && Input::get('info3_file4_radio') == 2)
						$data['info3_file4'] = NULL;
				}
			}elseif(!empty(Input::get('info3_file4_radio')) && Input::get('info3_file4_radio') == 3){
				$data['info3_file4'] = NULL;
			}else{
				if(!empty(Input::get('info3_file4_old')))
					$data['info3_file4'] = Input::get('info3_file4_old');
			}
			$data['info3_filename4'] = Input::get('info3_filename4');

			if(!empty(Input::get('info3_file5_radio')) && Input::get('info3_file5_radio') == 2){
				if (Input::hasFile('info3_file5')) {
					$info3_file5 = Input::file('info3_file5');
					$info3_path_name5 = $info3_file5->getPathName();
					$info3_ext5 = $info3_file5->getClientOriginalExtension();
					$name_info35 = $info3_file5->getClientOriginalName();
					$arr_info35 = explode('.', $name_info35);
					$info3_txt_name5 = $arr_info35[0];
					$fn_info3_file5 = $info3_txt_name5 . '_' . rand(time(), '9999') . '.' . $info3_ext5;
					move_uploaded_file($info3_path_name5, base_path() . '/public/upload/infos/files/' . $fn_info3_file5);
					$data['info3_file5'] = '/upload/infos/files/' . $fn_info3_file5;
				}else{
					if(!empty(Input::get('info3_file5_old')) && Input::get('info3_file5_radio') == 1)
						$data['info3_file5'] = Input::get('info3_file5_old');
					elseif(empty(Input::get('info3_file5')) && Input::get('info3_file5_radio') == 2)
						$data['info3_file5'] = NULL;
				}
			}elseif(!empty(Input::get('info3_file5_radio')) && Input::get('info3_file5_radio') == 3){
				$data['info3_file5'] = NULL;
			}else{
				if(!empty(Input::get('info3_file5_old')))
					$data['info3_file5'] = Input::get('info3_file5_old');
			}
			$data['info3_filename5'] = Input::get('info3_filename5');

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
			Session::flash('success', trans('common.msg_cts-adm_regist_success'));
			return redirect()->route('backend.infos.index');
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
			Session::flash('success', trans('common.msg_cts-adm_del_success'));
			return redirect()->route('backend.infos.index');
		}else{
			Session::flash('danger', trans('common.msg_cts-adm_del_danger'));
			return redirect()->route('backend.infos.index');
		}
	}
}