@extends('layouts.app')

<?php
    $user = Auth::user();
    $session = Session::get('data');
    if(!isset($id) && !isset($ID_Kurs) ) {
        $nv = 1;
    }
    else {
        $nv = 0;
        $id = isset($id) ? $id : $ID_Kurs;
    }
?>
@section('content')

@if($nv==1)
<div class="content--header m-v-20">
<section class="panel panel-default defaul-box">
        <div class="panel-body ng-scope">
        <div class="alert alert-danger" role="alert">Zu dieser Veranstaltung können keine Details angezeigt werden.</div>
    </div>
    <div class="panel-body ng-scope">
<p class="viewer"></p>
    </div>
</div>
</section>
@else
    <div class="content--header m-v-20">
        <h2> {{ $bezeichnung ?? '' }}{{ $Bezeichnung ?? '' }} </h2>
    </div>
    <section class="panel panel-default defaul-box">
        <div class="panel-body ng-scope">
            <p class="viewer">Veranstaltungs-Nr.: {{ $nummer ?? '' }} {{ $veranstaltungsnummer ?? '' }}</p>

            @if (isset($teilanahmeCheck) && $teilanahmeCheck != '')
                <div class="alert alert-warning" role="alert"><b>Hinweis! In der Zeit dieser gewählten Veranstaltung
                        nehmen
                        Sie
                        schon an einer anderen teil. Sie können sich trotzdem an dieser Veranstaltung anmelden.</b>
                </div>
            @endif

            @if ($onlineveranstaltung === 1 || $user && $user->didRegister($id))

                <div class="bs-callout bs-callout-warning" id="callout-helper-pull-navbar">
                    <h4>Wichtiger Hinweis</h4>
                    @if($user && $user->didRegister($id))
                        <div class="alert alert-warning" role="alert">Sie sind für diese Veranstaltung angemeldet.</div>
                    @endif
                    @if($onlineveranstaltung === 1)
                        <div class="alert alert-warning" role="alert">Onlineveranstaltung</div>
                    @endif
                </div>
            @endif

            <h2>Inhalt</h2>
            <p>
                {!! nl2br($inhalt) !!}
            </p>

            <h2>Allgemeine Informationen</h2>
            <div class="alert alert-info no-padding" role="alert">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th><b>Anmeldeschluss:</b></th>
                        <th><b>Termine:</b></th>
                        <th>
                            @if (isset($status_anzeige))
                                <b>Status</b>
                            @else
                                <b>Wo:</b>
                            @endif
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $anmeldeschluss ? DateTime::createFromFormat('Y-m-d', $anmeldeschluss)->format('d.m.Y') : '' }}
                        </td>
                        <td>
                            @if (isset($Datum))
                                {{ $Datum ? DateTime::createFromFormat('Y-m-d', $Datum)->format('d.m.Y') : '' }} bis
                                {{ $Endedatum ? DateTime::createFromFormat('Y-m-d', $Endedatum)->format('d.m.Y') : '' }}
                                @if($ov_uhrzeit !== 1)
                                    von
                                    {{ $Zeit ? DateTime::createFromFormat('H:i:s', $Zeit)->format('H:i') : '' }} bis
                                    {{ $Zeit_ende ? DateTime::createFromFormat('H:i:s', $Zeit_ende)->format('H:i') : '' }}
                                    Uhr
                                @endif
                            @endif
                            @if (isset($datum))
                                {{ $datum ? DateTime::createFromFormat('Y-m-d', $datum)->format('d.m.Y') : '' }} bis
                                {{ $endedatum ? DateTime::createFromFormat('Y-m-d', $endedatum)->format('d.m.Y') : '' }}
                                @if($ov_uhrzeit !== 1)
                                    von
                                    {{ $zeit ? DateTime::createFromFormat('H:i:s', $zeit)->format('H:i') : '' }} bis
                                    {{ $zeit_ende ? DateTime::createFromFormat('H:i:s', $zeit_ende)->format('H:i') : '' }}
                                    Uhr
                                @endif
                            @endif
                        </td>
                        <td>
                            @if (isset($status_anzeige))
                                @if ($status_anzeige == 'Warteliste')
                                    <span style="color:red">Anmeldung eingegangen</span>
                                @else
                                    <span>{{ $status_anzeige }} {!! $status_anzeige == 'nicht teilgenommen' ? '<br>- ' . ($nicht_teilgenommen_grund ?? '') : '' !!}</span>
                                @endif
                            @endif
                            @if($onlineveranstaltung === 1 && !isset($status_anzeige))
                                online
                            @elseif(isset($seminarort_standard) && $seminarort_standard != 'Online' && $seminarort_standard != 'Lernplattform' && !isset($status_anzeige))
                                {{ $seminarort_standard }}, {{ $seminarort_strasse }}, {{ $seminarort_plz }}
                                {{ $seminarort_ort }}
                            @elseif(isset($seminarort_standard) && !isset($status_anzeige))
                                {{ $seminarort_standard }}
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="alert alert-info no-padding" role="alert">
                <table class="table table-responsive">
                    <tr>
                        <td><b>Fächer/Berufsfelder:</b></td>
                        <td>
                            @if (isset($fach_standard))
                                {{ $fach_standard }}
                            @else
                                @if (isset($seminare_fachs))
                                    @foreach ($seminare_fachs as $k => $v)
                                        {{ $v['fach'] }} @if (!$loop->last), @endif
                                    @endforeach
                                @endif
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><b>Schulform:</b></td>
                        <td>

                            @if (isset($schulform_standard))
                                {{ $schulform_standard }}
                            @else
                                @if (isset($seminare_schulforms))
                                    @foreach ($seminare_schulforms as $k => $v)
                                        {{ $v['schulform'] }} @if (!$loop->last), @endif
                                    @endforeach
                                @endif
                            @endif
                        </td>
                    </tr>
                    @if (isset($zielgruppe_standard))
                        <tr>
                            <td>
                                <b>Zielgruppen:</b>
                            </td>
                            <td>
                                {{ $zielgruppe_standard }}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td><b>Dozent(en):</b></td>
                        <td>
                            @if (isset($dozenten))
                                {{ $dozenten }}
                            @else
                                @if (isset($dozentens))
                                    @foreach ($dozentens as $k => $v)
                                        {{ App\Models\User::getWebName($v['doz_id']) }} @if (!$loop->last), @endif
                                    @endforeach
                                @endif
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><b>Veranstaltungsleiter:</b></td>
                        <td>
                            @if (isset($leiter))
                                {{ $leiter }} - {{ $leiter_dienststelle }}
                            @else
                                @if (isset($seminare_dozentens))
                                    @foreach ($seminare_dozentens as $k => $v)
                                        {{ App\Models\User::getWebName($v['doz_id']) }} - {{ $v['Firmenbezeichnung'] }}
                                        @if (!$loop->last), @endif
                                    @endforeach
                                @endif
                            @endif
                        </td>
                    </tr>

                    @if(isset($status_anzeige))
                        <tr>
                            <td><b>Veranstaltungsort:</b></td>
                            <td>
                                @if($onlineveranstaltung !== 1 && isset($seminare_ortes))
                                    {{ $seminare_ortes[0]['Firmenbezeichnung'] }}@if($seminare_ortes[0]['FStrasse'] != ''), {{ $seminare_ortes[0]['FStrasse'] }}, {{ $seminare_ortes[0]['FPLZ'] }}
                                    {{ $seminare_ortes[0]['FOrt'] }}@endif
                                @elseif($onlineveranstaltung === 1)
                                    online
                                @endif
                            </td>
                        </tr>
                    @endif

                    @if(isset($seminare_ortes[0]) && $seminare_ortes[0]['lisa_veranstaltungsort'] === 1 && ($status_anzeige == 'nimmt Teil' || $status_anzeige == 'nimmt teil') && isset($status_ab) && $status_ab === 1)
                        <tr>
                            <td><b>QR-Code:</b></td>
                            <td>
                                <div class="row">
                                    <div id="qr_code" class="col-md-auto mb-3"></div>
                                    <div class="col">
                                        Dieser QR-Code berechtigt ausschließlich für den o.g. Veranstaltungszeitraum zum Betreten des Veranstaltungsobjektes. Nähere Erläuterungen finden Sie in der Einladung oder in diesem Druckdokument.
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif

                    @if($onlineveranstaltung === 1 && isset($user) && $user->didRegister($id) && ($status_anzeige == 'nimmt Teil' || $status_anzeige == 'nimmt teil') && isset($status_ab) && $status_ab === 1)
                        <tr>
                            <td><b>Link:</b></td>
                            <td>
                                @if($ov_link !== '' && $ov_link !== null)
                                    <a href="{{ $ov_link }}" target="_blank">
                                        Link zur Veranstaltung
                                    </a>
                                @else
                                    nicht angegeben
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><b>Passwort:</b></td>
                            <td>
                                @if($ov_passwort !== '' && $ov_passwort !== null)
                                    {{ $ov_passwort }}
                                @else
                                    ohne
                                @endif
                            </td>
                        </tr>
                        @if($ov_bemerkungen !== '' && $ov_bemerkungen !== null)
                            <tr>
                                <td><b>Bemerkungen:</b></td>
                                <td>
                                    {{ $ov_bemerkungen }}
                                </td>
                            </tr>
                        @endif
                    @endif

                    @if(isset($user_bemerkung) && $user_bemerkung !== '' && $user_bemerkung !== null)
                        <tr>
                            <td><b>Ihr Anmeldehinweis:</b></td>
                            <td>
                                {{ $user_bemerkung }}
                            </td>
                        </tr>
                    @endif

                </table>
            </div>
            <base href="{{ $base }}" />
            @if(isset($downloads_public) && count($downloads_public) > 0)
                <h2>Downloads</h2>
                <div class="alert alert-info" role="alert">
                    <table id="tabelle" width="100%">
                        @foreach($downloads_public as $down)
                            <tr class="normal" onmouseover="this.className = 'spezial2';"
                                onmouseout="this.className = 'normal';">
                                <td style="white-space:nowrap;"><a href="{{ $down->pfad }}"
                                                                   target="_blank">{{ $down->name }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
            @if (isset($ID_Kurs) && count($seminare_downloads) > 0)
                <h2>Downloads</h2>
                @if(isset($ID_Kurs) && count($seminare_downloads_katalog) > 0)
                    <h4>aus dem öffentlichem Bereich</h4>
                    <div class="alert alert-info" role="alert">
                        <table id="tabelle" width="100%">
                            @foreach ($seminare_downloads_katalog as $downk)
                                <tr class="normal" onmouseover="this.className = 'spezial2';"
                                    onmouseout="this.className = 'normal';">
                                    <td style="white-space:nowrap;"><a href="{{ $downk['pfad'] }}"
                                                                       target="_blank">{{ $downk['name'] }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endif
                <h4> aus dem internen Bereich</h4>
                <div class="alert alert-info" role="alert">
                    <table id="tabelle" width="100%">
                        @foreach ($seminare_downloads as $down)
                            <tr class="normal" onmouseover="this.className = 'spezial2';"
                                onmouseout="this.className = 'normal';">
                                <td style="white-space:nowrap;"><a href="{{ $down['pfad'] }}"
                                                                   target="_blank">{{ $down['name'] }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif

            @if (isset($ver_bemerkung) && $ver_bemerkung != '')

                <h2 class="mt-3">Weitere Hinweise</h2>
                <p>{{ $ver_bemerkung }}</p>

            @endif

            @if (isset($checker) && $checker == 1)
                <br><br>
                <button type="submit" name="addver" id="addver" value="">Ihren Verpflegung und
                    Übernachtungsplan
                    anzeigen
                </button>
                <button href="index.php?module=myanmeldung">Zurück</button>
            @else

        </div>
    </section>
    @if (isset($anmeldung_verhindern) && $anmeldung_verhindern == 1)

        <div class="alert alert-warning">Eine Anmeldung zu dieser Veranstaltung ist zur Zeit nicht mehr möglich.</div>

    @else
        @if (!isset($veranstaltungsnummer))
            <form method="post" action="/?m=anmeldung">
                <section class="form-footer">
                    <input type="hidden" name="id" value="{{ $id }}"/>
                    <input type="hidden" name="start"
                           value="{{ $datum ? DateTime::createFromFormat('Y-m-d', $datum)->format('d.m.Y') : '' }}"/>
                    <input type="hidden" name="ende"
                           value="{{ $endedatum ? DateTime::createFromFormat('Y-m-d', $endedatum)->format('d.m.Y') : '' }}"/>
                    <div class="mt-3">
                        <button type="button" class="btn btn-info" onclick="javascript: event.preventDefault(); print_get_va_katalog('{{ route('seminare.pdf', ['id' => $id]) }}');"><span class="fa fa-print" aria-hidden="true"></span> &nbsp;Drucken</button>
                        {{-- <button type="button" class="btn btn-info" name="drucken"
                                onclick="window.open('{{ route('seminare.pdf', [$id]) }}')">Drucken
                        </button> --}}
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('anmeldung_1.registrieren', [$id]) }}" class="btn btn-success">Weiter zur Anmeldung >></a>
                    </div>
                </section>
            </form>
        @endif
    @endif
    @endif

    @if (isset($vu) && $vu == 1)
        <br>
        <h2>Verpflegung und Übernachtung</h2>
        @if (isset($seminare_teilnahmen_vu) && $seminare_teilnahmen_vu == 1)
            <button type="button" class="btn btn-info" data-loading-text="Wird geladen..." data-bs-toggle="modal"
                    data-tpl="view_verpflegung" data-values="" data-backdrop="static" data-bs-target="#ewuajaxmodal"
                    type="button">Verpflegung anzeigen
            </button>
            <hr>
            <br/>
        @else
            <p>Es wurden keine Verpflegungs- und/oder Übernachtungsoptionen ausgewählt.</p>
        @endif
    @endif

    @if (isset($status_anzeige) && $status_anzeige === 'nimmt Teil' && $fragebogen_teilnahme === 0)
        <br>
        <h2>Seminarbewertung</h2>
            <a class="btn btn-primary" href="seminare/evaluate/{{ $ID_Kurs }}" target="_blank" role="button">Fragebogen anzeigen</a>
        <hr>
        <br/>
    @endif

    @if (isset($workshop_anmeldeschluss) && $workshop_anmeldeschluss !== null)

        <h2 class="mt-3">Workshops</h2>

        <table id="tableWorkshopTeilnahmen" data-buttons-align="left" data-toolbar-align="" data-show-refresh="false" data-mobile-responsive="true"
            data-min-width="860" data-show-toggle="false" data-bs-toggle="table" data-search="false" data-refresh="true" data-cache="false"
            data-side-pagination="client" data-pagination="true" data-response-handler="responseHandler" data-content-type="application/x-www-form-urlencoded"
            data-page-list="[5, 10, 20, 50, 100, 200]" data-mobile-responsive="true" style="display: none">

            <thead>
                <tr>
                    <th data-field="name">Workshop</th>
                    <th data-field="datum" data-formatter="datuminputFormatter">Datum</th>
                    <th data-field="von" data-formatter="tn_ws_zeit1">Beginn</th>
                    <th data-field="bis" data-formatter="tn_ws_zeit2">Ende</th>
                    <th data-field="leiter">Leiter</th>
                    <th data-field="raum">Raum</th>
                    <th data-field="anzahl_tn_e" data-formatter="checkBox_erstwunsch" title="Erstwunsch">EW</th>
                    <th data-field="anzahl_tn_z" data-formatter="checkBox_zweitwunsch" title="Zweitwunsch">ZW</th>
                    <th data-field="anzahl_tn" data-formatter="checkBox_nt" title="nimmt teil">NT</th>
                </tr>
            </thead>
        </table>

        @if($ws_anmeldung === 0)
            <a href="{{ route('anmeldungen.workshop', $id) }}" class="btn btn-success" id="btn_workshops">Workshopanmeldung</a>
        @endif

    @endif

    @if (isset($Besonderheiten) && $Besonderheiten)

        <h2 class="mt-3">Weitere Hinweise</h2>
        <p>{{ $Besonderheiten }}</p>

    @endif

    @if(isset($seminar_id) && isset($tn_id))
        <div class="mt-3">
            <button type="button" class="btn btn-info" onclick="print_get_anmeldung('{{ route('anmeldung.pdf', ['id' => $id]) }}');"><span class="fa fa-print" aria-hidden="true"></span> &nbsp;Drucken</button>
            @auth
                <button type="button" class="btn btn-warning" name="ics_mail" id="ics_mail"
                        onclick="{{ route('seminare.ics', [$id]) }}">ICS-Download
                </button>
            @endauth
        </div>
    @endif

    <section class="time_stamps">
        @if (isset($zuletzt_geaendert_am) && $zuletzt_geaendert_am != '')
            <br>
            <span>Aktualisiert am
        {{ $zuletzt_geaendert_am ? DateTime::createFromFormat('Y-m-d H:i:s', $zuletzt_geaendert_am)->format('d.m.Y') : '' }}</span>
        @endif
        @if (isset($geaendert_am))
            <span>Aktualisiert am
        {{ $geaendert_am ? DateTime::createFromFormat('Y-m-d H:i:s', $geaendert_am)->format('d.m.Y') : '' }}</span>
        @endif
    </section>

    <script>

        @if(isset($seminare_workshops))
            $(document).ready(function() {
                let workshop_teilnahmen = @json($seminare_workshops);

                if(workshop_teilnahmen.length > 0) {
                    $('#tableWorkshopTeilnahmen').show();
                }

                $('#tableWorkshopTeilnahmen').bootstrapTable({
                    data: workshop_teilnahmen
                });
            });
        @endif

        @if(isset($seminare_ortes[0]) && $seminare_ortes[0]['lisa_veranstaltungsort'] === 1 && ($status_anzeige == 'nimmt Teil' || $status_anzeige == 'nimmt teil'))
            $(document).ready(function() {
                let nr = 0;

                if((8265000 - {{ $ID_Kurs }}) > 8200000 && (8265000 - {{ $ID_Kurs }}) < 8205000) {
                    nr = 8265000 - {{ $ID_Kurs }};
                }
                else if((8265000 - ({{ $ID_Kurs }} - 1000)) > 8200000 && (8265000 - ({{ $ID_Kurs }} - 1000)) < 8205000) {
                    nr = 8265000 - ({{ $ID_Kurs }} - 1000);
                }
                else if((8265000 - ({{ $ID_Kurs }} - 2000)) > 8200000 && (8265000 - ({{ $ID_Kurs }} - 2000)) < 8205000) {
                    nr = 8265000 - ({{ $ID_Kurs }} - 2000);
                }
                else if((8265000 - ({{ $ID_Kurs }} - 3000)) > 8200000 && (8265000 - ({{ $ID_Kurs }} - 3000)) < 8205000) {
                    nr = 8265000 - ({{ $ID_Kurs }} - 3000);
                }
                else if((8265000 - ({{ $ID_Kurs }} + 2000)) > 8200000 && (8265000 - ({{ $ID_Kurs }} + 2000)) < 8205000) {
                    nr = 8265000 - ({{ $ID_Kurs }} + 2000);
                }
                else {
                    nr = 8200001;
                }

                let html = '<img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=' + nr + '" alt="QR-Code">';

                $('#qr_code').html(html);
            });
        @endif

        function checkBox_erstwunsch(e, r, v) {
            var check = '';
            var type = $(this).attr('stype');
            if (r.erstwunsch === 1) {
                check = ' checked';
            }

            html = '<div class="checkbox align-top">' +
                '<label>' +
                '<input type="checkbox" class="align-top" ' + check + ' disabled>' +
                '</label>' +
                '</div>';
            return html;
        }

        function checkBox_zweitwunsch(e, r, v) {
            var check = '';
            var type = $(this).attr('stype');
            if (r.zweitwunsch === 1) {
                check = ' checked';
            }

            html = '<div class="checkbox align-top">' +
                '<label>' +
                '<input type="checkbox" class="align-top" ' + check + ' disabled>' +
                '</label>' +
                '</div>';
            return html;
        }

        function checkBox_nt(e, r, v) {
            var check = '';
            var type = $(this).attr('stype');
            if (r.nimmt_teil === 1) {
                check = ' checked';
            }

            html = '<div class="checkbox align-top">' +
                '<label>' +
                '<input type="checkbox" class="align-top" ' + check + ' disabled>' +
                '</label>' +
                '</div>';
            return html;
        }

        let ics = document.getElementById('ics_mail');

        if(ics) {
            document.getElementById('ics_mail').onclick = function () {

                $.ajax({
                    url: '{{ route('seminare.ics', [$id]) }}',
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    success: function () {
                        setGlobalMessage('success', 'Ihre Termin-Erinnerung wurde erfolgreich an ihre hinterlegte E-Mail Adresse versendet.');
                    },
                    error: function (e) {
                        if (e.responseText == 'keine_ver') {
                            setGlobalMessage('alert', 'Diese Veranstaltung ist nicht mehr verfügbar.');
                        } else {
                            setGlobalMessage('alert', 'Es ist ein Fehler aufgetreten. Bitte wenden Sie sich an den Support.');
                        }

                    },
                })
            }
        }

    </script>
    @endif
     <script src="/js/katalog_print.js"></script>
     <script src="/js/jsPDF/jspdf.umd.min.js"></script>
     <script src="/js/jsPDF/jspdf.plugin.autotable.min.js"></script>
     <script src="/js/Arimo_font_normal.js"></script>
     <script src="/js/Arimo_font_bold.js"></script>
     <script src="/js/Arimo_font_italic.js"></script>
@endsection

