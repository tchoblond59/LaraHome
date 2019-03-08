@foreach($tracks as $track)
    <div class="col-lg-2 col-md-3 col-sm-4 mb-1">
        <div class="card">
            <img class="card-img-top" src="{{$track->track->album->images[0]->url}}" alt="album image">
            <div class="text-center">
                <h6>{{$track->track->name}}</h6>
                <p class="mb-0">
                    @foreach($track->track->artists as $artist)
                        {{$artist->name}} &nbsp;
                    @endforeach
                </p>
                <div>
                    {{--<div class="pretty p-switch p-slim">--}}
                        {{--@if($spotify_config && $spotify_config->track_id == $track->track->uri)--}}
                            {{--<input type="radio" name="spotify_track_id" value="{{$track->track->uri}}"--}}
                                   {{--checked autocomplete="off"/>--}}
                        {{--@else--}}
                            {{--<input type="radio" name="spotify_track_id" value="{{$track->track->uri}}"--}}
                                   {{--autocomplete="off"/>--}}
                        {{--@endif--}}
                        {{--<div class="state">--}}
                            {{--<label>par défaut</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <form method="post" action="{{url('spotify/command/create')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="type" value="track">
                        <input type="hidden" name="uri" value="{{$track->track->uri}}">
                        <input type="hidden" name="name" value="{{$track->track->name}}">
                        <button class="btn btn-sm btn-secondary" type="submit">Créer l'action</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach