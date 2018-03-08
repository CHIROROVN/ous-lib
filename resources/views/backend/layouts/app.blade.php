<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>管理画面 | 岡山理科大学図書館</title>
<link rel="stylesheet" href="{{ asset('') }}public/backend/css/style.css" />

<link rel="stylesheet" href="{{ asset('') }}public/backend/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="{{ asset('') }}public/backend/css/datepicker.css" />
<script src="{{ asset('') }}public/backend/js/jquery.min.js"></script>
 <script src="{{ asset('') }}public/backend/js/bootstrap.min.js"></script> 
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tbody>
    <tr>
      <td width="50%" align="left"><input type="button" onClick="location.href='{{route('backend.menu.index')}}'" value="管理者メニューへ"></td>
      <td width="50%" align="right"><input type="button" onClick="location.href='{{route('backend.users.logout')}}'" value="ログアウト"></td>
    </tr>
  </tbody>
</table>
<hr noshade>
<!--Content-->
@yield('content')
<!--End Content-->

</body>
</html>