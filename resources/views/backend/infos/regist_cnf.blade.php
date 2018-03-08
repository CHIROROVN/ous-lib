@extends('backend.layouts.app')
@section('content')
{!! Form::open(array('route' => ['backend.infos.regist'], 'class' => 'form-horizontal', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
<table width="960" border="0" align="center" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td width="150%" class="col_1">■岡山理科大学図書館 Website 管理画面　＞　「お知らせ」管理　＞　新規登録</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
          <tbody>
            <tr>
              <td colspan="2" class="col_3">タイトル</td>
              <td>{{$info->info_title}}</td>
            </tr>
            <tr>
              <td colspan="2" class="col_3">情報登録日</td>
              <td>{{$info->info_year}}年{{$info->info_month}}月{{$info->info_day}}日{{$info->info_hour}}時{{$info->info_minute}}分</td>
            </tr>
            <tr>
              <td colspan="2" class="col_3">タイプ</td>
              <td>@if($info->info_type == 1)
              	    タイプ1：タイトルをクリックすると指定URLを表示
              	  @elseif($info->info_type == 2)
              	    タイプ2：タイトルをクリックすると指定ファイルを表示
              	  @else 
              		タイプ3：タイトルをクリックすると詳細ページを表示
              	  @endif</td>
            </tr>
            <tr>
              <td width="10%" class="col_3">タイプ1</td>
              <td width="15%" class="col_3">リンク先URL</td>
              <td>@if($info->info_type == 1) {{$info->info1_url}} @endif</td>
            </tr>
            <tr>
              <td width="10%" class="col_3">タイプ2</td>
              <td width="15%" class="col_3">表示ファイル</td>
              <td>@if(!empty($info->info2_file))
          				<a href="{{ asset('public') }}{{$info->info2_file}}" target="_blank" title="">ファイルビュー</a>
          				@else
          				なし
          				@endif
              </td>
            </tr>
            <tr>
              <td width="10%" rowspan="6" class="col_3">タイプ3</td>
              <td width="15%" class="col_3">詳細</td>
              <td>@if($info->info_type == 3) {{$info->info3_contents}} @endif</td>
            </tr>
            <tr>
              <td width="15%" class="col_3">画像</td>
              <td><a href="#">@if(!empty($info->info3_imgfile))
          				<a href="{{ asset('public') }}{{$info->info3_imgfile}}" target="_blank" >画像ビュー</a>
          				@else
          				なし
          				@endif</a>
              </td>
            </tr>
            <tr>
              <td class="col_3">関連リンクURL</td>
              <td>@if($info->info_type == 3) {{$info->info3_url}} @endif</td>
            </tr>
            <tr>
              <td class="col_3">関連メールアドレス</td>
              <td>@if($info->info_type == 3) {{$info->info3_mail}} @endif</td>
            </tr>
            <tr>
              <td width="18%" class="col_3">関連ファイル</td>
              <td><a href="#">@if(!empty($info->info3_file))
          				<a href="{{ asset('public') }}{{$info->info3_file}}" target="_blank" >ファイルビュー</a>
          				@else
          				なし
          				@endif</a></td>
            </tr>
            <tr>
              <td class="col_3">　└関連ファイル名</td>
              <td>@if($info->info_type == 3) {{$info->info3_filename}} @endif</td>
            </tr>
            <tr>
              <td colspan="2" class="col_3">表示／非表示</td>
              <td>@if(isset($info->info_dspl_flag) && $info->info_dspl_flag == 1)
          				表示しない
          				@else
          				表示する
          				@endif</td>
            </tr>
            <tr>
              <td colspan="2" class="col_3">TOP表示設定</td>
              <td>@if(isset($info->info_top_flag) && $info->info_top_flag == 1)
          				常にTOPに表示する
          				@else
          				設定なし
          				@endif</td>
            </tr>
            <tr>
              <td width="10%" rowspan="2" class="col_3">タイマー</td>
              <td width="15%" class="col_3">開始日時：</td>
              <td>@if(!empty($info->year_start) &&  !empty($info->month_start) && !empty($info->day_start))
          				{{$info->year_start}}年{{$info->month_start}}月{{$info->day_start}}日
          				@endif
          				@if(!empty($info->hour_start) &&  !empty($info->minute_start) )
          				  {{$info->hour_start}}時{{$info->minute_start}}分
          				@endif<br></td>
            </tr>
            <tr>
              <td width="15%" class="col_3">終了日時：</td>
              <td>@if(!empty($info->year_end) &&  !empty($info->month_end) && !empty($info->day_end))
              		{{$info->year_end}}年{{$info->month_end}}月{{$info->day_end}}日
              		@endif
              		@if(!empty($info->hour_end) &&  !empty($info->minute_end) )
              		  {{$info->hour_end}}時{{$info->minute_end}}分
              		@endif</td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><input type="button" name="button2" id="button2" value="登録する（確認済み）" onClick="location.href='{{route('backend.infos.regist_save')}}'">
      <input type="button" name="button" id="button" value="もどる" onClick="location.href='{{route('backend.infos.regist_back')}}'"></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><input type="button" onClick="location.href='{{route('backend.infos.index')}}'" value="「お知らせ」一覧に戻る"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
{!! Form::close() !!}
@endsection
