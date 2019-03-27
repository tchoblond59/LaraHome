@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Gestion de la commande
                    <small>{{$command->name}}</small>
                </h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <hr>
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{url('command/update/'.$command->id)}}">
                            {{csrf_field()}}
                            <fieldset>
                                <!-- Form Name -->
                                <legend>Editer la commande</legend>
                                <div class="form-group">
                                    <label for="command_name">Nom</label>
                                    <input type="text" name="name" class="form-control" id="command_name"
                                           value="{{$command->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="cron_command">Cron</label>
                                    <input type="text" name="cron" class="form-control" id="cron_command"
                                           placeholder="45 9 * * *" value="{{$command->cron}}">
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Valider</button>

                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection