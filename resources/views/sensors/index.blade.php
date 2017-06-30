@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Mes capteurs</h1><hr>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Capteur</th>
                        <th>Plugin</th>
                        <th>Adresse du noeud</th>
                        <th>Adresse du capteur</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sensors as $sensor)
                        <tr>
                            <td>{{$sensor->name}}</td>
                            <td>{{$sensor->classname}}</td>
                            <td>{{$sensor->node_address}}</td>
                            <td>{{$sensor->sensor_address}}</td>
                            <td><a href="{{url('/sensor/update/'.$sensor->id)}}" class="btn btn-default btn-sm">Configurer</a>
                                <form style="display:inline-block" method="post" action="{{url('/sensor/delete/'.$sensor->id)}}">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection