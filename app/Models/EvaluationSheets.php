<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EvaluationSheets
 *
 * @property int $fragebogen_id
 * @property string|null $thema
 * @property int|null $f1
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationSheets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationSheets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationSheets query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationSheets whereF1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationSheets whereFragebogen_id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationSheets whereThema($value)
 * @mixin \Eloquent
 */
class EvaluationSheets extends Model
{
    protected $table = 'evaluation_frageboegen';
    protected $guarded = [];
}
