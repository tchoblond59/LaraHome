@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" method="post" action="{{url('/sensor/update/'.$sensor->id)}}">
                    {{csrf_field()}}
                    <fieldset>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <!-- Form Name -->
                        <legend>Modifier Capteur</legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">Nom</label>
                            <div class="col-md-4">
                                <input id="name" name="name" type="text" placeholder="Nom" class="form-control input-md" value="{{$sensor->name}}" required="">
                                <span class="help-block">Nom du capteur</span>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="node_address">Adresse du noeud</label>
                            <div class="col-md-4">
                                <input id="node_address" name="node_address" type="text" placeholder="1-254" class="form-control input-md" value="{{$sensor->node_address}}" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="sensor_address">Adresse du capteur</label>
                            <div class="col-md-4">
                                <input id="sensor_address" name="sensor_address" type="text" placeholder="" class="form-control input-md" value="{{$sensor->sensor_address}}" required="">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <button class="btn btn-default pull-right">Modifier</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection