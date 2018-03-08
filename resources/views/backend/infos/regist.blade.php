@extends('backend.layouts.app')
@section('content')
{!! Form::open(array('route' => ['backend.infos.regist'], 'class' => 'form-horizontal', 'method' => 'post','id'=>'frmUpload', 'enctype'=>'multipart/form-data', 'accept-charset'=>'utf-8')) !!}
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
              <td><input name="info_title" type="text" id="info_title" size="60" value="{{old('info_title')}}">
                  <span class="caution" id="error_title">
                  @if ($errors->first('info_title'))
                     {{$errors->first('info_title')}}
                  @endif</span>                
              </td>
            </tr>
            <tr>
              <td colspan="2" class="col_3">情報登録日</td>
              <td><select name="info_year" id="info_year">
                  <option value="">----年</option>
                  @for( $y=(date('Y')-3); $y<= (date('Y') + 3); $y++ )
                    <option value="{{$y}}" @if(old('info_year') == $y) selected @endif > {{$y}}年</option>
                  @endfor
                </select>
                <select name="info_month" id="info_month">
                  <option value="">--月</option>
                  @for( $m=1; $m<= 12; $m++ )
                    <option value="{{c2digit($m)}}" @if(old('info_month') == c2digit($m)) selected @endif >{{c2digit($m)}}月</option>
                  @endfor
                </select>
                <select name="info_day" id="info_day">
                  <option value="">--日</option>
                   @for( $d=1; $d<= 31; $d++ )
                  <option value="{{c2digit($d)}}" @if(old('info_day') == c2digit($d) ) selected @endif >{{c2digit($d)}}日</option>
                  @endfor
                </select>
                <select  name="info_hour" id="info_hour">
                  <option value=""  selected>--時</option>
                  <option value="00" @if(old('info_hour') == '00' ) selected @endif >00時</option>
                    @for( $hour=1; $hour<= 23; $hour++ )
                      <option value="{{c2digit($hour)}}" @if(old('info_hour') == c2digit($hour) ) selected @endif >{{c2digit($hour)}}時</option>
                    @endfor
                 
                </select>
                <select name="info_minute"  id="info_minute">
                  <option value="" selected>--分</option>
                   <option value="00" @if(old('info_minute') == '00' ) selected @endif >00分</option>
                     @for( $min=1; $min<= 59; $min++ )
                      <option value="{{c2digit($min)}}" @if(old('info_minute') == c2digit($min) ) selected @endif >{{c2digit($min)}}分</option>
                    @endfor                  
                </select>
                <!--<span class="caution">※この日時の順に表示されます（一般側画面には時間は表示されません）。<br />
                ※指定しない場合は、現在の日時が自動的に選択されます。</span>-->
                <span class="caution" id="error_date">
                  @if ($errors->first('info_year'))
                 {{$errors->first('info_year')}}
                @endif

                @if ($errors->first('info_month'))
                 {{$errors->first('info_month')}}
                @endif

                @if ($errors->first('info_day'))
                 {{$errors->first('info_day')}}
                @endif
                </span>
               </td>
            </tr>
            <tr>
              <td colspan="2" class="col_3">タイプ</td>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="3">
                  <tbody>
                    <tr>
                      <td width="1%"><input type="radio" name="info_type" id="info_type1" value="1" @if(old('info_type') == 1) checked @endif ></td>
                      <td>タイプ1：タイトルをクリックすると指定URLを表示</td>
                    </tr>
                    <tr>
                      <td width="1%"><input type="radio" name="info_type" id="info_type2" value="2" @if(old('info_type') == 2) checked @endif></td>
                      <td>タイプ2：タイトルをクリックすると指定ファイルを表示</td>
                    </tr>
                    <tr>
                      <td width="1%"><input type="radio" name="info_type" id="info_type3" value="3" @if(old('info_type') == 3) checked @endif></td>
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
              <td><input name="info1_url" type="text" id="info1_url" size="60" value="{{old('info1_url')}}" >
                <span class="caution" id="error_info1_url">
                  @if ($errors->first('info1_url'))
                     {{$errors->first('info1_url')}}
                  @endif
                </span>  
               </td>
            </tr>
            <tr>
              <td width="10%" class="col_3">タイプ2</td>
              <td width="15%" class="col_3">表示ファイル</td>
              <td>@if(old('info2_file'))
                  <a href="{{ asset('public') }}{{old('info2_file')}}" target="_blank" title="">ファイルビュー</a>
                  @endif
                  <input type="file" name="info2_file" id="info2_file" multiple value="{{old('info2_file')}}">
                  <input type="hidden" name="info2_file_old" value="{{old('info2_file')}}">
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
              <td><textarea name="info3_contents" id="info3_contents" rows="8" >@if(old('info3_contents')){{old('info3_contents')}}@endif</textarea></td>
            </tr>
            <tr>
              <td width="15%" class="col_3">画像</td>
              <td>@if(old('info3_imgfile'))
              <a href="{{ asset('public') }}{{old('info3_imgfile')}}" target="_blank" title="">画像ビュー</a>
              @endif
            <input type="file" name="info3_imgfile" id="info3_imgfile" value="{{old('info3_imgfile')}}">
            <input type="hidden" name="info3_imgfile_old" value="{{old('info3_imgfile')}}"></td>
            </tr>
            <tr>
              <td class="col_3">関連リンクURL</td>
              <td><input name="info3_url" type="text" id="info3_url" size="60" value="{{old('info3_url')}}"></td>
            </tr>
            <tr>
              <td class="col_3">関連メールアドレス</td>
              <td><input name="info3_mail" type="text" id="info3_mail" size="60" value="{{old('info3_mail')}}"></td>
            </tr>
            <tr>
              <td width="18%" class="col_3">関連ファイル</td>
              <td> @if(old('info3_file'))
              <a href="{{ asset('public') }}{{old('info3_file')}}" target="_blank" title="">ファイルビュー</a>
              @endif
                <input type="file" name="info3_file" id="info3_file" multiple value="{{old('info3_file')}}">
                <input type="hidden" name="info3_file_old" value="{{old('info3_file')}}">
                @if ($errors->first('info3_file'))
                  <span class="caution"> {{$errors->first('info3_file')}}</span>
                @endif</td>
            </tr>
            <tr>
              <td class="col_3">　└関連ファイル名</td>
              <td><input name="info3_filename" type="text" id="info3_filename" size="60"></td>
            </tr>
            <tr>
              <td colspan="2" class="col_3">表示／非表示</td>
              <td><input type="checkbox" name="info_dspl_flag" id="info_dspl_flag" value="1" @if( !empty(old('info_dspl_flag')) && old('info_dspl_flag') == 1 ) checked @endif>
                一時的に非表示にする</td>
            </tr>
            <tr>
              <td colspan="2" class="col_3">TOP表示設定</td>
              <td><input type="checkbox" name="info_top_flag" value="1" id="info_top_flag" @if( !empty(old('info_top_flag')) && old('info_top_flag') == 1 ) checked @endif>
                常にTOPに表示する</td>
            </tr>
            <tr>
              <td width="10%" rowspan="2" class="col_3">タイマー</td>
              <td width="15%" class="col_3">開始日時：</td>
              <td><select name="year_start" id="year_start">
                  <option value="" @if(old('year_start') == '') selected @endif>----年</option>
                  @for( $y=(date('Y')-3); $y<= (date('Y') + 3); $y++ )
                    <option value="{{$y}}" @if(old('year_start') == $y) selected @endif >{{$y}}年</option>
                    @endfor
                </select>
                <select name="month_start" id="month_start">
                  <option value="" @if(old('month_start') == '') selected @endif>--月</option>
                   @for( $m=1; $m<= 12; $m++ )
                    <option value="{{c2digit($m)}}" @if(old('month_start') == c2digit($m)) selected @endif >{{c2digit($m)}}月</option>
                  @endfor
                </select>
                <select name="day_start" id="day_start">
                  <option value="" @if(old('day_start') == '') selected @endif>--日</option>
                  @for( $d=1; $d<= 31; $d++ )
                    <option value="{{c2digit($d)}}" @if(old('day_start') == c2digit($d) ) selected @endif >{{c2digit($d)}}日</option>
                  @endfor
                </select>
                <select name="hour_start" id="hour_start">
                  <option value="" @if(old('hour_start') == '' ) selected @endif>--時</option>
                  <option value="00" @if(old('hour_start') == '00' ) selected @endif>00時</option>
                   @for( $hour=1; $hour<= 23; $hour++ )
                    <option value="{{c2digit($hour)}}" @if(old('hour_start') == c2digit($hour) ) selected @endif >{{c2digit($hour)}}時</option>
                  @endfor
                  </select>
                  <select name="minute_start" id="minute_start">
                  <option value="" @if(old('minute_start') == '' ) selected @endif >--分</option>
                  <option value="00" @if(old('minute_start') == '00' ) selected @endif >00分</option>
                  @for( $min=1; $min<= 59; $min++ )
                    <option value="{{c2digit($min)}}" @if(old('minute_start') == c2digit($min) ) selected @endif >{{c2digit($min)}}分</option>
                  @endfor
                  </select>
                <br></td>
            </tr>
            <tr>
              <td width="15%" class="col_3">終了日時：</td>
              <td><select name="year_end" id="year_end">
                    <option value="" @if(old('year_end') == '') selected @endif >----年</option>
                    @for( $y=(date('Y')-3); $y<= (date('Y') + 3); $y++ )
                    <option value="{{$y}}" @if(old('year_end') == $y) selected @endif >{{$y}}年</option>
                    @endfor
                  </select>
                    <select name="month_end" id="month_end">
                    <option value="" @if(old('month_end') == '' ) selected @endif>--月</option>
                    @for( $m=1; $m<= 12; $m++ )
                      <option value="{{c2digit($m)}}" @if(old('month_end') == c2digit($m) ) selected @endif >{{c2digit($m)}}月</option>
                    @endfor
                    </select>
                    <select name="day_end" id="day_end">
                    <option value="" @if(old('day_end') == '' ) selected @endif>--日</option>
                    @for( $d=1; $d<= 31; $d++ )
                      <option value="{{c2digit($d)}}" @if(old('day_end') == c2digit($d) ) selected @endif >{{c2digit($d)}}日</option>
                    @endfor
                    </select>                  　
                  <select name="hour_end" id="hour_end">
                    <option value="" @if(old('hour_end') == '' ) selected @endif >--時</option>
                    <option value="00" @if(old('hour_end') == '00' ) selected @endif >00時</option>
                    @for( $hour=1; $hour<= 23; $hour++ )
                      <option value="{{c2digit($hour)}}" @if(old('hour_end') == c2digit($hour) ) selected @endif >{{c2digit($hour)}}時</option>
                    @endfor
                  </select>
                  <select name="minute_end" id="minute_end">
                    <option value="" @if(old('minute_end') == '' ) selected @endif >--分</option>
                    <option value="00" @if(old('minute_end') == '00' ) selected @endif >00分</option>
                     @for( $min=1; $min<= 59; $min++ )
                      <option value="{{c2digit($min)}}" @if(old('minute_end') == c2digit($min) ) selected @endif >{{c2digit($min)}}分</option>
                    @endfor
                  </select>
        </td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><input  name="btn-submit"  type="button" id="btn-submit" value="登録する" >
        <input type="reset" name="reset" id="reset" value="クリア"></td>
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
