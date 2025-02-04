<section>

    <div class="mt-3">
        <button class="btn btn-info" id="btn_neuer_fragebogen">neuer Fragebogen</button>
    </div>

    <div class="mt-3" id="neuer_fragebogen" style="display: none">
        <div class="row align-items-end">

            <div class="col-md-8 col-sm-12 mb-3">
                <label for="input_neuer_fragebogen">Name*</label>
                <input type="text" class="form-control input-sm" id="input_neuer_fragebogen"/>
            </div>

            <div class="col-md-6 col-sm-12 mb-3">
                <button type="button" class="btn btn-success" id="btn_fragebogen_erstellen">Erstellen</button>
                <button type="button" class="btn btn-danger" id="btn_fragebogen_erstellen_abbrechen">Abbrechen</button>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <b>vorhandene Evaluationsbögen</b>
        <table id="table_evaluationsboegen" class="table-striped" data-buttons-align="left"
        data-show-refresh="false" data-mobile-responsive="true" data-min-width="860"
        data-show-toggle="true" data-bs-toggle="table" data-search="false"
        data-refresh="false" data-cache="false" data-toolbar="#toolbar"
        data-side-pagination="server" data-pagination="true"
        data-page-list="[5, 10, 20, 50, 100, 200]" data-page-size="5"
        data-url="/evaluation/get_sheets?ajax=1">
            <thead>
                <tr>
                    <th class="col-11" data-field="name" data-valign="top" data-formatter="detailFormatter_evaluation" data-sortable="true">Name</th>
                    <th class="col-1" data-formatter="detailFormatter_fragebogen">Optionen</th>
                </tr>
            </thead>
        </table>
    </div>

    <input type="hidden" id="fragebogen_id">
    <input type="hidden" id="frage_id">
    <input type="hidden" class="form-control input-sm" id="löschender_fragebogen"/>

        <div class="mt-3" id="fragebogen_optionen" style="display: none">
            <button class="btn btn-info" id="btn_fragebogen_bearbeiten">Fragebogen bearbeiten</button>
            <button class="btn btn-danger" id="btn_fragebogen_löschen">Fragebogen löschen</button>
        </div>

        <div class="mt-3" id="fragebogen_bearbeiten" style="display: none">
            <div class="row align-items-end">

                <div class="col-md-8 col-sm-12 mb-3">
                    <label for="input_fragebogen_bearbeiten">Name</label>
                    <input type="text" class="form-control input-sm" id="input_fragebogen_bearbeiten"/>
                </div>

                <div class="col-12 mb-3">
                    <button type="button" class="btn btn-success" id="btn_fragebogen_speichern">Speichern</button>
                    <button type="button" class="btn btn-danger" id="btn_fragebogen_bearbeiten_abbrechen">Abbrechen</button>
                </div>
            </div>
        </div>

    <div class="mt-3" id="fragebogen_fragen" style="display: none">
        <b>Evaluationsbogen: </b><b><span id="fragebogen_name"></span></p></b>
        <table id="table_fragen" class="table-striped" data-buttons-align="left" data-show-refresh="true"
        data-mobile-responsive="true" data-min-width="860" data-show-toggle="true" data-bs-toggle="table"
        data-search="false" data-refresh="false" data-cache="false" data-toolbar="#toolbar"
        data-sort-name="sort" data-sort-order="asc" data-side-pagination="server"
        data-pagination="true" data-page-size="10" data-page-list="[5, 10, 20, 50, 100, 200]" data-url="">
            <thead>
                <th class="col-1" data-valign="top" data-field="sort">Sort.</th>
                <th class="col-9" data-field="text" data-valign="top">Frage</th>
                <th class="col-1" data-field="type" data-formatter="detailFormatter_fragen_typ" data-valign="top">Typ</th>
                <th class="col-1" data-formatter="detailFormatter_fragen">Optionen</th>
            </thead>
        </table>

        <input type="hidden" class="form-control input-sm" id="löschende_frage"/>

        <div class="mt-3" id="frage_optionen" style="display: none">
            <button class="btn btn-info" id="btn_frage_bearbeiten">Frage bearbeiten</button>
            <button class="btn btn-danger" id="btn_frage_löschen">Frage löschen</button>
        </div>

        <div class="mt-3" id="frage_bearbeiten" style="display: none">
            <div class="row align-items-end">

                <div class="col-md-1 col-sm-12 mb-3">
                    <label for="frage_sort_bearbeiten">Sort.</label>
                    <input type="number" class="form-control input-sm" id="frage_sort_bearbeiten" min="1"/>
                </div>

                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="input_frage_bearbeiten">Frage</label>
                    <input type="text" class="form-control input-sm" id="input_frage_bearbeiten"/>
                </div>

                <div class="col-md-5 col-sm-12 mb-3">
                    <label for="input_frage">Fragenart</label>
                    <select class="form-select" id="fragen_art_bearbeiten">
                        <option value="0">Skala</option>
                        <option value="1">Freitext</option>
                    </select>
                </div>
            </div>
            <div class="row align-items-end">
                <div class="col-12 mb-3">
                    <button type="button" class="btn btn-success" id="btn_frage_speichern">Speichern</button>
                    <button type="button" class="btn btn-danger" id="btn_frage_bearbeiten_abbrechen">Abbrechen</button>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <a class="btn btn-info" href="" target="_blank" role="button" id="btn_vorschau">Vorschau</a>
            <button class="btn btn-info" id="btn_neue_frage">neue Frage</button>
        </div>
        <div class="mt-3" id="neue_frage" style="display: none">
            <div class="row align-items-end">

                <div class="col-md-1 col-sm-12 mb-3">
                    <label for="input_neue_frage">Sort.</label>
                    <input type="number" min="1" class="form-control input-sm" id="input_frage_sort"/>
                </div>

                <div class="col-md-6 col-sm-12 mb-3">
                    <label for="input_neue_frage">Frage*</label>
                    <input type="text" class="form-control input-sm" id="input_neue_frage"/>
                </div>

                <div class="col-md-5 col-sm-12 mb-3">
                    <label for="input_frage">Fragenart</label>
                    <select class="form-select" id="fragen_art">
                        <option value="0">Skala</option>
                        <option value="1">Freitext</option>
                    </select>
                </div>
            </div>
            <div class="row align-items-end">
                <div class="col-12 mb-3">
                    <button type="button" class="btn btn-success" id="btn_frage_erstellen">Hinzufügen</button>
                    <button type="button" class="btn btn-danger" id="btn_frage_erstellen_abbrechen">Abbrechen</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>

    //DataFormatter
    function detailFormatter_evaluation(value, row) {
        return '<a href="#" onclick="getQuestions(' + row.fragebogen_id + ', \'' + row.name + '\'); return false;">' + row.name + '</a>';
    }

    function detailFormatter_fragen(r, v) {
        return '<a href="javascript:delete_question(' + v.frage_id + ')" class="btn btn-xs btn-danger mt-1 mb-1 me-1"><i class="fa fa-remove" title="Frage löschen"></i></a>' +
        '<a href="javascript:update_question(' + v.frage_id + ')" class="btn btn-xs btn-success mt-1 mb-1"><i class="fa fa-edit" title="Frage bearbeiten"></i></a>';
    }

    function detailFormatter_fragebogen(r, v) {
        return '<a href="javascript:delete_sheet(' + v.fragebogen_id + ')" class="btn btn-xs btn-danger mt-1 mb-1 me-1"><i class="fa fa-remove" title="Fragebogen löschen"></i></a>' +
        '<a href="javascript:update_sheet(' + v.fragebogen_id + ')" class="btn btn-xs btn-success mt-1 mb-1"><i class="fa fa-edit" title="Titel bearbeiten"></i></a>';
     }

    function detailFormatter_fragen_typ(value, row) {
        if (row.type === 1) {
            return '<p class="fragen_type" style="display: block; margin: auto">Freitext</p>';
        }
        else {
            return '<p class="fragen_type" style="display: block; margin: auto">Skala</p>';
        }
    }


    //Show und Hide Funktionen
    $('#btn_neuer_fragebogen').click(function() {
        $('#neuer_fragebogen').show();
    });

    $('#btn_neue_frage').click(function() {
        $('#neue_frage').show();
    });

    $('#btn_frage_erstellen_abbrechen').click(function(){
        $('#neue_frage').hide();
    })

    $('#btn_frage_bearbeiten_abbrechen').click(function(){
        $('#frage_bearbeiten').hide();
    });

    $('#btn_fragebogen_bearbeiten_abbrechen').click(function(){
        $('#fragebogen_bearbeiten').hide();
    });

    $('#btn_fragebogen_erstellen_abbrechen').click(function(){
        $('#neuer_fragebogen').hide();
        $('#input_neuer_fragebogen').val('');
    });



    //Fragebogen erstellen
    $('#btn_fragebogen_erstellen').click(function() {
        if($('#input_neuer_fragebogen').val() !== '') {
            $.ajax({
                url: '{{ route('evaluation.post_sheet') }}',
                method: 'POST',
                type: 'json',
                data: {
                    name: $('#input_neuer_fragebogen').val(),
                    type: $('#input_fragebogen_type').val(),
                },
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(e) {
                    setGlobalMessage('success', 'Fragebogen wurde erfolgreich gespeichert.');
                    $('#table_evaluationsboegen').bootstrapTable('refresh');
                    $('#neuer_fragebogen').hide();
                },
                error: function(e) {
                    console.log('Anfrage fehlerhaft.');
                }
            });
        }
        else {
            setGlobalMessage('danger', 'Bitte einen Titel eingeben.');
        }
    });

    //Fragebogen löschen
    function delete_sheet(fragebogen_id) {
        $('#fragebogen_optionen').hide();
        $('#fragebogen_bearbeiten').hide();
        $.ajax({
            url: '{{ route('evaluation.delete_sheet') }}',
            method: 'POST',
            type: 'json',
            data: {
                id: fragebogen_id
            },
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(e) {
                setGlobalMessage('success', 'Fragebogen wurde erfolgreich gelöscht.');
                $('#table_evaluationsboegen').bootstrapTable('refresh');
                $('#fragebogen_fragen').hide();
                $('#input_fragebogen_bearbeiten').val('');
                console.log(name);
            },
            error: function(e) {
                console.log('Anfrage fehlerhaft.');
            }
        });
    };

    //Fragebogen Name in das Input Feld eintragen
    function update_sheet(id) {
        $('#fragebogen_id').val(id);

        $.ajax({
            url: '{{ route('evaluation.get_sheetname') }}',
            method: 'GET',
            dataType: 'json',
            data: {
                    id: id
                },
            success: function(response) {
                if (response.success) {
                    $('#input_fragebogen_bearbeiten').val(response.name);
                    $('#fragebogen_bearbeiten').show();
                    console.log("Name des Fragebogens:", response.name);
                    console.log("ID des Fragebogens:", id);
                }
                else {
                    console.error("Fehler: Keine Daten gefunden.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Fehler beim Abrufen des Namens:", error);
            }
        });
    }

    //Fragebogen bearbeiten
    $('#btn_fragebogen_speichern').click(function() {
        if($('#input_fragebogen_bearbeiten').val() !== ''){
            $('#fragebogen_optionen').hide();
            $('#fragebogen_bearbeiten').hide();
            $.ajax({
                url: '{{ route('evaluation.update_sheet') }}',
                method: 'POST',
                type: 'json',
                data: {
                    id: $('#fragebogen_id').val(),
                    neuer_name: $('#input_fragebogen_bearbeiten').val()
                },
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(e) {
                    setGlobalMessage('success', 'Fragebogen wurde erfolgreich gespeichert.');
                    $('#table_evaluationsboegen').bootstrapTable('refresh');
                    $('#input_fragebogen_bearbeiten').val('');
                },
                error: function(e) {
                    console.log('Anfrage fehlerhaft.');
                }
            });
        }
        else {
            setGlobalMessage('danger', 'Bitte einen Titel eingeben.');
        }
    });



    //Frage erstellen
    $('#btn_frage_erstellen').click(function() {
        if ($('#input_neue_frage').val() !== '') {
            $.ajax({
                url: '{{ route('evaluation.post_question') }}',
                method: 'POST',
                type: 'json',
                data: {
                    name: $('#input_neue_frage').val(),
                    id: $('#fragebogen_id').val(),
                    art: $('#fragen_art').val(),
                    sort: $('#input_frage_sort').val()
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(e) {
                    setGlobalMessage('success', 'Frage wurde erfolgreich gespeichert.');
                    $('#table_fragen').bootstrapTable('refresh');
                    $('#input_neue_frage').val('');
                },
                error: function(e) {
                    console.log('Anfrage fehlerhaft.');
                }
            });
            $('#neue_frage').hide();
            $('#input_frage_sort').val('');
        }
        else {
            setGlobalMessage('danger', 'Bitte eine Frage eingeben.');
        }
    });

    //Fragentext in das Bearbeitungsfeld eintragen
    function update_question(id) {
        $('#frage_id').val(id);

        $.ajax({
            url: '{{ route('evaluation.get_questionname') }}',
            method: 'GET',
            dataType: 'json',
            data: {
                    id: id
                },
            success: function(response) {
                if (response.success) {
                    $('#frage_sort_bearbeiten').val(response.sort);
                    $('#input_frage_bearbeiten').val(response.text);
                    $('#frage_bearbeiten').show();
                    console.log(response.sort);
                    console.log(response.text);
                }
                else {
                    console.error("Fehler: Keine Daten gefunden.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Fehler beim Abrufen des Namens:", error);
            }
        });
    }

    //Frage bearbeiten
    $('#btn_frage_speichern').click(function() {
        frageId = $('#frage_id').val();
        neuerText = $('#input_frage_bearbeiten').val();
        neueArt = $('#fragen_art_bearbeiten').val();
        neueSort = $('#frage_sort_bearbeiten').val();

        if(neuerText !== ''){
            $('#frage_optionen').hide();
            $('#frage_bearbeiten').hide();

            $.ajax({
                url: '{{ route('evaluation.update_question') }}',
                method: 'POST',
                dataType: 'json',
                data: {
                    id: frageId,
                    neuer_text: neuerText,
                    neue_art: neueArt,
                    neue_sort: neueSort
                },
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(e) {
                    setGlobalMessage('success', 'Frage wurde erfolgreich gespeichert.');
                    $('#table_fragen').bootstrapTable('refresh');
                    $('#input_frage_bearbeiten').val('');
                },
                error: function(e) {
                    setGlobalMessage('danger', 'Speichern der Frage fehlgeschlagen.');
                    console.log('Fehler bei der Anfrage:', e);
                    $('#table_fragen').bootstrapTable('refresh');
                }
            });
        }
        else {
            setGlobalMessage('danger', 'Bitte eine Frage eingeben.');
        }
    });

    //Frage löschen
    function delete_question(frage_id) {
        console.log(frage_id);
        $('#frage_optionen').hide();
        $('#frage_bearbeiten').hide();
        $.ajax({
            url: '{{ route('evaluation.delete_question') }}',
            method: 'POST',
            type: 'json',
            data: {
                id: frage_id
            },
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(e) {
                setGlobalMessage('success', 'Frage wurde erfolgreich gelöscht.');
                $('#table_fragen').bootstrapTable('refresh');
                $('#input_frage_bearbeiten').val('');
                console.log(name);

            },
            error: function(e) {
                console.log('Anfrage fehlerhaft.');
            }
        });
    };

    //Fragen zum Fragebogen anzeigen
    function getQuestions(id, name) {
        let url = 'evaluation/vorschau/' + id;
        $('#fragebogen_fragen').show();
        $('#table_fragen').bootstrapTable('refresh', {
            url: '/evaluation/get_questions/' + id
        });
        $('#fragebogen_name').html(name);
        $('#fragebogen_id').val(id);
        $('#btn_vorschau').attr('href', 'evaluation/vorschau/' + id);
    }

</script>
