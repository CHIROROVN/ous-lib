@extends('backend.layouts.app')
@section('content')
<table width="960" border="0" align="center" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td width="150%" class="col_1">■岡山理科大学図書館 Website 管理画面　＞　「お知らせ」管理　＞　登録済み情報の削除</td>
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
              <td>{{japan_date($info->info_date)}}</td>
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
              <td>@if($info->info_type == 2) {{$info->info2_file}} @endif</td>
            </tr>
            <tr>
              <td width="10%" rowspan="6" class="col_3">タイプ3</td>
              <td width="15%" class="col_3">詳細</td>
              <td>{!! html_entity_decode($info->info3_contents) !!}</td>
            </tr>
            <tr>
              <td width="15%" class="col_3">画像</td>
              <td>@if(!empty($info->info3_img))
				  <a href="{{ asset('public') }}{{$info->info3_img}}" target="_blank" title="">表示</a>
				  @else
				  なし	  
				  @endif</td>
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
              <td>@if(!empty($info->info3_file))
			  <a href="{{ asset('public') }}{{$info->info3_file}}" target="_blank" title="">表示</a>
			  @else
			  なし	  
			  @endif</td>
            </tr>
            <tr>
              <td class="col_3">　└関連ファイル名</td>
              <td>{{$info->info3_filename}}</td>
            </tr>
            <tr>
              <td colspan="2" class="col_3">表示／非表示</td>
              <td>@if($info->info_dspl_flag == 1)
				表示する／表示しない
				@else
				表示する
				@endif</td>
            </tr>
            <tr>
              <td colspan="2" class="col_3">TOP表示設定</td>
              <td>@if($info->info_top_flag == 1)
				設定なし／TOPに表示
				@else
				設定なし
				@endif</td>
            </tr>
            <tr>
              <td width="10%" rowspan="2" class="col_3">タイマー</td>
              <td width="15%" class="col_3">開始日時：</td>
              <td>{{dateJp($info->info_start)}}<br></td>
            </tr>
            <tr>
              <td width="15%" class="col_3">終了日時：</td>
              <td>{{dateJp($info->info_end)}}</td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><input type="button" name="button2" id="button2" value="削除する（確認済み）" onClick="location.href='{{route('backend.infos.delete_save', $info->info_id)}}'">
      <input type="button" name="button" id="button" value="もどる" onclick="javascript:window.history.back(-1);return false;"></td>
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
@endsection
