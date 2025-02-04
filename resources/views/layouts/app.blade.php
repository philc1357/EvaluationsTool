<!DOCTYPE html>
<html lang="de">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="expires" content="1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Fortbildungsportal Mecklenburg-Vorpommern MBK MV">
        <meta name="author" content="EWU Software GmbH">
        <meta name="keywords" lang="de" content="Seminarverwaltung, Seminare, MBK MV, EWU Software GmbH">
        <meta name="keywords" lang="en-us" content="seminar administration, EWU Software GmbH, training seminar">
        <meta name="keywords" lang="en" content="seminar administration, EWU Software GmbH, training seminar">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <?php
            $user = Auth::user();
            $session = Session::get('data');
            $year = date("Y");
        ?>

        <title>
            {{config('app.name')}}@section('title')</title>
        <link rel="alternate" hreflang="x-default" href="{{env('APP_URL')}}" />
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" type="image/png" href="/img/mbkmv_favicon.png">
        <link href="/css/bootstrap-table.min.css" rel="stylesheet">
        <link href="/css/calendar.css" rel="stylesheet">
        <link href="/css/custom.css" rel="stylesheet">
        <link href="/css/custom-tablet.css" media="screen and (max-width: 1200px)" rel="stylesheet">
        <link href="/css/custom-table.css" rel="stylesheet">
        <script src="/js/jquery-3.7.1.min.js"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <noscript>
    <meta http-equiv="refresh" content="0; URL={{env('APP_URL')}}noscript.html"></noscript>

    <body>
        {{--
    @include('layouts.navigation') --}}
        <div class="container-fluid">
            <div class="row flex-nowrap main-view">
                @include('layouts.sidebar')
                <div class="col g-sm-0 gy-0 gx-0 backer-white">
                    <div class="main-content">
                        @include('layouts.header')
                        {{ $slot ?? '' }}
                        @yield('content')
                    </div>

                    <div class="copyfoot"><br>
                        <div itemscope itemtype="http://schema.org/Corporation">
                            <span class="copyright">&copy; {{ $year }} - MBK MV </span>
                            <span itemprop="name" class="copyright">
                                <a itemprop="url" href="https://www.ewu-software.com" target="_blank">EWU Software GmbH</a>
                                <a href="https://ewu-seminarverwaltung.com" target="_blank">EWU Seminarverwaltung</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script src="/js/bootstrap.bundle.min.js"></script>
        <script src="/js/custom-bootstrap-table.js"></script>
        <script src="/js/extensions/mobile/bootstrap-table-mobile.js"></script>
        <script src="/js/custom.js"></script>

        @if(request()->is('kalender') || request()->is('kalender_intern'))
            <script type="text/javascript" src="/js/underscore.min.js"></script>
            <script type="text/javascript" src="/js/language/de-DE.js"></script>
            <script type="text/javascript" src="/js/calendar.js"></script>
        @endif
        <?php
            $route = request()->route();
        ?>
        @if($route && $route->getName() != '')
            <?php
                $path_parts = pathinfo($route->getName());
                $filename = $path_parts['filename'];
                $filename = 'js/' . $filename . '.js';
            ?>
            @if(file_exists(public_path($filename)))
                <script src="/{{$filename}}"></script>
            @endif
        @endif

        {{-- @if (isset(@user->change_pw) && $user->change_pw == true}
        <input type="hidden" id="chostbutton" data-tpl="force_password" />
    <script type="text/javascript">
         $(document).ready(function() {
                $('#ewuajaxmodal').modal({
                    toggle: 'modal',
                    backdrop: 'static',
                    show: true,
                    tpl: 'force_password',
                    target: '#ewuajaxmodal',
                    keyboard: false
                });
     });
        </script>
    @endif --}}
    <div class="modal fade" id="ewuajaxmodal" tabindex="-1" role="dialog" aria-labelledby="ewuajaxmodalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Loading ...</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                @yield('modal')
              </div>
              <div class="modal-footer">
              </div>
            </div>
          </div>
    </div>

    <div class="modal fade" id="reload-modal" tabindex="-1" role="dialog" aria-labelledby="ewuajaxmodalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Loading ...</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                @yield('modal')
              </div>
              <div class="modal-footer">
              </div>
            </div>
        </div>
    </div>
    @yield('javascript')
</body>

</html>
