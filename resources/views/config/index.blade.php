@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Liste des actions programmées</h1><hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Capteur</th>
                            <th>Commande</th>
                            <th>Cron</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($scheduled_commands as $command)
                        <tr>
                            <td>{{$command->sensor_name}}</td>
                            <td>{{$command->name}}</td>
                            <td>{{$command->cron}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <form class="form-horizontal" method="post" action="{{url('/config/scheduled_task/create')}}">
                <fieldset>
                {{csrf_field()}}
                <!-- Form Name -->
                    <legend>Programmer une action</legend>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="action">Action</label>
                        <div class="col-md-4">
                            <select id="action" name="action" class="form-control">
                                @foreach($mscommands as $command)
                                    <option value="{{$command->id}}">{{$command->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="cron">Cron</label>
                        <div class="col-md-4">
                            <input id="cron" name="cron" type="text" placeholder="* * * * *" class="form-control input-md">
                            <span class="help-block">Sous la forme d'une crontab</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <button class="btn btn-default pull-right">Ajouter</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

@endsection