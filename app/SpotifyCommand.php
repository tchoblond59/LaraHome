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
        $spotify_config = SpotifyConfig::first();
        try
        {
            $api = new \SpotifyWebAPI\SpotifyWebAPI();
            $api->setAccessToken($spotify_config->access_token);
            $reponse = $api->getMyDevices();
        }
        catch (SpotifyWebAPIException $e)
        {
            if($e->getCode() == 401)//Access token too old
            {
                $session = new \SpotifyWebAPI\Session(
                    config('services.spotify.client_id'),
                    config('services.spotify.client_secret'),
                    route('spotify_ok')
                );
                $session->refreshAccessToken($spotify_config->refresh_token);
                $accessToken = $session->getAccessToken();
                $refreshToken = $session->getRefreshToken();
                $spotify_config->access_token = $accessToken;
                $spotify_config->refresh_token = $refreshToken;
                $spotify_config->save();
            }
        }
        $api->setAccessToken($spotify_config->access_token);
        if($this->type == 'playlist')
            $api->play($spotify_config->device_id, ['context_uri' => $this->uri]);
        else if($this->type == 'track')
            $api->play($spotify_config->device_id, ['uris' => [$this->uri]]);

    }
}
