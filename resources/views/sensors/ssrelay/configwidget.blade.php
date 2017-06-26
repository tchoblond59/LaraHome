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
    </div>
@endsection