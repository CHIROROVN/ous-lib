@extends('backend.layouts.app')
@section('content')
{!! Form::open(array('route' => ['backend.infos.edit', $info_id], 'class' => 'form-horizontal','id'=>'frmUpload', 'method' => 'post', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
<table width="960" border="0" align="center" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td width="150%" class="col_1">■岡山理科大学図書館 Website 管理画面　＞　「お知らせ」管理　＞　登録済み情報の変更</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
        <tbody>
          <tr>
            <td colspan="2" class="col_3">タイトル</td>
            <td><input name="info_title" type="text" id="info_title" size="60" value="@if(old('info_title')){{old('info_title')}}@else{{$info->info_title}}@endif">
                <span class="caution" id="error_title">
                @if ($errors->first('info_title'))
                {{$errors->first('info_title')}}
                @endif
                </span> 
            </td>
          </tr>
          <tr>
            <td colspan="2" class="col_3">情報登録日</td>
            <td><select name="info_year" id="info_year">
              <option value="">----年</option>
              @for( $y=(date('Y')-3); $y<= (date('Y') + 3); $y++ )               
                <option value="{{$y}}" @if( (old('info_year') == $y) || split_date($info->info_date, 'Y') == $y ) selected @endif > {{$y}}年</option>                
                @endfor
            </select>
              <select name="info_month" id="info_month">
                <option value="">--月</option>
                 @for( $m=1; $m<= 12; $m++ )
                  <option value="{{c2digit($m)}}" @if(old('info_month') == c2digit($m) || split_date($info->info_date, 'm') == c2digit($m)) selected @endif >{{c2digit($m)}}月</option>
                @endfor
              </select>
              <select name="info_day" id="info_day">
                <option value="">--日</option>
                @for( $d=1; $d<= 31; $d++ )
                  <option value="{{c2digit($d)}}" @if(old('info_day') == c2digit($d) || split_date($info->info_date, 'd') == c2digit($d)) selected @endif >{{c2digit($d)}}日</option>
                @endfor
              </select>
              <select  name="info_hour" id="info_hour" >
                <option value="" >--時</option>
                <option value="00" @if(old('info_hour') == '00' ) selected @endif >00時</option>
                    @for( $hour=1; $hour<= 23; $hour++ )
                      <option value="{{c2digit($hour)}}" @if(old('info_hour') == c2digit($hour) || split_date($info->info_date, 'H') == c2digit($hour)) selected @endif >{{c2digit($hour)}}時</option>
                    @endfor
              </select>
              <select name="info_minute"  id="info_minute">
                <option value="" >--分</option>
                <option value="00" @if(old('info_minute') == '00' ) selected @endif >00分</option>
                     @for( $min=1; $min<= 59; $min++ )
                      <option value="{{c2digit($min)}}" @if(old('info_minute') == c2digit($min) || split_date($info->info_date, 'i')== c2digit($min))  selected @endif >{{c2digit($min)}}分</option>
                    @endfor
              </select>
              <span class="caution" id="error_date">
                 @if ($errors->first('info_year'))
                 {{$errors->first('info_year')}}<br>
                @endif
                @if ($errors->first('info_month'))
                 {{$errors->first('info_month')}}<br>
                @endif
                @if ($errors->first('info_day'))
                 {{$errors->first('info_day')}}<br>
                @endif
              </span>  
              </td>
          </tr>
          <tr>
            <td colspan="2" class="col_3">タイプ</td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tbody>
                <tr>
                  <td width="1%"><input type="radio" name="info_type" id="info_type1" value="1" @if(old('info_type') == 1 || $info->info_type == 1) checked @endif ></td>
                  <td>タイプ1：タイトルをクリックすると指定URLを表示</td>
                </tr>
                <tr>
                  <td width="1%"><input type="radio" name="info_type" id="info_type2" value="2" @if(old('info_type') == 2 || $info->info_type == 2) checked @endif ></td>
                  <td>タイプ2：タイトルをクリックすると指定ファイルを表示</td>
                </tr>
                <tr>
                  <td width="1%"><input type="radio" name="info_type" id="info_type3" value="3" @if(old('info_type') == 3 || $info->info_type == 3) checked @endif ></td>
                  <td>タイプ3：タイトルをクリックすると詳細ページを表示</td>
                </tr>
              </tbody>
            </table>
            <span class="caution" id="error_type"> 
                @if ($errors->first('info_type'))
                 {{$errors->first('info_type')}}
                @endif
            </span>    
            </td>
          </tr>
          <tr>
            <td width="10%" class="col_3">タイプ1</td>
            <td width="15%" class="col_3">リンク先URL</td>
            <td><input name="info1_url" type="text" id="info1_url" size="60" value="@if(old('info1_url')){{old('info1_url')}}@else{{$info->info1_url}}@endif">
                <span class="caution" id="error_info1_url">
                @if ($errors->first('info1_url'))
                {{$errors->first('info1_url')}}
                @endif
              </span>  </td>
          </tr>
          <tr>
            <td width="10%" class="col_3">タイプ2</td>
            <td width="15%" class="col_3">表示ファイル</td>
            <td><input type="radio" name="info2_file_radio"  id="rdType_2_1" value="1">
                新しいファイルに置き換える　  
                  
                  <input type="file" name="info2_file" id="info2_file" value="{{old('info2_file')}}">
                  <input type="hidden" name="info2_file_old" value="@if(old('info2_file')){{old('info2_file')}}@else{{$info->info2_file}}@endif">
                  <br>
                  <input type="radio" name="info2_file_radio" value="2" checked id="rdType_2_3">
                 すでにアップロード済みのファイルを使う
                              （@if(old('info2_file'))
                          <a href="{{ asset('public') }}{{old('info2_file')}}"  target="_blank" title="">ファイルビュー</a>
                        @elseif(!empty($info->info2_file))
                          <a href="{{ asset('public') }}{{$info->info2_file}}" target="_blank" title="">ファイルビュー</a>
                        @else
                          なし
                        @endif ）<br>
                  <input type="radio" name="info2_file_radio" value="3" >  アップロード済みファイルを削除する               
              &nbsp;&nbsp;&nbsp;              
              <span class="caution" id="error_info2_file">
              @if ($errors->first('info2_file'))
                 {{$errors->first('info2_file')}}
              @endif
            </span>
            </td>
          </tr>
          <tr>
            <td width="10%" rowspan="6" class="col_3">タイプ3</td>
            <td width="15%" class="col_3">詳細</td>
            <td><textarea name="info3_contents" id="info3_contents" rows="8" >@if(old('info3_contents')){{old('info3_contents')}}@else{{$info->info3_contents}}@endif</textarea>
              <span class="caution" id="error_info3_contents">
              @if ($errors->first('info3_contents'))
                {{$errors->first('info3_contents')}}
              @endif
              </span>
            </td>
          </tr>
          <tr>
            <td width="18%" class="col_3">画像</td>
            <td><input type="radio" name="info3_img1_radio" value="1" >
                新しい画像に置き換える　
                <input type="file" name="info3_img" id="info3_img" value="{{old('info3_imgfile')}}">
                <input type="hidden" name="info3_img_old" value="@if(old('info3_imgfile')){{old('info3_imgfile')}}@else{{$info->info3_imgfile}}@endif">
              <br>
              <input type="radio" name="info3_img1_radio" value="2" checked> すでにアップロード済みの画像を使う
              （@if(old('info3_imgfile'))
                <a href="{{ asset('public') }}{{old('info3_imgfile')}}"  target="_blank" title="">表示</a>
                @elseif(!empty($info->info3_imgfile))
                  <a href="{{ asset('public') }}{{$info->info3_imgfile}}" target="_blank" title="">表示</a>
                @else
                  なし
                @endif ）<br>
              <input type="radio" name="info3_img1_radio" value="3" >
              アップロード済み画像を削除する</td>
          </tr>
          <tr>
            <td class="col_3">関連リンクURL</td>
            <td><input name="info3_url" type="text" id="info3_url" type="text"  size="60" value="@if(old('info3_url')){{old('info3_url')}}@else{{$info->info3_url}}@endif"></td>
          </tr>
          <tr>
            <td class="col_3">関連メールアドレス</td>
            <td><input name="info3_mail" type="text" id="info3_mail"  size="60" value="@if(old('info3_mail')){{old('info3_mail')}}@else{{$info->info3_mail}}@endif"></td>
          </tr>
          <tr>
            <td width="15%" class="col_3">関連ファイル</td>
            <td><input type="radio" name="prmFileMode6" value="replace" >
                新しいファイルに置き換える　
                  <input type="file" name="info3_file" id="info3_file" value="{{old('info3_file')}}">
                  <input type="hidden" name="info3_file_old" value="@if(old('info3_file')){{old('info3_file')}}@else{{$info->info3_file}}@endif">
                  <br>
                  <input type="radio" name="prmFileMode6" value="nowuse" checked>
                すでにアップロード済みのファイルを使う
              （@if(old('info3_file'))
                <a href="{{ asset('public') }}{{old('info3_file')}}"  target="_blank" title="">表示</a>
              @elseif(!empty($info->info3_file))
                <a href="{{ asset('public') }}{{$info->info3_file}}" target="_blank" title="">表示</a>
              @else
                なし
              @endif ）<br>
              <input type="radio" name="prmFileMode6" value="replace" >
                アップロード済みファイルを削除する
            </td>
          </tr>
          <tr>
            <td class="col_3">　└関連ファイル名</td>
            <td><input name="info3_filename" type="text" id="info3_filename" size="60" value="@if(old('info3_filename')){{old('info3_filename')}}@else{{$info->info3_filename}}@endif"></td>
          </tr>
          <tr>
            <td colspan="2" class="col_3">表示／非表示</td>
            <td><input type="checkbox" name="info_dspl_flag" id="info_dspl_flag" value="1" @if( !empty(old('info_dspl_flag')) && old('info_dspl_flag') == 1 ) checked @elseif($info->info_dspl_flag == 1) checked @endif > 一時的に非表示にする</td>
          </tr>
          <tr>
            <td colspan="2" class="col_3">TOP表示設定</td>
            <td><input type="checkbox" name="info_top_flag" value="1" id="info_top_flag" @if( !empty(old('info_top_flag')) && old('info_top_flag') == 1 || $info->info_top_flag == 1) checked @endif >              
            常にTOPに表示する</td>
          </tr>
          <tr>
            <td width="10%" rowspan="2" class="col_3">タイマー</td>
            <td width="15%" class="col_3">開始日時：</td>
            <td><select name="year_start" id="year_start">
              <option value="" @if(old('year_start') == '') selected @endif>----年</option>
              @for( $y=(date('Y')-3); $y<= (date('Y') + 3); $y++ )
                <option value="{{$y}}" @if(old('year_start') == $y || split_date($info->info_start, 'Y') == $y) selected @endif >{{$y}}年</option>
                @endfor
            </select>              
              <select name="month_start" id="month_start">
                <option value="" @if(old('month_start') == '') selected @endif>--月</option>
                @for( $m=1; $m<= 12; $m++ )
                  <option value="{{c2digit($m)}}" @if(old('month_start') == c2digit($m) || split_date($info->info_start, 'm') == c2digit($m) ) selected @endif >{{c2digit($m)}}月</option>
                @endfor
              </select>
              <select name="day_start" id="day_start">
                <option value="" @if(old('day_start') == '' ) selected @endif>--日</option>
                @for( $d=1; $d<= 31; $d++ )
                  <option value="{{c2digit($d)}}" @if(old('day_start') == c2digit($d) || split_date($info->info_start, 'd') == c2digit($d) ) selected @endif >{{c2digit($d)}}日</option>
                @endfor
              </select>
              　
              <select name="hour_start" id="hour_start">
                <option value="" @if(old('hour_start') == '' ) selected @endif>--時</option>
                <option value="00" @if(old('hour_start') == '00' || old('hour_start') == '0' || split_date($info->info_start, 'H') == '0') selected @endif>00時</option>
                 @for( $hour=1; $hour<= 23; $hour++ )
              <option value="{{c2digit($hour)}}" @if(old('hour_start') == c2digit($hour) || split_date($info->info_start, 'H') == c2digit($hour)) selected @endif >{{c2digit($hour)}}時</option>
              @endfor
              </select>              
              <select name="minute_start" id="minute_start">
                <option value="" @if(old('minute_start') == '' ) selected @endif>--分</option>
                <option value="00" @if(old('minute_start') == '00' || old('minute_start') == '0' || split_date($info->info_start, 'i') == '0') selected @endif >00分</option>
              @for( $min=1; $min<= 59; $min++ )
                <option value="{{c2digit($min)}}" @if(old('minute_start') == c2digit($min) || split_date($info->info_start, 'i') == c2digit($min)) selected @endif >{{c2digit($min)}}分</option>
              @endfor
              </select>
              <br></td>
          </tr>
          <tr>
            <td width="15%" class="col_3">終了日時：</td>
            <td><select name="year_end" id="year_end">
              <option value="" @if(old('year_end') == '') selected @endif >----年</option>
            @for( $y=(date('Y')-3); $y<= (date('Y') + 3); $y++ )
            <option value="{{$y}}" @if(old('year_end') == $y || split_date($info->info_end, 'Y') == $y) selected @endif >{{$y}}年</option>
            @endfor
            </select>
              <select name="month_end" id="month_end">
                <option value="" @if(old('month_end') == '' ) selected @endif>--月</option>
            @for( $m=1; $m<= 12; $m++ )
              <option value="{{c2digit($m)}}" @if(old('month_end') == c2digit($m) || split_date($info->info_end, 'm') == c2digit($m)) selected @endif >{{c2digit($m)}}月</option>
            @endfor
              </select>
              <select name="day_end" id="day_end">
               <option value="" @if(old('day_end') == '' ) selected @endif>--日</option>
            @for( $d=1; $d<= 31; $d++ )
              <option value="{{c2digit($d)}}" @if(old('day_end') == c2digit($d) || split_date($info->info_end, 'd') == c2digit($d)) selected @endif >{{c2digit($d)}}日</option>
            @endfor
              </select>
　
              <select name="hour_end" id="hour_end">
                <option value="00" @if(old('hour_end') == '00' || old('hour_end') == '0' || split_date($info->info_end, 'H') == '0') selected @endif >00時</option>
            @for( $hour=1; $hour<= 23; $hour++ )
              <option value="{{c2digit($hour)}}" @if(old('hour_end') == c2digit($hour) || split_date($info->info_end, 'H') == c2digit($hour)) selected @endif >{{c2digit($hour)}}時</option>
            @endfor
              </select>
              <select name="minute_end" id="minute_end">
                <option value="" @if(old('minute_end') == '' ) selected @endif >--分</option>
            <option value="00" @if(old('minute_end') == '00' || old('minute_end') == '0' || split_date($info->info_end, 'i') == '0') selected @endif >00分</option>
             @for( $min=1; $min<= 59; $min++ )
              <option value="{{c2digit($min)}}" @if(old('minute_end') == c2digit($min) || split_date($info->info_end, 'i') == c2digit($min)) selected @endif >{{c2digit($min)}}分</option>
            @endfor
              </select></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><input name="btn-submit"  type="button" id="btn-submit" value="変更する" ><input type="reset" name="reset" id="reset" value="もどる" onclick="javascript:window.history.back(-1);return false;"></td>
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
<script>
   $("#btn-submit").on("click",function() {
     var flag = true;  
     if (!$("#info_title").val().replace(/ /g, "")) {  
        $("#error_title").html('<?php echo $error['error_info_title_required']?>');      
        flag = false;  
      }  
       
      if(!$("#info_year").val().replace(/ /g, "") || !$("#info_month").val().replace(/ /g, "")  || !$("#info_day").val().replace(/ /g, "")){
        $("#error_date").html('<?php echo $error['error_info_year_required']?>');
        flag = false;  
      }     
      
      if(!$("input[name='info_type']:checked").is(':checked')){
        $("#error_type").html('<?php echo $error['error_info_type_required']?>');                    
         flag = false; 
      }else{
         info_type = $("input[name='info_type']:checked").val(); 
         if(info_type==1 && !$("#info1_url").val().replace(/ /g, "")){
            $("#error_info1_url").html('<?php echo $error['error_info1_url_required']?>'); 
            flag = false;
         }else if(info_type==2 && (!$("#info2_file").val().replace(/ /g, ""))){
            $("#error_info2_file").html('<?php echo $error['error_info2_file_required']?>'); 
            flag = false;
         }
      }
      
    if(flag)   $( "#frmUpload" ).submit(); 
  });  
  $(document).ready(function(){
    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();

    $("#btn_now").click(function(){
        $('#info_year option[value="' + year + '"]').prop('selected', true);
        $('#info_month option[value="' + c2Digit(month) + '"]').prop('selected', true);
        $('#info_day option[value="' + c2Digit(day) + '"]').prop('selected', true);
    });
  });

  function c2Digit(num){
    return (num < 10? '0' : '') + num;
  }
</script>

@endsection
