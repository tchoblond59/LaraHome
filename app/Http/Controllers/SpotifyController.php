<?php

namespace App\Http\Controllers;

use App\SpotifyConfig;
use Illuminate\Http\Request;

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


        header('Location: ' . $session->getAuthorizeUrl($options));
        die();
    }

    public function spotifyok(Request $request)
    {
        //dd($request);
        $session = new \SpotifyWebAPI\Session(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            route('spotify_ok')
        );
        $session->requestAccessToken($request->code);
        $accessToken = $session->getAccessToken();
        $refreshToken = $session->getRefreshToken();

        $request->session()->put('access_token', $accessToken);
        $request->session()->put('refresh_token', $refreshToken);

        return redirect()->route('spotify_config');
    }

    public function test(Request $request)
    {
        //dd(route('spotify'));
        $api = new \SpotifyWebAPI\SpotifyWebAPI();

        // Fetch the saved access token from somewhere. A database for example.
        $api->setAccessToken($request->session()->get('access_token'));

        // It's now possible to request data about the currently authenticated user


        //dd($api->search('sexual healing marvin gaye', ['track']));
        //3VZmChrnVW8JK6ano4gSED
        dd($api->getMyDevices());
        //d622989173578e1a242dc0f236c293259d021b94
        //dd($api->play('d622989173578e1a242dc0f236c293259d021b94', ['uris' => ["spotify:track:3VZmChrnVW8JK6ano4gSED"]]));
        //dd($api->pause());
        //dd($api->play('d622989173578e1a242dc0f236c293259d021b94'));
        //dd($api->getMyDevices());
    }

    public function config(Request $request)
    {
        $session = new \SpotifyWebAPI\Session(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            route('spotify_ok')
        );

//        $session->refreshAccessToken($request->session()->get('refresh_token'));
//        $accessToken = $session->getAccessToken();
//        $refreshToken = $session->getRefreshToken();
//
//        $request->session()->put('access_token', $accessToken);
//        $request->session()->put('refresh_token', $refreshToken);


        $api = new \SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($request->session()->get('access_token'));
        $reponse = $api->getMyDevices();
        $devices = $reponse->devices;
        $spotify_config = SpotifyConfig::first();
        //$api->play($spotify_config->device_id, ['uris' => [$spotify_config->track_id]]);
        $recent_tracks = $api->getMyRecentTracks()->items;
        //dd($recent_tracks);
        return view('spotify.config')->with([
            'devices' => $devices,
            'spotify_config' => $spotify_config,
            'recent_tracks' => $recent_tracks,
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
        $api = new \SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($request->session()->get('access_token'));
        $search = $api->search($request->search_track, ['type' => 'track']);
        $tracks = $search->tracks->items;
        $spotify_config = SpotifyConfig::first();
        $view = view('spotify.tracks_result')->with(['tracks' => $tracks, 'spotify_config' => $spotify_config])->render();

        return response()->json(['html' => $view]);

    }
}
