<?php

namespace App\Http\Controllers;

use App\Command;
use App\SpotifyCommand;
use App\SpotifyConfig;
use Illuminate\Http\Request;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\SpotifyWebAPIAuthException;
use SpotifyWebAPI\SpotifyWebAPIException;

class SpotifyController extends Controller
{
    public function index()
    {
        $session = new \SpotifyWebAPI\Session(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            route('spotify_ok')
        );
        $options = [
            'scope' => [
                'playlist-read-private',
                'user-read-currently-playing',
                'user-read-playback-state',
                'user-modify-playback-state',
                'user-read-recently-played',
            ],
        ];
        header('Location: '.$session->getAuthorizeUrl($options));
        die();
    }

    public function spotifyok(Request $request)
    {
        $session = new \SpotifyWebAPI\Session(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            route('spotify_ok')
        );
        $session->requestAccessToken($request->code);
        $accessToken = $session->getAccessToken();
        $refreshToken = $session->getRefreshToken();
        $config = SpotifyConfig::first();
        if(!$config)
        {
            $config = new SpotifyConfig();
        }
        $config->access_token = $accessToken;
        $config->refresh_token = $refreshToken;
        $config->save();
        $request->session()->put('access_token', $accessToken);
        $request->session()->put('refresh_token', $refreshToken);
        return redirect()->route('spotify_config');
    }

    public function test(Request $request)
    {
        //        //dd(route('spotify'));
        //        $api = new \SpotifyWebAPI\SpotifyWebAPI();
        //
        //        // Fetch the saved access token from somewhere. A database for example.
        //        $api->setAccessToken($request->session()->get('access_token'));
        //
        //        // It's now possible to request data about the currently authenticated user
        //
        //
        //        //dd($api->search('sexual healing marvin gaye', ['track']));
        //        //3VZmChrnVW8JK6ano4gSED
        //        dd($api->getMyDevices());
        //        //d622989173578e1a242dc0f236c293259d021b94
        //        //dd($api->play('d622989173578e1a242dc0f236c293259d021b94', ['uri
        //s' => ["spotify:track:3VZmChrnVW8JK6ano4gSED"]]));
        //        //dd($api->pause());
        //        //dd($api->play('d622989173578e1a242dc0f236c293259d021b94'));
        //        //dd($api->getMyDevices());
        $command = SpotifyCommand::find(3);
        dd($command->play());
    }

    public function config(Request $request)
    {
        //        $session = new \SpotifyWebAPI\Session(
        //            config('services.spotify.client_id'),
        //            config('services.spotify.client_secret'),
        //            route('spotify_ok')
        //        );
        //        $session->refreshAccessToken($request->session()->get('refresh_token'));
        //        $accessToken = $session->getAccessToken();
        //        $refreshToken = $session->getRefreshToken();
        //
        //        $request->session()->put('access_token', $accessToken);
        //        $request->session()->put('refresh_token', $refreshToken);
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
                $api = new \SpotifyWebAPI\SpotifyWebAPI();
                $api->setAccessToken($spotify_config->access_token);
            }
        }
        $reponse = $api->getMyDevices();
        $devices = $reponse->devices;
        //$api->play($spotify_config->device_id, ['uris' => [$spotify_config->track_id]]);
        $recent_tracks = $api->getMyRecentTracks()->items;
        $playlist = $api->getMyPlaylists();
        //dd($recent_tracks);
        return view('spotify.config')->with([
            'devices' => $devices,
            'spotify_config' => $spotify_config,
            'recent_tracks' => $recent_tracks,
            'playlists' => $playlist->items,
        ]);
    }

    public function updateDefaultDevice(Request $request)
    {
        $this->validate($request, [
            'spotify_device_id' => 'required',
        ]);
        $spotify_config = SpotifyConfig::first();
        if($spotify_config)
        {
            $spotify_config->device_id = $request->spotify_device_id;
            $spotify_config->save();
        }
        else
        {
            $spotify_config = new SpotifyConfig();
            $spotify_config->device_id = $request->spotify_device_id;
            $spotify_config->save();
        }
        return json_encode('ok');
    }

    public function updateDefaultTrack(Request $request)
    {
        $this->validate($request, [
            'spotify_track_id' => 'required',
        ]);
        $spotify_config = SpotifyConfig::first();
        if($spotify_config)
        {
            $spotify_config->track_id = $request->spotify_track_id;
            $spotify_config->save();
        }
        else
        {
            $spotify_config = new SpotifyConfig();
            $spotify_config->track_id = $request->spotify_track_id;
            $spotify_config->save();
        }
        return json_encode('ok');
    }

    public function searchTrack(Request $request)
    {
        $this->validate($request, [
            'search_track' => 'required',
        ]);
        $spotify_config = SpotifyConfig::first();
        $api = new \SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($spotify_config->access_token);
        $search = $api->search($request->search_track, ['type' => 'track']);
        $tracks = $search->tracks->items;
        $view = view('spotify.tracks_result')->with(['tracks' => $tracks, 'spotify_config' => $spotify_config])->render();
        return response()->json(['html' => $view]);
    }

    public function searchPlaylist(Request $request)
    {
        $this->validate($request, [
            'search_playlist' => 'required',
        ]);
        $spotify_config = SpotifyConfig::first();
        $api = new \SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($spotify_config->access_token);
        $search = $api->search($request->search_playlist, ['type' => 'playlist']);
        $playlist = $search->playlists;
        $view = view('spotify.playlists_result')->with(['playlists' => $playlist->items, 'spotify_config' => $spotify_config])->render();
        return response()->json(['html' => $view]);
    }

    public function createAction(Request $request)
    {
        //dd($request->toArray());
        $this->validate($request, [
            'type' => 'required',
            'uri' => 'required',
            'name' => 'required',
        ]);
        $spotify_command = new SpotifyCommand();
        $spotify_command->type = $request->type;
        $spotify_command->device_id = SpotifyConfig::first()->device_id;
        $spotify_command->uri = $request->uri;
        $spotify_command->save();
        $command = new Command();
        $command->name = ucfirst($request->type).' '.$request->name;
        $spotify_command->command()->save($command);
        return redirect()->back();
    }
}
