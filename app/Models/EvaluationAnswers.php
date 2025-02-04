<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EvaluationAnswers
 *
 * @property int $antwort_id
 * @property string|null $tn_id
 * @property string|null $frage_id
 * @property string|null $antwort
 * @property int|null $f1
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationAnswers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationAnswers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationQAnswers query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationAnswers whereAntwort_id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationAnswers whereF1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationAnswers whereTn_id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationAnswers whereAntwort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationAnswers whereFrage_id($value)
 * @mixin \Eloquent
 */
class EvaluationAnswers extends Model
{
    protected $table = 'evaluation_antworten';
    protected $guarded = [];
}
