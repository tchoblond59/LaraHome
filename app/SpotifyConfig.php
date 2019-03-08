<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpotifyConfig extends Model
{
    public static function icon($type)
    {
        $type_icon = array(
            'Computer' => 'laptop ',
            'Tablet' => 'tablet ',
            'Smartphone' => 'mobile-alt',
            'Speaker' => '',
            'TV' => 'tv',
            'AVR' => 'music',
            'Automobile' => 'car',
            'Unknown' => 'question',
            'CastAudio' => '',
            'CastVideo' => '',
        );

        return $type_icon[$type];
    }
}
