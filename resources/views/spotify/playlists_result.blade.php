@foreach($playlists as $playlist)
    <div class="col-lg-2 col-md-3 col-sm-4 mb-1">
        <div class="card">
            @if(!empty($playlist->images))
                <img class="card-img-top" src="{{$playlist->images[0]->url}}" alt="album image">
            @else
                <img src="https://fakeimg.pl/250x250/">
            @endif
            <div class="text-center">
                <h6>{{$playlist->name}}</h6>
                <div>
                    {{--<div class="pretty p-switch p-slim">--}}
                    {{--@if($spotify_config && $spotify_config->playlist_id == $playlist->uri)--}}
                    {{--<input type="radio" name="spotify_playlist_id" value="{{$playlist->uri}}"--}}
                    {{--checked autocomplete="off"/>--}}
                    {{--@else--}}
                    {{--<input type="radio" name="spotify_playlist_id" value="{{$playlist->uri}}"--}}
                    {{--autocomplete="off"/>--}}
                    {{--@endif--}}
                    {{--<div class="state">--}}
                    {{--<label>par défaut</label>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    <form method="post" action="{{url('spotify/command/create')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="type" value="playlist">
                        <input type="hidden" name="uri" value="{{$playlist->uri}}">
                        <input type="hidden" name="name" value="{{$playlist->name}}">
                        <button class="btn btn-sm btn-secondary" type="submit">Créer l'action</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endforeach