@extends('layouts.app')

@section('content')
    <div class="container">
    <form class="form-horizontal" method="post" action="{{url('/sensor/add')}}">
        <fieldset>

            <!-- Form Name -->
            <legend>Ajouter un capteur</legend>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{csrf_field()}}
            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="classname">Capteur</label>
                <div class="col-md-4">
                    <select id="classname" name="classname" class="form-control">
                        @foreach($plugins as $plugin)
                        <option value="{{$plugin->provider.$plugin->name}}">{{$plugin->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Nom</label>
                <div class="col-md-4">
                    <input id="name" name="name" type="text" placeholder="Mon capteur" class="form-control input-md" required="">
                    <span class="help-block">Donner un nom à ce capteur</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="node_address">Adresse du noeud</label>
                <div class="col-md-4">
                    <input id="node_address" name="node_address" type="text" placeholder="0" class="form-control input-md" required="">
                    <span class="help-block">Adresse du périphérique</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="Adresse secondaire">Adresse du capteur</label>
                <div class="col-md-4">
                    <input id="sensor_address" name="sensor_address" type="text" placeholder="1" class="form-control input-md" required="">
                    <span class="help-block">Le numéro du capteur sur le noeud</span>
                </div>
            </div>
            <div class="col-md-8">
                <button type="submit" class="btn btn-default pull-right">Ajouter</button>
            </div>
        </fieldset>
    </form>
    </div>
@endsection