<?php

namespace App;

use App\Interfaces\CommandInterface;
use Illuminate\Database\Eloquent\Model;

class SpotifyCommand extends Model implements CommandInterface
{
    public function command()
    {
        return $this->morphOne('App\Command', 'commandable');
    }

    public function play()
    {
        $config = SpotifyConfig::first();
        $api = new \SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($config->access_token);
        if($this->type == 'playlist')
            $api->play($config->device_id, ['context_uri' => $this->uri]);
        else if($this->type == 'track')
            $api->play($config->device_id, ['uris' => [$this->uri]]);

    }
}
