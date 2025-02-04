<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Importiert die `Model`-Klasse aus Laravel. Alle Eloquent-Modelle in Laravel erben von dieser `Model`-Klasse.


/**
 * App\Models\EvaluationQuestions
 *
 * @property int $frage_id
 * @property int $fragebogen_id
 * @property string|null $type
 * @property string|null $text
 * @property int|null $f1
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationQuestions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationQuestions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationQuestions query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationQuestions whereF1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationQuestions whereFrage_id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationQuestions whereText($value)
 * @mixin \Eloquent
 */
class EvaluationQuestions extends Model
// Definiert die Klasse `EvaluationQuestions`, die von `Model` erbt und somit alle Funktionen eines Eloquent-Modells besitzt.
{
    protected $table = 'evaluation_fragen';
    // Setzt den Namen der Tabelle, die mit diesem Modell verbunden ist, auf `evaluation_fragen`.
    protected $guarded = [];
    // Die `guarded`-Eigenschaft enthält ein Array von Attributen, die nicht massenzuweisbar sind.
    // Da dieses Array leer ist, können alle Felder massenzugewiesen werden.
}
