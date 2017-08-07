<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class CompteurHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::create(2017,1,1,1,1,1);
        for ($j=0; $j<500;$j++)
        {
            for ($i=0;$i<6;$i++)
            {
                $kwh = rand(15,35)/10;
                DB::table('sscompteur_history')->insert([
                    'sensor_id' => 1,
                    'kwh' => 6,
                    'prix' => round($kwh*0.14490,5),
                    'created_at' => $date->format('Y-m-d H:i:s'),
                    'updated_at' => $date->format('Y-m-d H:i:s'),
                ]);
                $date->addHour(2);
            }
            $date->addDay(1);
        }
    }
}
