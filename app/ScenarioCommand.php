<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class ScenarioCommand extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'ordre',
        'sort_when_creating' => true,
    ];

    protected $table= 'scenario_command';

    public $timestamps = false;

    public function scenario()
    {
        return $this->belongsTo('App\Scenario');
    }

    public function buildSortQuery()
    {
        return static::query()->where('scenario_id', $this->scenario_id);
    }
}
