<script type="text/javascript" src="/js/notify/pnotify.core.js"></script>
{{-- <script type="text/javascript" src="/js/notify/pnotify.buttons.js"></script> --}}
<script type="text/javascript" src="/js/notify/pnotify.nonblock.js"></script>

<div class="status">
    <ul>

        @if(Auth::check())
        <form class="form" role="form" method="post" action="{{ route('logout') }}" id="logoutForm" style="display:none;">
            @csrf
            <button type="submit">submit</button>
        </form>
        <a href="#" onclick="javascript:event.preventDefault(); document.getElementById('logoutForm').submit();" class="pull-right">Logout</a>
        <span class="status--seperator"> | </span>
        <li class="pull-right">
            {{Auth::user() ? Auth::user()->Vorname. ' ' . Auth::user()->Nachname : 'Hallo, Gast!'}}
        </li>
        @else
        <li class="dropdown pull-right">
            <a href="#" class="btn  btn-xs btn-primary dropdown-toggle btn_right" data-bs-toggle="dropdown"
                aria-expanded="false">Login</a>
            <ul id="login-dp" class="dropdown-menu">
                <li>
                    <div class="row bg-white">
                        <div class="col-md-12">
                            <form class="form" role="form" method="post" action="{{route('login')}}" id="login-nav" autocomplete="off">
                                @csrf
                                {{-- prevent auto-complete chrome --}}
                                    <input style="display: none" type="text" name="remuname" />
                                    <input style="display: none" type="password" name="rempw" />
                                {{-- end prevent auto-complete chrome --}}
                                <div class="form-group">
                                    <label class="sr-only" for="emaila">Email address</label>
                                    <input type="text" class="form-control" id="emaila" name="username" value="{{ old('username') ?: old('email') }}"
                                        placeholder="Benutzername oder Email" autocomplete="off" required" />
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="passa">Passwort</label>
                                    <input type="password" class="form-control" id="passa" name="password" placeholder="Passwort" autocomplete="new-password" required" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"
                                        name="loginSubmit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
        <li>
            <button type="button" class="btn btn-xs btn-default btn_right" data-loading-text="Wird geladen..."
                data-bs-toggle="modal" data-tpl="passwort_refresh" data-backdrop="static"
                data-bs-target="#ewuajaxmodal" type="button">Passwort vergessen?</button>
        </li>
        @endif
    </ul>
</div>


@if(Session::has('message'))
<?php
$messages = is_array(Session::has('message')) ? Session::get('message') : [['message' => Session::get('message'), 'type' => Session::get('type', 'alert-info')]];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <script type="text/javascript">

                $(document).ready(function () {
                    $('#emaila').attr('autocomplete','none');
                    $('#passa').attr('autocomplete','none');
                });

                var permanotice, tooltip, _alert;
                $(function () {
                    @foreach($messages as $t)
                        new PNotify({
                            title: "Info",
                            type: "{{$t['type']}}",
                            text: "{{ $t['message'] }}",
                            delay: 3000,
                            nonblock: {
                                nonblock: true
                            }
                        });
                    @endforeach
                });
            </script>
        </div>
    </div>
</div>
@endif
