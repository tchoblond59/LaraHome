<?php

namespace App\Sensors\SSCompteur;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class SSCompteurHistory extends Model
{
    protected $table = 'sscompteur_history';

    protected $dates = ['created_at'];

    public static function avgKwhByMonth($sensor_id)
    {
        $avg = DB::select("SELECT AVG(kwh) as avg_kwh_by_month FROM (SELECT SUM(kwh) as kwh FROM `sscompteur_history` WHERE sensor_id = ".$sensor_id." GROUP BY MONTH(`created_at`)) TMP");
        return $avg[0];
    }

    public static function avgPrixByMonth($sensor_id)
    {
        $avg = DB::select("SELECT AVG(prix) as avg_prix_by_month FROM (SELECT SUM(prix) as prix FROM `sscompteur_history` WHERE sensor_id = ".$sensor_id." GROUP BY MONTH(`created_at`)) TMP");
        return $avg[0];
    }

    public static function avgKwhByDay($sensor_id)
    {
        $avg = DB::select("SELECT SUM(kwh) / COUNT(DISTINCT(DATE(created_at))) as avg_kwh_by_day FROM sscompteur_history WHERE sensor_id = ".$sensor_id);
        return $avg[0];
    }

    public static function avgPrixByDay($sensor_id)
    {
        $avg = DB::select("SELECT SUM(prix) / COUNT(DISTINCT(DATE(created_at))) as avg_prix_by_day FROM sscompteur_history WHERE sensor_id = ".$sensor_id);
        return $avg[0];
    }

    public static function avgKwhByDayOfWeek($sensor_id)
    {
        $avg = DB::select("SELECT DAYOFWEEK(created_at) as day, SUM(kwh)/COUNT(DISTINCT(DATE(created_at))) as avg_kwh_by_day_of_week FROM `sscompteur_history` GROUP BY DAYOFWEEK(`created_at`)");
        return $avg;
    }

    public static function avgPrixByDayOfWeek($sensor_id)
    {
        $avg = DB::select("SELECT DAYOFWEEK(created_at) as day, SUM(prix)/COUNT(DISTINCT(DATE(created_at))) as avg_prix_by_day_of_week FROM `sscompteur_history` GROUP BY DAYOFWEEK(`created_at`)");
        return $avg;
    }

    public static function consoByMonth($sensor_id)
    {
        $now = Carbon::now();
        $year = $now->year;
        $avg = DB::select("SELECT MONTH(created_at) as month ,SUM(kwh) as kwh, SUM(prix) as prix FROM sscompteur_history WHERE sensor_id =".$sensor_id." AND YEAR(created_at) = ".$year." GROUP BY MONTH(created_at) ORDER BY MONTH(created_at)");
        return $avg;
    }

    public static function getStats($sensor_id)
    {
        $allItems = new \Illuminate\Database\Eloquent\Collection;

        $a = (array) SSCompteurHistory::avgKwhByMonth($sensor_id);
        $b = (array) SSCompteurHistory::avgPrixByMonth($sensor_id);
        $c = (array) SSCompteurHistory::avgKwhByDay($sensor_id);
        $d = (array) SSCompteurHistory::avgPrixByDay($sensor_id);

        return array_merge($a,$b,$c,$d);
    }

    public static function getMonthConso($sensor_id)
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $avg = DB::select("SELECT SUM(kwh) as kwh, SUM(prix) as prix FROM `sscompteur_history` WHERE sensor_id = 5 AND YEAR(created_at) = ".$year." AND MONTH(created_at) = ".$month." GROUP BY MONTH(created_at)");
        return $avg;

    }
}
