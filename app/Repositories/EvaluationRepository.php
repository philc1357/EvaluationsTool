<?php

namespace App\Repositories;

use App\Models\EvaluationQuestions;
use App\Models\EvaluationAnswers;
use App\Models\EvaluationSheets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Illuminate\Http\Request;

class EvaluationRepository extends BaseRepository
{
    protected $view = 'seminare';

    public function __construct(EvaluationQuestions $model) {
        $this->model = $model;
    }

    public function get_questions($input, $id) {
        $total = EvaluationQuestions::where('fragebogen_id', $id)->count();
        $query = EvaluationQuestions::where('fragebogen_id', $id);

        $sort = array_key_exists('sort', $input) ? $input['sort'] : '';
        $order = array_key_exists('order', $input) && $input['order'] ? $input['order'] : 'ASC';

        if ($sort !== '') {
            $query = $query->orderBy($sort, $order);
        }

        $query = $query->skip(array_key_exists('offset', $input) ? $input['offset'] : 0)->take(array_key_exists('limit', $input) ? $input['limit'] : 5);

        return ['total' => $total, 'rows' => $query->get()];

    }

    public function preview_sheet($id) {
        $fragen = DB::table('evaluation_fragen')->where('fragebogen_id', $id)->orderBy('sort')->get()->toArray();

        return view('evaluation._vorschau', ['fragen' => $fragen]);
    }

    public function get_questionname(Request $request)    {

        $id = $request->query('id');

        $question = DB::table('evaluation_fragen')
            ->where('frage_id', $id)
            ->select('sort', 'text', 'type')
            ->first();

        if ($question) {
            return response()->json([
                'success' => true,
                'sort' => $question->sort,
                'text' => $question->text,
                'type' => $question->type,
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Frage nicht gefunden.',
            ]);
        }
    }


    public function get_sheets($input) {
        $total = EvaluationSheets::count();
        $query = EvaluationSheets::select(['fragebogen_id', 'name']);

        $sort = array_key_exists('sort', $input) ? $input['sort'] : '';
        $order = array_key_exists('order', $input) && $input['order'] ? $input['order'] : 'ASC';

        if ($sort !== '') {
            $query = $query->orderBy($sort, $order);
        }

        $query = $query->skip(array_key_exists('offset', $input) ? $input['offset'] : 0)->take(array_key_exists('limit', $input) ? $input['limit'] : 5);

        return ['total' => $total, 'rows' => $query->get()];
    }

    public function get_sheet($id) {

        $user = Auth::user();

        $teilgenommen = DB::table('seminare_teilnahmen')->where('seminar_id', $id)->where('tn_id', $user->tn_id)->select('fragebogen_teilnahme')->first();

        if($teilgenommen === NULL || $teilgenommen->fragebogen_teilnahme !== 0) {
            $error = 'Fehler: Fragebogen bereits abgesendet oder nicht am Seminar teilgenommen.';
            $antworten = [];
            return view($this->view . '.evaluate', ['error' => $error, 'antworten' => json_encode($antworten)]);
        }

        $seminar_details = DB::table('seminare_details')->where('ID_Kurs', $id)->select(['ID_Kurs', 'Bezeichnung', 'Datum', 'Endedatum', 'veranstaltungsnummer', 'fragebogen_id'])->first();
        $fragen = DB::table('evaluation_fragen')->where('fragebogen_id', $seminar_details->fragebogen_id)->orderBy('sort')->get()->toArray();
        $antworten = DB::table('evaluation_antworten')->where('tn_id', $user->tn_id)->where('ID_Kurs', $id)->select(['frage_id', 'antwort_skala', 'antwort_freitext'])->get()->toArray();

        return view($this->view . '.evaluate', ['seminar' => $seminar_details, 'fragen' => $fragen, 'antworten' => json_encode($antworten)]);
    }

    public function get_sheetname(Request $request)
    {
        $id = $request->query('id');

        $name = DB::table('evaluation_frageboegen')
            ->where('fragebogen_id', $id)
            ->value('name');

        if ($name) {
            return response()->json([
                'success' => true,
                'name' => $name,
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Fragebogen nicht gefunden.',
            ]);
        }
    }

    public function post_sheet($input) {
        DB::table('evaluation_frageboegen')->insert([
            'name' => $input['name'],
        ]);
    }

    public function post_question($input) {
        DB::table('evaluation_fragen')
        ->insert([
            'text' => $input['name'],
            'fragebogen_id' => $input['id'],
            'type' => $input['art'],
            'sort' => $input['sort']
        ]);
    }

    public function delete_question($input) {
        DB::table('evaluation_fragen')
        ->where('frage_id', $input['id'])
        ->delete();
    }

    public function delete_sheet($input) {
        DB::table('evaluation_frageboegen')
        ->where('fragebogen_id', $input['id'])
        ->delete();
        DB::table('evaluation_fragen')
        ->where('fragebogen_id', $input['id'])
        ->delete();
    }

    public function update_question($input) {
        DB::table('evaluation_fragen')
        ->where('frage_id', $input['id'])
        ->update([
            'text' => $input['neuer_text'],
            'type' => $input['neue_art'],
            'sort' => $input['neue_sort'],
        ]);
        return true;
    }


    public function update_sheet($input) {
        DB::table('evaluation_frageboegen')
            ->where('fragebogen_id', $input['id'])
            ->update([
                'name' => $input['neuer_name'],
            ]);
    }

    public function save_response($input) {
        $count = DB::table('evaluation_antworten')->where('frage_id', $input['id'])->where('ID_Kurs', $input['id_kurs'])->where('tn_id', $input['id_user'])->first();

        if($count === NULL) {
            return DB::table('evaluation_antworten')
                    ->insert([
                        'frage_id' => $input['id'],
                        'antwort_skala' => $input['type'] === 'skala' ? $input['value'] : NULL,
                        'antwort_freitext' => $input['type'] === 'freitext' ? $input['value'] : NULL,
                        'ID_Kurs' => $input['id_kurs'],
                        'tn_id' => $input['id_user']
                    ]);
        }
        else {
            return DB::table('evaluation_antworten')->where('frage_id', $input['id'])->where('ID_Kurs', $input['id_kurs'])->where('tn_id', $input['id_user'])
                    ->update([
                        'antwort_skala' => $input['type'] === 'skala' ? $input['value'] : NULL,
                        'antwort_freitext' => $input['type'] === 'freitext' ? $input['value'] : NULL
                    ]);
        }
    }

    public function save_evaluation($input) {

        return DB::table('seminare_teilnahmen')->where('seminar_id', $input['id_kurs'])->where('tn_id', $input['id_user'])
                ->update([
                    'fragebogen_teilnahme' => 1
                ]);
    }
}
