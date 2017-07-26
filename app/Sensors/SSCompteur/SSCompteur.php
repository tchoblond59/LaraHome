<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 24/07/17
 * Time: 14:04
 */

namespace App\Sensors\SSCompteur;


use App\Sensor;

class SSCompteur extends Sensor
{
    public function getWidget(\App\Widget $widget)
    {
        $sensor  = $widget->sensor;
        $sscompteur_config = SSCompteurConfig::getFromSensor($sensor->id);
        if($sscompteur_config==null)
        {
            $sscompteur_config = new SSCompteurConfig();
            $sscompteur_config->sensor_id = $sensor->id;
            $sscompteur_config->kwh = 0;
            $sscompteur_config->prix = 0;
            $sscompteur_config->save();
        }
        $sscompteur_history = SSCompteurHistory::getMonthConso($sensor->id);
        return view('sensors.sscompteur.widget')->with(['widget' => $widget,
            'sensor' => $sensor,
            'sscompteur_history' => $sscompteur_history,
            'compteur' => $sscompteur_config]);
    }
}