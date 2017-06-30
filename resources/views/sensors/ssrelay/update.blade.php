@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form class="form-horizontal" method="post" action="{{url('/SSRelay/update/'.$sensor->id)}}">
                <fieldset>
                    {{csrf_field()}}
                    <!-- Form Name -->
                    <legend>Modifier {{$sensor->name}}</legend>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="type">Type</label>
                        <div class="col-md-4">
                            <select id="type" name="type" class="form-control">
                                @if($ssrelay_config->type=='temporisé')
                                    <option value="temporisé" selected>Temporisé</option>
                                @else
                                    <option value="temporisé">Temporisé</option>
                                @endif
                                @if($ssrelay_config->type=='default')
                                    <option value="default" selected>Normal</option>
                                @else
                                    <option value="default">Normal</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="delay">Délai</label>
                        <div class="col-md-4">
                            <input id="delay" name="delay" type="text" placeholder="500" class="form-control input-md" value="{{$ssrelay_config->delay}}">
                            <span class="help-block">Délai de temporisation en millisecondes</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <button class="btn btn-default pull-right" type="submit">Modifier</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection