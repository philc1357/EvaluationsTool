@extends('layouts.app')

<?php
    $user = Auth::user();
    $id_kurs = isset($seminar) ? $seminar->ID_Kurs : '0';
    $sortierung = 1;
?>

@section('content')

<input type="hidden" id="id_kurs" value="{{ $id_kurs }}">

@if(isset($error))
    <div class="content--header m-v-20">
        <h2> {{ $error }} </h2>
    </div>
@else

    <div class="content--header m-v-20">
        <h2> {{ $frageboegen->name ?? '' }}{{ $frageboegen->Name ?? '' }} </h2>
    </div>
    <section class="panel panel-default defaul-box">
        <div class="panel-body ng-scope">

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

@endsection
