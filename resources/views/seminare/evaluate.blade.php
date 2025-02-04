@extends('layouts.app')

<?php
    $user = Auth::user();
    $id_kurs = isset($seminar) ? $seminar->ID_Kurs : '0';
?>

@section('content')

<input type="hidden" id="id_kurs" value="{{ $id_kurs }}">

@if(isset($error))
    <div class="content--header m-v-20">
        <h2> {{ $error }} </h2>
    </div>
@else

    <div class="content--header m-v-20">
        <h2> {{ $seminar->bezeichnung ?? '' }}{{ $seminar->Bezeichnung ?? '' }} </h2>
    </div>
    <section class="panel panel-default defaul-box">
        <div class="panel-body ng-scope">

            <p class="viewer">Evaluationsbogen für Veranstaltungs-Nr.: {{ $seminar->veranstaltungsnummer }}</p>

            @foreach ($fragen as $frage)
                @if($frage->type === 0)
                    <div class="card mt-4">
                        <div class="card-header">{{ $frage->text }}</div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="{{ $frage->frage_id }}" id="{{ $frage->frage_id }}_1">
                                    <label class="form-check-label m-1" for="{{ $frage->frage_id }}_1">1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="{{ $frage->frage_id }}" id="{{ $frage->frage_id }}_2">
                                    <label class="form-check-label m-1" for="{{ $frage->frage_id }}_2">2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="{{ $frage->frage_id }}" id="{{ $frage->frage_id }}_3">
                                    <label class="form-check-label m-1" for="{{ $frage->frage_id }}_3">3</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="{{ $frage->frage_id }}" id="{{ $frage->frage_id }}_4">
                                    <label class="form-check-label m-1" for="{{ $frage->frage_id }}_4">4</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="{{ $frage->frage_id }}" id="{{ $frage->frage_id }}_5">
                                    <label class="form-check-label m-1" for="{{ $frage->frage_id }}_5">5</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="{{ $frage->frage_id }}" id="{{ $frage->frage_id }}_6">
                                    <label class="form-check-label m-1" for="{{ $frage->frage_id }}_6">6</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card mt-4">
                        <div class="card-header">{{ $frage->text }}</div>
                        <div class="card-body">
                            <div class="d-flex">
                                <textarea class="form-control" name="{{ $frage->frage_id }}" id="{{ $frage->frage_id }}" rows="3" placeholder="Ihre Vorschläge..."></textarea>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            <div class="mt-4">
                <button class="btn btn-success" id="send_evaluation">Evaluation abschicken</button>
            </div>

        </div>
    </section>
@endif

<script>

    $('document').ready(function() {
        let antworten = {!! $antworten !!};

        if(antworten.length !== 0) {
            antworten.forEach(antwort => {
                if(antwort['antwort_skala'] !== null) {
                    $("#" + antwort['frage_id'] + '_' + antwort['antwort_skala']).prop("checked", true);
                }
                else {
                    $("#" + antwort['frage_id']).val(antwort['antwort_freitext']);
                }
            });
        }
    });

    $('input[type=radio]').click(function () {
        if($(this).prop('checked')) {
            type = 'skala';
            save_response($(this).attr('name'), $(this).attr('id').slice(-1), type);
        }
    });

    $('textarea').change(function () {
        type = 'freitext';
        save_response($(this).attr('name'), $(this).val(), type);
    })

    function save_response(id, value, type) {
        $.ajax({
            url: '{{ route('evaluation.save_response') }}',
            method: 'POST',
            type: 'json',
            data: {
                id: id,
                value: value,
                id_kurs: $('#id_kurs').val(),
                id_user: {{ $user->tn_id }},
                type: type
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(e) {
            },
            error: function(e) {
                console.log('Anfrage fehlerhaft.');
            }
        });
    }

    $('#send_evaluation').click(function () {
        $.ajax({
            url: '{{ route('evaluation.save_evaluation') }}',
            method: 'POST',
            type: 'json',
            data: {
                id_kurs: $('#id_kurs').val(),
                id_user: {{ $user->tn_id }}
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(e) {
                setGlobalMessage('success', 'Der Evaluationsbogen wurde erfolgreich versendet. Vielen Dank!');
            },
            error: function(e) {
                console.log('Anfrage fehlerhaft.');
            }
        });
    })

</script>

@endsection
