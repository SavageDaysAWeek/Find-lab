<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="text/javascript" src="https://vk.com/js/api/openapi.js?168"></script>

    <link href="/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="/font-awesome/css/all.min.css" rel="stylesheet">
    <link type="text/css" href="/css/argon.min.css" rel="stylesheet">
    <title>Find Lab</title>
</head>
<body class="bg-secondary">
    @include('nav')
    @yield('content')

    <div class="container fixed-bottom" id="successNotify"></div>
    <div class="container fixed-bottom" id="errorNotify"></div>

    <div class="card card-pricing bg-gradient-success border-0 text-center col-4 mb-4">
        <div class="card-header bg-transparent">
          <h4 class="text-uppercase ls-1 text-white py-3 mb-0">Bravo pack</h4>
        </div>
        <div class="card-body px-lg-7">
          <div class="display-2 text-white">$49</div>
          <span class=" text-white">per application</span>
          <ul class="list-unstyled my-4">
            <li>
              <div class="d-flex align-items-center">
                <div>
                  <div class="icon icon-xs icon-shape bg-white shadow rounded-circle">
                    <i class="fas fa-terminal"></i>
                  </div>
                </div>
                <div>
                  <span class="pl-2 text-sm text-white">Complete documentation</span>
                </div>
              </div>
            </li>
            <li>
              <div class="d-flex align-items-center">
                <div>
                  <div class="icon icon-xs icon-shape bg-white shadow rounded-circle">
                    <i class="fas fa-pen-fancy"></i>
                  </div>
                </div>
                <div>
                  <span class="pl-2 text-sm text-white">Working materials in Sketch</span>
                </div>
              </div>
            </li>
            <li>
              <div class="d-flex align-items-center">
                <div>
                  <div class="icon icon-xs icon-shape bg-white shadow rounded-circle">
                    <i class="fas fa-hdd"></i>
                  </div>
                </div>
                <div>
                  <span class="pl-2 text-sm text-white">2GB cloud storage</span>
                </div>
              </div>
            </li>
          </ul>
          <button type="button" class="btn btn-primary mb-3">Start free trial</button>
        </div>
        <div class="card-footer bg-transparent">
          <a href="#!" class=" text-white">Request a demo</a>
        </div>
      </div>
</body>

<script src="/js/jquery.min.js"></script>
<script src="/js/js.cookie.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/bootstrap-datepicker.min.js"></script>
<script src="/js/argon.min.js"></script>

<script>
    function successMessage(msg) {
        $('#successNotify').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><span class="alert-icon"><i class="ni ni-like-2"></i></span><span class="alert-text">' + msg + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    function errorMessage(msg) {
        $('#successNotify').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><span class="alert-icon"><i class="ni rotate-180 ni-like-2"></i></span><span class="alert-text">' + msg + '</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@yield('script')

</html>