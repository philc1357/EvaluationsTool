@extends('layouts.app')

<?php
    $user = Auth::user();
    $session = Session::get('data');
?>

@section('content')

    <section class="panel panel-default default-box">
        <div class="panel-body ng-scope ps-3 pe-3 pt-3 pb-2">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                <ul class="nav nav-tabs">
                    <li role="presentation">
                        <a href="#auswertung" class="active" id="auswertung-tab" role="tab" data-bs-toggle="tab" title="Auswertung"
                            aria-controls="auswertung" aria-expanded="false">
                            Auswertung
                        </a>
                    </li>

                    <li role="presentation">
                        <a href="#erstellung" id="erstellung-tab" role="tab" data-bs-toggle="tab" title="Erstellung"
                            aria-controls="erstellung" aria-expanded="false">
                            Erstellung
                        </a>
                    </li>
                </ul>
            </div>

            <div id="evaluationTabsContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade show active" id="auswertung" aria-labelledby="auswertung-tab">
                    @include('evaluation._auswertung')
                </div>

                <div role="tabpanel" class="tab-pane fade" id="erstellung" aria-labelledby="erstellung-tab">
                    @include('evaluation._erstellung')
                </div>
            </div>
        </div>
    </section>

@endsection
