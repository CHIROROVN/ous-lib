
@extends('backend.layouts.app')

@section('content')

<table width="960" border="0" align="center" cellpadding="5" cellspacing="0">
  <tbody>
	<tr>
	  <td width="150%" class="col_1">■敷島堂 Website 管理画面　＞　「お知らせ」管理　＞　編集確認</td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	</tr>
	{!! Form::open(array('route' => ['backend.infos.edit', $info_id], 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
	<tr>
	  <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
		<tbody>
		  <tr>
			<td colspan="2" class="col_3">タイトル <span class="required">必須</span></td>
			<td>{{$info->info_title}}</td>
		  </tr>
		  <tr>
			<td colspan="2" class="col_3">情報登録日 <span class="required">必須</span></td>
			<td>{{$info->info_year}}年{{$info->info_month}}月{{$info->info_day}}日</td>
		  </tr>
		  <tr>
			<td colspan="2" class="col_3">サムネイル画像</td>
			<td>
				@if(!empty($info->info_list_img))
				<a href="{{ asset('public') }}{{$info->info_list_img}}" target="_blank" >画像ビュー</a>
				@else
				なし
				@endif
			</td>
		  </tr>
		  <tr>
			<td colspan="2" class="col_3">TOP用文章</td>
			<td>{{$info->info_list_txt}}</td>
		  </tr>
		  <tr>
			<td colspan="2" class="col_3">お知らせカテゴリ</td>
			<td>
				@if($info->info_cat == 1)
				お知らせ
				@elseif($info->info_cat == 2)
				イベント
				@else
					お勧め商品
				@endif
			</td>
		  </tr>
		  <tr>
			<td colspan="2" class="col_3">タイプ <span class="required">必須</span></td>
			<td><table width="100%" border="0" cellspacing="0" cellpadding="3">
			  <tbody>
			  @if($info->info_type == 1)
				<tr>
					<td>タイプ1：タイトルをクリックすると指定URLを表示</td>
				</tr>
			  @elseif($info->info_type == 2)
			  	<tr>
				  <td>タイプ2：タイトルをクリックすると指定ファイルを表示</td>
				</tr>
			  @else
			  <tr>
				 <td>タイプ3：タイトルをクリックすると詳細ページを表示</td>
				</tr>
			  @endif

			  </tbody>
			</table>
			</td>
		  </tr>

		@if($info->info_type == 1)
		  <tr>
			<td width="10%" class="col_3">タイプ1</td>
			<td width="15%" class="col_3">リンク先URL</td>
			<td>{{$info->info1_url}}</td>
		  </tr>
		@elseif($info->info_type == 2)
		  <tr>
			<td width="10%" class="col_3">タイプ2</td>
			<td width="15%" class="col_3">表示ファイル</td>
			<td>
				@if(!empty($info->info2_file))
				<a href="{{ asset('public') }}{{$info->info2_file}}" target="_blank" >ファイルビュー</a>
				@else
				なし
				@endif
			</td>
		  </tr>
		@else
		  <tr>
			<td width="10%" rowspan="4" class="col_3">タイプ3</td>
			<td width="15%" class="col_3">詳細</td>
			<td>{!! html_entity_decode($info->info3_contents) !!}</td>
		  </tr>

		  <tr>
			<td width="15%" class="col_3">画像</td>
			<td>
				@if(!empty($info->info3_img))
				<a href="{{ asset('public') }}{{$info->info3_img}}" target="_blank" >画像ビュー</a>
				@else
				なし
				@endif
			</td>
		  </tr>

		  <tr>
			<td width="15%" class="col_3">ファイル</td>
			<td>
				@if(!empty($info->info3_file))
				<a href="{{ asset('public') }}{{$info->info3_file}}" target="_blank" >ファイルビュー</a>
				@else
				なし
				@endif
			</td>
		  </tr>

		  <tr>
			<td width="15%" class="col_3">ファイル名</td>
			<td>{{$info->info3_filename}}</td>
		  </tr>
		@endif
		  <tr>
			<td colspan="2" class="col_3">表示／非表示</td>
			<td>
				@if(isset($info->info_dspl_flag) && $info->info_dspl_flag == 1)
				表示しない
				@else
				表示する
				@endif
			</td>
		  </tr>

		  <tr>
			<td colspan="2" class="col_3">TOP表示設定</td>
			<td>
				@if(isset($info->info_top_flag) && $info->info_top_flag == 1)
				常にTOPに表示する
				@else
				設定なし
				@endif
			</td>
		  </tr>
		  <tr>
			<td width="10%" rowspan="2" class="col_3">タイマー</td>
			<td width="15%" class="col_3">開始日時：</td>
			<td>
				@if(!empty($info->year_start) &&  !empty($info->month_start) && !empty($info->day_start))
				{{$info->year_start}}年{{$info->month_start}}月{{$info->day_start}}日
				@endif
				@if(!empty($info->hour_start) &&  !empty($info->minute_start) )
				  {{$info->hour_start}}時{{$info->minute_start}}分
				@endif
		<br></td>
	  </tr>
	  
	  <tr>
	  <td width="15%" class="col_3">終了日時：</td>
	  <td>
	  	@if(!empty($info->year_end) &&  !empty($info->month_end) && !empty($info->day_end))
		{{$info->year_end}}年{{$info->month_end}}月{{$info->day_end}}日
		@endif
		@if(!empty($info->hour_end) &&  !empty($info->minute_end) )
		  {{$info->hour_end}}時{{$info->minute_end}}分
		@endif

		</td>
	  </tr>
	</tbody>
	  </table></td>
	</tr>
	<tr>
	  <td align="center">
		<input type="button" onClick="location.href='{{route('backend.infos.edit_save', $info_id)}}'" id="btn-save" value="保存する">
		<input type="button" id="btn_back" onClick="location.href='{{route('backend.infos.edit_back', $info_id)}}'" value="戻る">
	   </td>
	</tr>
	<tr>
	  <td align="center">&nbsp;</td>
	</tr>
	{!! Form::close() !!}
	<tr>
	  <td>&nbsp;</td>
	</tr>
  </tbody>
</table>

@endsection
