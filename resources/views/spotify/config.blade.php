@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <form method="post" action="{{url('spotify/updateDefaultDevice')}}">
            {{csrf_field()}}
            <div class="row justify-content-around">
                @foreach($devices as $device)
                    <div class="col-3">
                        <div class="card text-center text-white bg-success">
                            <div class="card-header-icon">
                                <i class="fas fa-4x fa-{{\App\SpotifyConfig::icon($device->type)}} mt-3"></i>
                            </div>
                            <h5 class="card-title mt-3">{{$device->name}}</h5>
                            <div>
                                <div class="pretty p-switch p-slim">
                                    @if($spotify_config && $spotify_config->device_id == $device->id)
                                        <input type="radio" name="spotify_device_id" value="{{$device->id}}"
                                               checked autocomplete="off"/>
                                    @else
                                        <input type="radio" name="spotify_device_id" value="{{$device->id}}"
                                               autocomplete="off"/>
                                    @endif
                                    <div class="state">
                                        <label>par défaut</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <hr>
                <form method="post" action="{{url('spotify/search/track')}}" id="spotify_search_track">
                    {{csrf_field()}}
                    <div class="form-row">
                        <div class="col-sm-6">
                            <input type="text" name="search_track" class="form-control" id="search_track"
                                   placeholder="Rechercher un titre">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-2" form="spotify_search_track"
                                    id="btn_search_track">Rechercher <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <form method="post" action="{{url('spotify/updateDefaultTrack')}}">
            {{csrf_field()}}
            <div class="row mt-4" id="div_tracks_result">
                @include('spotify.tracks_recent', ['tracks' => $recent_tracks])
            </div>
        </form>
    </div>
@endsection