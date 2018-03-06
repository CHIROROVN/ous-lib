
@extends('backend.layouts.app')

@section('content')
<table width="960" border="0" align="center" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td width="150%" class="col_1">■岡山理科大学図書館 Website 管理画面　＞　「お知らせ」管理　＞　一覧</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    @if($message = Session::get('danger'))
    <tr>
      <td>
      <div id="error" class="message">
        <a id="close" title="Message"  href="#" onClick="document.getElementById('error').setAttribute('style','display: none;');">&times;</a>
        <span>{{$message}}</span>
      </div>
      </td>
    </tr>
    @elseif($message = Session::get('success'))
    <tr>
      <td>
      <div id="success" class="message">
        <a id="close" title="Message"  href="javascript::void(0);" onClick="document.getElementById('success').setAttribute('style','display: none;');">&times;</a>
        <span>{{$message}}</span>
      </div>
      </td>
    </tr>
    @endif
    
    <tr>
      <td align="right"><input type="button" onClick="location.href='{{route('backend.infos.regist')}}'" value="新規登録"></td>
    </tr>
    <tr>
      <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
        <tbody>
          <tr class="col_3">
            <td width="1%" align="center">削除</td>
            <td width="6%" align="center">表示</td>
            <td align="center">タイトル</td>
            <td width="12%" align="center">日付</td>
            <td width="1%" align="center">詳細・変更</td>
          </tr>
          @if(!empty($infos))
          @foreach($infos as $key => $info)
          <tr>
            <td><input type="button" onClick="location.href='{{route('backend.infos.delete', $info->info_id)}}'" value="削除"></td>
            <td align="center">
            @if(empty($info->info_dspl_flag))
            <span class="f_blue">{{check_date($info->info_start, $info->info_end)}}</span>
            @elseif($info->info_dspl_flag == 1)
            <span class="f_red">×</span>
            @else
            <span class="f_not">-</span>
            @endif
            </td>
            <td>{{$info->info_title}}</td>
            <td>{{format_date($info->info_date, '/')}}</td>
            <td><input type="button" onClick="location.href='{{route('backend.infos.detail', $info->info_id)}}'" value="詳細・変更"></td>
          </tr>
          @endforeach
          @endif

        </tbody>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center">
        {{ $infos->links() }}
      </td>
    </tr>
  </tbody>
</table>

@endsection
