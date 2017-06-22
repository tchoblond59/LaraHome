<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table = 'dashboards';

    public $timestamps = false;
    
    public function widgets()
    {
        return $this->hasMany('App\Widget');
    }
}
