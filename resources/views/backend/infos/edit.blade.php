
@extends('backend.layouts.app')

@section('content')

<table width="960" border="0" align="center" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td width="150%" class="col_1">■敷島堂 Website 管理画面　＞　「お知らせ」管理　＞　情報編集</td>
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
            <td><input name="info_title" type="text" id="info_title" size="60" value="@if(old('info_title')){{old('info_title')}}@else{{$info->info_title}}@endif">
                @if ($errors->first('info_title'))
                <div class="error-text"> {{$errors->first('info_title')}}</div>
                @endif
            </td>
          </tr>
          <tr>
            <td colspan="2" class="col_3">情報登録日 <span class="required">必須</span></td>
            <td>
            <select name="info_year" id="info_year">
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
              　
              <input type="button" name="btn_now" id="btn_now" value="今日">
               @if ($errors->first('info_year'))
                <div class="error-text"> {{$errors->first('info_year')}}</div>
                @endif

                @if ($errors->first('info_month'))
                <div class="error-text"> {{$errors->first('info_month')}}</div>
                @endif

                @if ($errors->first('info_day'))
                <div class="error-text"> {{$errors->first('info_day')}}</div>
                @endif
                </td>
          </tr>
          <tr>
            <td colspan="2" class="col_3">サムネイル画像</td>
            <td>
              @if(old('info_list_img'))
                <a href="{{ asset('public') }}{{old('info_list_img')}}"  target="_blank" title="">画像ビュー</a>
              @elseif(!empty($info->info_list_img))
                <a href="{{ asset('public') }}{{$info->info_list_img}}" target="_blank" title="">画像ビュー</a>
              @else
                なし
              @endif
              &nbsp;&nbsp;&nbsp;
              <input type="file" name="info_list_img" id="info_list_img" value="{{old('info_list_img')}}">
              <input type="hidden" name="info_list_img_old" value="@if(old('info_list_img')){{old('info_list_img')}}@else{{$info->info_list_img}}@endif">
              　※正方形の画像を指定
                @if ($errors->first('info_list_img'))
                <div class="error-text"> {{$errors->first('info_list_img')}}</div>
                @endif
            </td>
          </tr>
          <tr>
            <td colspan="2" class="col_3">TOP用文章</td>
            <td><input name="info_list_txt" type="text" id="info_list_txt" size="70" value="@if(old('info_list_txt')){{old('info_list_txt')}}@else{{$info->info_list_txt}}@endif">
            </td>
          </tr>
          <tr>
            <td colspan="2" class="col_3">お知らせカテゴリ</td>
            <td><input type="radio" name="info_cat" id="info_cat1" value="1" @if(old('info_cat') == 1 || $info->info_cat == 1) checked @endif >
              お知らせ　　　
              <input type="radio" name="info_cat" id="info_cat2" value="2" @if(old('info_cat') == 2 || $info->info_cat == 2) checked @endif>
              イベント　　　
              <input type="radio" name="info_cat" id="info_cat3" value="3" @if(old('info_cat') == 3 || $info->info_cat == 3) checked @endif>
              お勧め商品</td>
          </tr>
          <tr>
            <td colspan="2" class="col_3">タイプ <span class="required">必須</span></td>
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
                @if ($errors->first('info_type'))
                <div class="error-text"> {{$errors->first('info_type')}}</div>
                @endif
            </td>
          </tr>
          <tr>
            <td width="10%" class="col_3">タイプ1</td>
            <td width="15%" class="col_3">リンク先URL</td>
            <td>
              <input name="info1_url" type="text" id="info1_url" size="60" value="@if(old('info1_url')){{old('info1_url')}}@else{{$info->info1_url}}@endif">
                @if ($errors->first('info1_url'))
                <div class="error-text"> {{$errors->first('info1_url')}}</div>
                @endif
              </td>
          </tr>
          <tr>
            <td width="10%" class="col_3">タイプ2</td>
            <td width="15%" class="col_3">表示ファイル</td>
            <td>
              @if(old('info2_file'))
                <a href="{{ asset('public') }}{{old('info2_file')}}"  target="_blank" title="">ファイルビュー</a>
              @elseif(!empty($info->info2_file))
                <a href="{{ asset('public') }}{{$info->info2_file}}" target="_blank" title="">ファイルビュー</a>
              @else
                なし
              @endif
              &nbsp;&nbsp;&nbsp;
              <input type="file" name="info2_file" id="info2_file" value="{{old('info2_file')}}">
              <input type="hidden" name="info2_file_old" value="@if(old('info2_file')){{old('info2_file')}}@else{{$info->info2_file}}@endif">
              @if ($errors->first('info2_file'))
                <div class="error-text"> {{$errors->first('info2_file')}}</div>
              @endif
            </td>
          </tr>
          <tr>
            <td width="10%" rowspan="4" class="col_3">タイプ3</td>
            <td width="15%" class="col_3">詳細</td>
            <td><textarea name="info3_contents" id="info3_contents" class="info3_contents" rows="4" cols="50" >
              @if(old('info3_contents')){{old('info3_contents')}}@else{{$info->info3_contents}}@endif </textarea>
              @if ($errors->first('info3_contents'))
                <div class="error-text"> {{$errors->first('info3_contents')}}</div>
              @endif
              </td>
          </tr>
          <tr>
            <td width="15%" class="col_3">画像</td>
            <td>             
              @if(old('info3_img'))
                <a href="{{ asset('public') }}{{old('info3_img')}}"  target="_blank" title="">画像ビュー</a>
              @elseif(!empty($info->info3_img))
                <a href="{{ asset('public') }}{{$info->info3_img}}" target="_blank" title="">画像ビュー</a>
              @else
                なし
              @endif
              &nbsp;&nbsp;&nbsp;
              <input type="file" name="info3_img" id="info3_img" value="{{old('info3_img')}}">
              <input type="hidden" name="info3_img_old" value="@if(old('info3_img')){{old('info3_img')}}@else{{$info->info3_img}}@endif">
              @if ($errors->first('info3_img'))
                <div class="error-text"> {{$errors->first('info3_img')}}</div>
                @endif
              </td>
          </tr>
          <tr>
            <td width="15%" class="col_3">ファイル</td>
            <td>
              @if(old('info3_file'))
                <a href="{{ asset('public') }}{{old('info3_file')}}"  target="_blank" title="">画像ビュー</a>
              @elseif(!empty($info->info3_file))
                <a href="{{ asset('public') }}{{$info->info3_file}}" target="_blank" title="">ファイルビュー</a>
              @else
                なし
              @endif
              &nbsp;&nbsp;&nbsp;
            <input type="file" name="info3_file" id="info3_file" value="{{old('info3_file')}}">
            <input type="hidden" name="info3_file_old" value="@if(old('info3_file')){{old('info3_file')}}@else{{$info->info3_file}}@endif">
              @if ($errors->first('info3_file'))
                <div class="error-text"> {{$errors->first('info3_file')}}</div>
              @endif
            </td>
          </tr>
          <tr>
            <td width="15%" class="col_3">ファイル名</td>
            <td><input name="info3_filename" type="text" id="info3_filename" size="60" value="@if(old('info3_filename')){{old('info3_filename')}}@else{{$info->info3_filename}}@endif"></td>
          </tr>
          <tr>
            <td colspan="2" class="col_3">表示／非表示</td>
            <td><input type="checkbox" name="info_dspl_flag" id="info_dspl_flag" value="1" @if( !empty(old('info_dspl_flag')) && old('info_dspl_flag') == 1 ) checked @elseif($info->info_dspl_flag == 1) checked @endif >一時的に非表示にする</td>
          </tr>
          <tr>
            <td colspan="2" class="col_3">TOP表示設定</td>
            <td><input type="checkbox" name="info_top_flag" value="1" id="info_top_flag" @if( !empty(old('info_top_flag')) && old('info_top_flag') == 1 || $info->info_top_flag == 1) checked @endif >
            常にTOPに表示する</td>
          </tr>
          <tr>
            <td width="10%" rowspan="2" class="col_3">タイマー</td>
            <td width="15%" class="col_3">開始日時：</td>
            <td>
              <select name="year_start" id="year_start">
                <option value="" @if(old('year_start') == '') selected @endif >----年</option>
                @for( $y=(date('Y')-3); $y<= (date('Y') + 3); $y++ )
                <option value="{{$y}}" @if(old('year_start') == $y || split_date($info->info_start, 'Y') == $y) selected @endif >{{$y}}年</option>
                @endfor
              </select>
                <select name="month_start" id="month_start">
                <option value="" @if(old('month_start') == '') selected @endif >--月</option>
                @for( $m=1; $m<= 12; $m++ )
                  <option value="{{c2digit($m)}}" @if(old('month_start') == c2digit($m) || split_date($info->info_start, 'm') == c2digit($m) ) selected @endif >{{c2digit($m)}}月</option>
                @endfor
              </select>
            <select name="day_start" id="day_start">
            <option value="">--日</option>
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
            <option value="" @if(old('minute_start') == '' ) selected @endif >--分</option>
            <option value="00" @if(old('minute_start') == '00' || old('minute_start') == '0' || split_date($info->info_start, 'i') == '0') selected @endif >00分</option>
            @for( $min=1; $min<= 59; $min++ )
              <option value="{{c2digit($min)}}" @if(old('minute_start') == c2digit($min) || split_date($info->info_start, 'i') == c2digit($min)) selected @endif >{{c2digit($min)}}分</option>
            @endfor
            </select>
        <br>
        </td>
      </tr>
      
      <tr>
      <td width="15%" class="col_3">終了日時：</td>
      <td>
          <select name="year_end" id="year_end">
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
            <option value="" @if(old('hour_end') == '' ) selected @endif >--時</option>
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
          </select>
            </td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td align="center"><input type="submit" id="btn-submit" value="変更する">
        　　　　　
      <input type="reset" name="reset" id="reset" value="クリア"></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><input type="button" onClick="location.href='{{route('backend.infos.index')}}'" value="「お知らせ」一覧に戻る"></td>
    </tr>
    {!! Form::close() !!}
    <tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

<script>
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

<script>
  tinymce.init({
    selector: '#info3_contents',
    language: 'ja',
    height: 320,
    menubar: false,
    forced_root_block : "", 
    force_br_newlines : true,
    force_p_newlines : false,
    fontsize_formats: "8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 28pt 30pt 36pt 42pt",
    plugins: [
      'textcolor',
      'advlist autolink lists link image charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'undo redo | styleselect | bold italic | fontsizeselect | alignleft aligncenter alignright alignjustify | forecolor backcolor | bullist numlist outdent indent | insert | imageupload',
    setup: function(editor) {
            var inp = $('<input id="tinymce-uploader" type="file" name="pic" accept="image/*" style="display:none">');
            $(editor.getElement()).parent().append(inp);

            inp.on("change",function(){
                var input = inp.get(0);
                var file = input.files[0];
                var fr = new FileReader();
                fr.onload = function() {
                    var img = new Image();
                    img.src = fr.result;
                    editor.insertContent('<img src="'+img.src+'"/>');
                    inp.val('');
                }
                fr.readAsDataURL(file);
            });

            editor.addButton( 'imageupload', {
                text:"画像",
                icon: false,
                onclick: function(e) {
                    inp.trigger('click');
                }
            });
        },
    textcolor_cols: "20",
    textcolor_rows: "10",
    textcolor_map: [
        "FFFFFF", "White",
        "000000", "Black",
        "993300", "Burnt orange",
        "333300", "Dark olive",
        "003300", "Dark green",
        "003366", "Dark azure",
        "000080", "Navy Blue",
        "333399", "Indigo",
        "333333", "Very dark gray",
        "800000", "Maroon",
        "FF6600", "Orange",
        "808000", "Olive",
        "008000", "Green",
        "008080", "Teal",
        "0000FF", "Blue",
        "666699", "Grayish blue",
        "808080", "Gray",
        "FF0000", "Red",
        "FF9900", "Amber",
        "99CC00", "Yellow green",
        "339966", "Sea green",
        "33CCCC", "Turquoise",
        "3366FF", "Royal blue",
        "800080", "Purple",
        "999999", "Medium gray",
        "FF00FF", "Magenta",
        "FFCC00", "Gold",
        "FFFF00", "Yellow",
        "00FF00", "Lime",
        "00FFFF", "Aqua",
        "00CCFF", "Sky blue",
        "993366", "Red violet",
        "FF99CC", "Pink",
        "FFCC99", "Peach",
        "FFFF99", "Light yellow",
        "CCFFCC", "Pale green",
        "CCFFFF", "Pale cyan",
        "99CCFF", "Light sky blue",
        "CC99FF", "Plum",
        "CD5C5C", "IndianRed",
        "F08080", "LightCoral",
        "FA8072", "Salmon",
        "E9967A", "DarkSalmon",
        "FFA07A", "LightSalmon",
        "DC143C", "Crimson",
        "B22222", "FireBrick",
        "8B0000", "DarkRed",
        "FFB6C1", "LightPink",
        "FF69B4", "HotPink",
        "FF1493", "DeepPink",
        "C71585", "MediumVioletRed",
        "DB7093", "PaleVioletRed",
        "FF7F50", "Coral",
        "FF6347", "Tomato",
        "FF4500", "OrangeRed",
        "FF8C00", "DarkOrange",
        "FFFFE0", "LightYellow",
        "FFFACD", "LemonChiffon",
        "FAFAD2", "LightGoldenrodYellow",
        "FFEFD5", "PapayaWhip",
        "FFE4B5", "Moccasin",
        "FFDAB9", "PeachPuff",
        "EEE8AA", "PaleGoldenrod",
        "F0E68C", "Khaki",
        "BDB76B", "DarkKhaki",
        "E6E6FA", "Lavender",
        "D8BFD8", "Thistle",
        "DDA0DD", "Plum",
        "EE82EE", "Violet",
        "DA70D6", "Orchid",
        "FF00FF", "Fuchsia",
        "FF00FF", "Magenta",
        "BA55D3", "MediumOrchid",
        "9370DB", "MediumPurple",
        "9966CC", "Amethyst",
        "8A2BE2", "BlueViolet",
        "9400D3", "DarkViolet",
        "9932CC", "DarkOrchid",
        "8B008B", "DarkMagenta",
        "6A5ACD", "SlateBlue",
        "483D8B", "DarkSlateBlue",
        "7B68EE", "MediumSlateBlue",
        "ADFF2F", "GreenYellow",
        "7FFF00", "Chartreuse",
        "7CFC00", "LawnGreen",
        "32CD32", "LimeGreen",
        "98FB98", "PaleGreen",
        "90EE90", "LightGreen",
        "00FA9A", "MediumSpringGreen",
        "00FF7F", "SpringGreen",
        "3CB371", "MediumSeaGreen",
        "2E8B57", "SeaGreen",
        "228B22", "ForestGreen",
        "006400", "DarkGreen",
        "9ACD32", "YellowGreen",
        "6B8E23", "OliveDrab",
        "556B2F", "DarkOliveGreen",
        "66CDAA", "MediumAquamarine",
        "8FBC8F", "DarkSeaGreen",
        "20B2AA", "LightSeaGreen",
        "008B8B", "DarkCyan",
        "008080", "Teal",
        "E0FFFF", "LightCyan",
        "AFEEEE", "PaleTurquoise",
        "7FFFD4", "Aquamarine",
        "48D1CC", "MediumTurquoise",
        "00CED1", "DarkTurquoise",
        "5F9EA0", "CadetBlue",
        "4682B4", "SteelBlue",
        "B0C4DE", "LightSteelBlue",
        "B0E0E6", "PowderBlue",
        "ADD8E6", "LightBlue",
        "87CEEB", "SkyBlue",
        "87CEFA", "LightSkyBlue",
        "00BFFF", "DeepSkyBlue",
        "1E90FF", "DodgerBlue",
        "6495ED", "CornflowerBlue",
        "7B68EE", "MediumSlateBlue",
        "4169E1", "RoyalBlue",
        "0000CD", "MediumBlue",
        "00008B", "DarkBlue",
        "000080", "Navy",
        "191970", "MidnightBlue",
        "FFF8DC", "Cornsilk",
        "FFF8DC", "Cornsilk", 
        "FFEBCD", "BlanchedAlmond",
        "FFE4C4", "Bisque",
        "FFDEAD", "NavajoWhite", 
        "F5DEB3", "Wheat",
        "DEB887", "BurlyWood", 
        "D2B48C", "Tan",
        "BC8F8F", "RosyBrown",
        "F4A460", "SandyBrown",
        "DAA520", "Goldenrod",
        "B8860B", "DarkGoldenrod",
        "CD853F", "Peru",
        "D2691E", "Chocolate",
        "8B4513", "SaddleBrown",
        "A0522D", "Sienna",
        "A52A2A", "Brown",
        "800000", "Maroon",
        "FFFAFA", "Snow",
        "F0FFF0", "Honeydew",
        "F5FFFA", "MintCream",
        "F0FFFF", "Azure",
        "F0F8FF", "AliceBlue",
        "F8F8FF", "GhostWhite",
        "F5F5F5", "WhiteSmoke",
        "FFF5EE", "Seashell",
        "F5F5DC", "Beige",
        "FDF5E6", "OldLace",
        "FFFAF0", "FloralWhite", 
        "FFFFF0", "Ivory",
        "FAEBD7", "AntiqueWhite",
        "FAF0E6", "Linen",
        "FFF0F5", "LavenderBlush",
        "FFE4E1", "MistyRose",
        "DCDCDC", "Gainsboro",
        "D3D3D3", "LightGrey",
        "C0C0C0", "Silver",
        "A9A9A9", "DarkGray",
        "696969", "DimGray",
        "778899", "LightSlateGray",
        "708090", "SlateGray",
        "2F4F4F", "DarkSlateGray",
      ]
  });
</script>
@endsection
