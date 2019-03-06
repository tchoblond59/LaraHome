<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    protected $table = 'plugins';
    protected $fillable = ['name', 'description', 'composer_name', 'provider', 'widget_class_name', 'url', 'enable'];

    public static function export()
    {
        return Plugin::select('name', 'description', 'composer_name', 'provider', 'widget_class_name', 'url')->get();
    }
}
