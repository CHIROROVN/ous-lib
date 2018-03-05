<!DOCTYPE html>
<html lang="en">
<head>
<title>Chiroro-Net Viet Co.,Ltd</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{ asset('') }}public/backend/css/bootstrap.min.css" />
<link rel="stylesheet" href="{{ asset('') }}public/backend/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="{{ asset('') }}public/backend/css/uniform.css" />
<link rel="stylesheet" href="{{ asset('') }}public/backend/css/matrix-style.css" />
<link rel="stylesheet" href="{{ asset('') }}public/backend/css/matrix-media.css" />

<link href="{{ asset('') }}public/backend/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="icon" href="{{ asset('') }}public/favicon/favicon.png" type="image/gif" >
</head>
<body>
<!--Header-part-->
<div id="header">
  <h1><a href="#">Chiroro</a></h1>
</div>
<!--close-Header-part--> 
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('manage/dashboard/')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <span class="current">Error 500</span> </div>
    <h1>Error 500</h1>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Error 500</h5>
          </div>
          <div class="widget-content">
            <div class="error_ex">
              <h1>500</h1>
              <h3>Something is wrong here. Method not allowed!</h3>
              <p>Access to this page is forbidden</p>
              <a class="btn btn-warning btn-big"  href="{{url('manage/dashboard/')}}">Back to Home</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2017 &copy; Chiroro-Net Viet Co., Ltd. All Rights Reserved.</div>
</div>
<!--end-Footer-part-->

</body>
</html>
