@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>SSRelay configuration</h1>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h3>Historique des dernières actions</h3>
                <ul>
                    @foreach($messages as $message)
                        <li>
                            {{$message->created_at}}
                            @if($message->value)
                                Relay On
                            @else
                                Relay Off
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <div class="row well">
                    <h3>{{$widget->name}}</h3><br>
                    <h5><strong>Plugin:</strong> {{$widget->sensor->classname}}</h5>
                    <h5><strong>Capteur:</strong> {{$widget->sensor->name}}</h5>
                    <h5><strong>Adresse du noeud:</strong> {{$widget->sensor->node_address}}</h5>
                    <h5><strong>Adresse secondaire:</strong> {{$widget->sensor->sensor_address}}</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <form class="form-horizontal" method="post" action="{{url('/SSRelay/action/create/'.$widget->id)}}">
                <fieldset>
                    {{csrf_field()}}
                    <!-- Form Name -->
                    <legend>Créer une action</legend>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">Nom</label>
                        <div class="col-md-4">
                            <input id="name" name="name" type="text" placeholder="Ma commande" class="form-control input-md" required="">
                            <span class="help-block">Le nom sous lequel votre commande va apparaitre</span>
                        </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="command">Commande</label>
                        <div class="col-md-4">
                            <select id="command" name="command" class="form-control">
                                <option value="1">Activer Relais</option>
                                <option value="0">Désactiver Relais</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8"><button class="btn btn-default pull-right">Ajouter</button></div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection