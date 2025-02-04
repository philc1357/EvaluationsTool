
@extends('layouts.app')

<?php
$user = Auth::user();
$session = Session::get('data');
?>

@section('content')  <section class="panel panel-default defaul-box">

    <div class="panel-body ng-scope">

        <h2>Meine Anmeldungen</h2>
        <div class="alert alert-info" role="alert">
            Hier finden Sie eine Übersicht über die Veranstaltungen an denen Sie sich angemeldet haben. Um weitere Informationen oder einen Ausdruck der einzelnen Veranstaltungen zu erhalten, klicken Sie eine Veranstaltung an.
            Sofern Sie im Zusammenhang mit der Teilnahme an einer Veranstaltung Fragen an die Kursverantwortliche/den Kursverantwortlichen haben, beachten Sie bitte die verschiedenen Zuständigkeiten:
            Bei Kursnummern, die den Buchstaben „F“ enthalten (z. B. 11 F123 456), wenden Sie sich bitte direkt an die zuständigen Fortbildner/Fachbetreuer.
            In allen anderen Fällen kontaktieren Sie bitte das Veranstaltungsmanagement.
        </div>
        <div id="toolbar" class="category-toolbar">
            <div class="form-inline" role="form">
                <div class="form-group">
                    <span>Von: </span>
                    <input type="date" class="form-control" name="von">
                </div>
                <div class="form-group">
                    <span>Bis: </span>
                    <input type="date" class="form-control" name="bis">
                </div>
                <button id="ok" type="submit" class="btn btn-warning">Suchanfragen zurücksetzen</button>
            </div>
        </div>
        <table id="table" class="table-striped"
               data-buttons-align="left" data-toolbar-align=""
               data-show-refresh="true"
               data-mobile-responsive="true"
               data-min-width="860"
               data-show-toggle="true"
               data-bs-toggle="table"
               data-search="true"
               data-refresh="true"
               data-cache="false"
               data-toolbar="#toolbar"
               data-side-pagination="server"
               data-pagination="true"
               data-page-list="[5, 10, 20, 50, 100, 200]"
               data-url="{{route('anmeldungen.index')}}">

            <thead>
                <tr>
                    <th data-field="veranstaltungsnummer" data-formatter="detailFormatter" data-sortable="true">Veranstaltungsnummer</th>
                    <th data-field="Bezeichnung" data-formatter="detailFormatter" data-sortable="true">Titel</th>
                    <th data-field="Datum" data-formatter="datuminputFormatter" data-sortable="true">Beginn</th>
                    <th data-field="Endedatum" data-formatter="datuminputFormatter" data-sortable="true">Ende</th>
                    <th data-field="Firmenbezeichnung" data-sortable="true">Veranstaltungsort</th>
                    <th data-field="status_anzeige" data-formatter="detailStatus" data-sortable="true">Status</th>
                    <th data-field="" data-formatter="detailOptionen" >Optionen</th>
                </tr>
            </thead>
        </table>
        <a href="{{route('anmeldungen.pdf')}}" id="druck_anmeldungen" target="_blank" class="btn btn-warning"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Drucken</a>
    </div>
</section>


@endsection
@section('javascript')
<script>
    $(document).ready(function () {

        $('#druck_anmeldungen').click(function () {
            this.href = '{{route('anmeldungen.pdf')}}';
            if (localStorage.getItem('anmeldungen_von') != null && localStorage.getItem('anmeldungen_von') != undefined && localStorage.getItem('anmeldungen_von') != "") {
                this.href = this.href + '&von=' + localStorage.getItem('anmeldungen_von');
            }
            if (localStorage.getItem('anmeldungen_bis') != null && localStorage.getItem('anmeldungen_bis') != undefined && localStorage.getItem('anmeldungen_bis') != "") {
                this.href = this.href + '&bis=' + localStorage.getItem('anmeldungen_bis');
            }
        });

    });
</script>
@endsection
