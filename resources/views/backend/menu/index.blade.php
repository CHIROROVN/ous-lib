@extends('backend.layouts.app')
@section('content')

<table width="960" border="0" align="center" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td width="99%" class="col_1">■岡山理科大学図書館 Website 管理画面　＞　メニュー</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    @if(Auth::user()->u_power01 == 1)
    <tr>
      <td class="col_2">▼「お知らせ」管理</td>
    </tr>
    <tr>
      <td>　●<a href="{{route('backend.infos.index')}}">「お知らせ」の新規登録／一覧／変更／削除</a></td>
    </tr>
     @endif
    <tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
@endsection